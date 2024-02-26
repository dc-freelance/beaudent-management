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
            $data = $request->all();
            $data['phone_number'] = str_replace('.', '',  str_replace('-', '', str_replace('+', '', $data['phone_number'])));
            if (substr($data['phone_number'], 0, 2) == '62') {
                $data['phone_number'] = substr($data['phone_number'], 2, strlen($data['phone_number']));
            };
            if (substr($data['phone_number'], 0, 1) == '0') {
                $data['phone_number'] = substr($data['phone_number'], 1, strlen($data['phone_number']));
            };

            $customer = $this->customer_model->create($data);

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
