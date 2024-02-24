<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRegistrationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'identity_number' => 'required',
            'gender' => 'required',
            'occupation' => 'required',
            'phone_number' => 'required|unique:customers,phone_number',
            'religion' => 'required',
            'email' => 'required|email|unique:customers,email',
            'marrital_status' => 'required',
            // 'oral_issues' =>'required',
            // 'note' =>'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'facebook' => 'nullable',
            'address' => 'required',
            'source_of_information' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'date_of_birth.required' => 'Tanggal lahir harus diisi.',
            'place_of_birth.required' => 'Tempat lahir harus diisi.',
            'identity_number.required' => 'Nomor identitas harus diisi.',
            'gender.required' => 'Jenis kelamin harus diisi.',
            'occupation.required' => 'Pekerjaan harus diisi.',
            'phone_number.required' => 'Nomor telepon harus diisi.',
            'phone_number.unique' => 'Nomor telepon sudah digunakan.',
            'religion.required' => 'Agama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'address.required' => 'Alamat harus diisi.',
            'marrital_status.required' => 'Status pernikahan harus diisi.',
            // 'oral_issues.required' => 'Masalah gigi harus diisi.'
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
