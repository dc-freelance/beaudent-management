<?php

namespace App\Http\Requests\API\Reservation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckReservationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'creds' => 'required',
            'no' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'creds.required' => 'Email atau Whatsapp harus diisi',
            'no.required' => 'Harap memasukkan nomor reservasi',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 200, // Change the response code to 200
            'error' => $validator->errors(),
        ], 200)); // Change the response status code to 200
    }
}
