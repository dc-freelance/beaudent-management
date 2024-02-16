<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Reservation\CustomerRequest;
use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\Customers;
use App\Models\Branch;
use App\Models\Treatment;
use App\Http\Requests\API\Reservation\StoreReservationRequest;
use App\Interfaces\BranchInterface;
use App\Interfaces\TreatmentInterface;

class ReservationsController extends Controller
{
    private $reservation_model;

    private $treatment;

    private $branch;

    private $customer;

    public function __construct(TreatmentInterface $treatment, BranchInterface $branch)
    {
        $this->reservation_model = new Reservations();
        $this->treatment = $treatment;
        $this->branch = $branch;
        $this->customer = new Customers();
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

            //Upload Gambar
            if ($request->hasFile('deposit_receipt')) {
                $file = $request->file('deposit_receipt');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('deposit-receipt', $fileName, 'public');
                $data['deposit_receipt'] = Storage::url($filePath);
            }

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
            $customer = $this->customer->where('email', $request->creds)->orWhere('phone_number', $request->creds)->first();

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