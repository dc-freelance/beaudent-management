<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreRegistrationRequest;
use App\Models\Customers;

class RegistrationController extends Controller
{
    private $customer_model;

    public function __construct()
    {
        $this->customer_model = new Customers();
    }

    public function __invoke(StoreRegistrationRequest $request)
    {
        try {
            $customer = $this->customer_model->create($request->all());

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Registrasi',
                'customer' => $customer,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'error' => 'Gagal Registrasi',
            ]);
        }
    }
}
