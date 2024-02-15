<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customers;

class RegistrationController extends Controller
{
    public function __invoke(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'name' =>'required',
            'date_of_birth' =>'required',
            'place_of_birth' =>'required',
            'identity_number' =>'required',
            'gender' =>'required',
            'occupation' =>'required',
            'phone_number' =>'required',
            'religion' =>'required',
            'note' =>'nullable',
            'instagram' =>'nullable',
            'youtube' =>'nullable',
            'facebook' =>'nullable',
            'source_of_information'=>'nullable'
        ]);
        try {
            $customer = Customers::create($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'Successfully registered',
                'customer' => $customer
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
