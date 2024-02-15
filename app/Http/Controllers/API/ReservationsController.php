<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Http\Requests\API\Reservation\StoreReservationRequest;

class ReservationsController extends Controller
{
    private $reservation_model;

    public function __construct()
    {
        $this->reservation_model = new Reservations();
    }

    public function index()
    {
        //
    }

    public function store(StoreReservationRequest $request)
    {
        try {  
            $reservation = $this->reservation_model->create($request->all());
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
}