<?php

namespace App\Http\Requests\API\Reservation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDepositRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required',
            'deposit' => 'required',
            'deposit_receipt' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'customer_bank_account' => 'required',
            'customer_bank' => 'required',
            'customer_bank_account_name' => 'required',
            'transfer_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Harap memasukkan nomor reservasi',
            'deposit.required' => 'Jumlah deposit harus diisi',
            'deposit_receipt.required' => 'Bukti transfer harus diisi',
            'deposit_receipt.image' => 'Format bukti tidak didukung',
            'deposit_receipt.mimes' => 'Format bukti tidak didukung',
            'customer_bank_account.required' => 'No rekening harus diisi',
            'customer_bank.required' => 'Bank pengirim harus ditentukan',
            'customer_bank_account_name.required' => 'Nama rekening harus diisi',
            'transfer_date.required' => 'Tanggal transfer harus ditentukan',
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
