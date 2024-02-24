<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Reservation\CustomerRequest;
use App\Http\Requests\API\Reservation\StoreDepositRequest;
use App\Http\Requests\API\Reservation\StoreReservationRequest;
use App\Interfaces\BranchInterface;
use App\Interfaces\ReservationsInterface;
use App\Interfaces\TreatmentInterface;
use App\Models\Customers;
use App\Models\Reservations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use function App\Helpers\generateTransactionCode;

class ReservationsController extends Controller
{
    private $reservation_model;

    private $treatment;

    private $branch;

    private $customer;

    private $reservation;

    public function __construct(TreatmentInterface $treatment, BranchInterface $branch, ReservationsInterface $reservation)
    {
        $this->reservation_model = new Reservations();
        $this->treatment = $treatment;
        $this->branch = $branch;
        $this->customer = new Customers();
        $this->reservation = $reservation;
    }

    public function index()
    {
        //
    }

    public function store(StoreReservationRequest $request)
    {
        try {
            $data = $request->all();
            $data['no'] = generateTransactionCode('RSV', date('Y'), date('m'), $data['branch_id']);
            $data['status'] = 'Reservation';

            $reservation = $this->reservation_model->create($data);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil melakukan reservasi',
                'reservasi' => $reservation,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Gagal melakukan reservasi',
            ]);
        }
    }

    public function deposit(StoreDepositRequest $request)
    {
        try {
            $data = $request->all();
            $data['deposit'] = str_replace('.', '', $data['deposit']);

            if ($request->hasFile('deposit_receipt')) {
                $file = $request->file('deposit_receipt');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('deposit-receipt', $fileName, 'public');
                $data['deposit_receipt'] = Storage::url($filePath);
            }

            $reservation = $this->reservation->deposit($data['id'], $data);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil melakukan pembayaran deposit',
                'reservasi' => $reservation,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Gagal melakukan pembayaran deposit',
            ]);
        }
    }

    public function treatment()
    {
        try {
            $treatments = $this->treatment->getParentNull();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mengambil data layanan',
                'treatments' => $treatments,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Tidak dapat mengambil data layanan',
            ]);
        }
    }

    public function branch()
    {
        try {
            $branch = $this->branch->get();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mengambil data cabang',
                'branch' => $branch,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Tidak dapat mengambil data cabang',
            ]);
        }
    }

    public function customer(CustomerRequest $request)
    {
        try {
            $customer = $this->customer->with([
                'reservations' => function ($query) {
                    $query->whereDate('request_date', '>=', Carbon::now()->format('Y-m-d'));
                    $query->where('status', '!=', 'Cancel');
                    $query->with([
                        'branches' => function ($query) {
                            $query->select('id', 'name', 'deposit_minimum');
                        }
                    ]);
                    $query->with([
                        'treatments' => function ($query) {
                            $query->select('id', 'name');
                        }
                    ]);
                }
            ])->where('email', $request->creds)->orWhere('phone_number', $request->creds)->first();

            if (isset($customer)) {
                if (isset($customer->reservations[count($customer->reservations) - 1])) {
                    $customer->reservations[count($customer->reservations) - 1]['request_time'] = Carbon::parse($customer->reservations[count($customer->reservations) - 1]['request_time'])->format('H:i');
                };
            };

            return response()->json([
                'status' => 200,
                'message' => 'Data Customer Ditemukan',
                'customer' => $customer,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Gagal Mencari Customer',
            ]);
        }
    }
}
