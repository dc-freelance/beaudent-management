<?php

namespace App\Http\Controllers\API;

use App\Events\NotifUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Reservation\CustomerRequest;
use App\Http\Requests\API\Reservation\StoreDepositRequest;
use App\Http\Requests\API\Reservation\StoreReservationRequest;
use App\Interfaces\BranchInterface;
use App\Interfaces\ReservationsInterface;
use App\Interfaces\TreatmentInterface;
use App\Models\ConfigShift;
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

    private $shift;

    public function __construct(TreatmentInterface $treatment, BranchInterface $branch, ReservationsInterface $reservation)
    {
        $this->reservation_model = new Reservations();
        $this->treatment = $treatment;
        $this->branch = $branch;
        $this->customer = new Customers();
        $this->reservation = $reservation;
        $this->shift = new ConfigShift();
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
            $data['status'] = 'Pending';

            $check_current = $this->reservation_model->where('customer_id', $data['customer_id'])->where('request_date', $data['request_date'])->where('status', '!=', 'Cancel')->where('deleted_at', null)->first();
            if ($check_current != null) {
                return response()->json([
                    'status' => 200,
                    'error' => array('time' => array('Anda Telah Reservasi Untuk Tanggal ' . Carbon::parse($data['request_date'])->isoFormat('D MMMM YYYY')))
                ]);
            };

            $reservation = $this->reservation_model->create($data);
            // event(new NotifUpdated('data-table'));
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil melakukan reservasi',
                'reservasi' => $reservation
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 200,
                'dump' => $th,
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
                'code' => 200,
                'error' => array('creds' => array('Kesalahan Server')),
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

    public function shift()
    {
        try {
            $start = $this->shift->where('deleted_at', null)->orderBy('start_time', 'asc')->first();
            $end = $this->shift->where('deleted_at', null)->orderBy('end_time', 'desc')->first();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mengambil data shift',
                'start_h' => Carbon::parse($start->start_time)->format('H'),
                'start_m' => Carbon::parse($start->start_time)->format('i'),
                'end_h' => Carbon::parse($end->end_time)->format('H'),
                'end_m' => Carbon::parse($end->end_time)->format('i')
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Tidak dapat mengambil data shift',
            ]);
        }
    }

    public function customer(CustomerRequest $request)
    {
        try {
            $customer = $this->customer->with([
                'reservations' => function ($query) {
                    $query->where('deleted_at', null);
                    $query->with([
                        'branches' => function ($query) {
                            $query->select('id', 'name', 'deposit_minimum');
                        }
                    ]);
                    $query->orderBy('created_at', 'desc');
                }
            ])->where('email', $request->creds)->where('deleted_at', null)->orWhere('phone_number', $request->creds)->where('deleted_at', null)->first();

            if (isset($customer)) {
                foreach ($customer->reservations as $reservation) {
                    $reservation->request_date = Carbon::parse($reservation->request_date)->isoFormat('D MMMM YYYY');
                    $reservation->request_time = Carbon::parse($reservation->request_time)->format('H:i');
                }
            };

            return response()->json([
                'status' => 200,
                'message' => 'Data Customer Ditemukan',
                'customer' => $customer,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 200,
                'error' => 'Kesalahan Server',
            ]);
        }
    }

    public function search($no)
    {
        try {
            $reservation = $this->reservation_model->with([
                'customers' => function ($query) {
                    $query->select('id', 'phone_number');
                },
                'branches' => function ($query) {
                    $query->select('id', 'name', 'deposit_minimum');
                },
            ])->where('no', $no)->where('deleted_at', null)->first();

            if (isset($reservation)) {
                $reservation->request_date = Carbon::parse($reservation->request_date)->isoFormat('D MMMM YYYY');
                $reservation->request_time = Carbon::parse($reservation->request_time)->format('H:i');

                if ($reservation->transfer_date != null) {
                    $reservation->transfer_date = Carbon::parse($reservation->transfer_date)->isoFormat('D MMMM YYYY');
                };

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Customer Ditemukan',
                    'reservation' => $reservation,
                ]);
            };

            return response()->json([
                'status' => 200,
                'error' => array('data' => array('Reservasi Tidak Valid')),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 200,
                'error' => 'Kesalahan Server',
            ]);
        }
    }
}
