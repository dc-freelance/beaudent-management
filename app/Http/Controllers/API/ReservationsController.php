<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\Customers;
use App\Models\Branch;
use App\Models\Treatment;

use App\Http\Requests\API\Reservation\StoreReservationRequest;

class ReservationsController extends Controller
{
    private $reservation_model, $customer_model, $branch_model, $treatment_model;

    public function __construct()
    {
        $this->reservation_model = new Reservations();
        $this->customer_model = new Customers();
        $this->branch_model = new Branch();
        $this->treatment_model = new Treatment();
    }

    public function searchCustomer(Request $request)
    {
        try {
            $search = $request->input('search');

            $customers = $this->customer_model->where('phone_number', $search)
                ->orWhere('email', $search)
                ->get();

            if ($customers->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Customer tidak ditemukan',
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data customer ditemukan',
                'customers' => $customers
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Gagal mencari customer'
            ]);
        }
    }

    public function store(StoreReservationRequest $request)
    {
        try {  
            $data = $request->all();
            $data['no'] = generateTransactionCode('PCH', date('Y'), date('m'), $data['branch_id']);
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
                'reservasi' => $reservation
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'=>500,
                'error' => 'Gagal melakukan reservasi'
            ]);
        }
    }

    public function getCabang()
    {
        try {
            $cabang = $this->branch_model->all();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mendapatkan data cabang',
                'cabang' => $cabang
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Gagal mendapatkan data cabang'
            ]);
        }
    }

    public function getLayanan()
    {
        try {
            $layanan = $this->treatment_model->getTreatment();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mengambil data layanan',
                'cabang' => $layanan
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Gagal mengambil data layanan'
            ]);
        }
    }
}