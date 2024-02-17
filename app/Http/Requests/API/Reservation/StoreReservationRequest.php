<?php

namespace App\Http\Requests\API\Reservation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreReservationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'no' => 'nullable',
            'branch_id' => 'required',
            'request_date' => 'required',
            'request_time' => 'required',
            'anamnesis' => 'required',
            'customer_id' => 'required',
            'status' => 'nullable',
            'is_control' => 'required',
        ];

        if ($this->input('is_control') == 1) {
            $rules['treatment_id'] = 'nullable';
            $rules['deposit'] = 'nullable';
            $rules['deposit_status'] = 'nullable';
            $rules['deposit_receipt'] = 'nullable';
            $rules['customer_bank_account'] = 'nullable';
            $rules['customer_bank'] = 'nullable';
            $rules['customer_bank_account_name'] = 'nullable';
            $rules['transfer_date'] = 'nullable';
        } else {
            $rules['treatment_id'] = 'required';
            $rules['deposit'] = 'required';
            $rules['deposit_status'] = 'nullable';
            $rules['deposit_receipt'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['customer_bank_account'] = 'nullable';
            $rules['customer_bank'] = 'required';
            $rules['customer_bank_account_name'] = 'required';
            $rules['transfer_date'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'branch_id.required' => 'Harap pilih cabang',
            'request_date.required' => 'Tanggal permintaan harus diisi.',
            'request_time.required' => 'Waktu permintaan harus diisi.',
            'anamnesis.required' => 'Anamnesis harus diisi.',
            'customer_id.required' => 'ID pelanggan harus diisi.',
            'deposit_status.required' => 'Status deposit harus diisi.',
            'treatment_id.required' => 'Harap pilih layanan',
            'is_control.required' => 'Harap pilih layanan',
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
