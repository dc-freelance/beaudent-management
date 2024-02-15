<?php

namespace App\Http\Requests\API\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{

    public function rules()
    {
        return [
            'no' =>'required',
            'branch_id' =>'required',
            'request_date' =>'required',
            'request_time' =>'required',
            'anamnesis' =>'required',
            'customer_id' =>'required',
            'status' =>'required',
            'deposit' =>'nullable',
            'deposit_status' =>'required',
            'deposit_receipt' =>'nullable',
            'customer_bank_account' =>'nullable',
            'customer_bank' =>'nullable',
            'customer_bank_account_name' =>'nullable',
            'transfer_date' =>'nullable',
            'treatment_id'=>'nullable',
            'is_control'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'no.required' => 'Nomor harus diisi.',
            'branch_id.required' => 'Harap pilih cabang',
            'request_date.required' => 'Tanggal permintaan harus diisi.',
            'request_time.required' => 'Waktu permintaan harus diisi.',
            'anamnesis.required' => 'Anamnesis harus diisi.',
            'customer_id.required' => 'ID pelanggan harus diisi.',
            'deposit_status.required' => 'Status deposit harus diisi.',
            'treatment_id.required' => 'Harap pilih layanan',
            'is_control.required' => 'Harap pilih layanan'
        ];
    }
}