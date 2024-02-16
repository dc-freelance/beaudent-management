<?php

namespace App\Http\Requests\API\Reservation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
{

    public function rules()
    {
        return [
            'creds' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'creds.required' => 'Kredensial Harus Diisi',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 200,
            'error' => $validator->errors(),
        ], 200));
    }
}
