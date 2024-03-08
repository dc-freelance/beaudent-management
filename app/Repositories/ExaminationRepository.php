<?php

namespace App\Repositories;

use App\Interfaces\ExaminationInterface;
use App\Models\Customer;
use App\Models\Customers;
use App\Models\Examination;
use Carbon\Carbon;

class ExaminationRepository implements ExaminationInterface
{
    private $examination;
    private $customer;

    public function __construct(Examination $examination, Customers $customer)
    {
        $this->examination = $examination;
        $this->customer    = $customer;
    }

    public function getAll()
    {
        $results = $this->examination
            ->with('reservation', 'doctor', 'medicalRecord', 'customer', 'odontogramResults')
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->where('created_at', '>=', request('start_date') . ' 00:00:00')
                    ->where('created_at', '<=', request('end_date') . ' 23:59:59');
            })->when(request()->filled('branch_id'), function ($query) {
                $query->whereHas('reservation', function ($query) {
                    $query->where('branch_id', request('branch_id'));
                });
            })->get();
        return $results;
    }

    public function getById($id)
    {
        return $this->examination->with(
            'reservation',
            'doctor',
            'medicalRecord',
            'customer',
            'odontogramResults'
        )->find($id);
    }

    public function getExaminationByTransactionId($transactionId)
    {
        return $this->examination->where('transaction_id', $transactionId)->first();
    }

    public function store($data)
    {
        $examination = $this->examination->updateOrCreate(
            [
                'reservation_id'    => $data['reservation_id'],
                'doctor_id'         => $data['doctor_id'],
                'medical_record_id' => $data['medical_record_id'],
            ],
            [
                'reservation_id'           => $data['reservation_id'],
                'doctor_id'                => $data['doctor_id'],
                'medical_record_id'        => $data['medical_record_id'],
                'customer_id'              => $data['customer_id'],
                'examination_date'         => Carbon::now()->locale('id')->isoFormat('YYYY-MM-DD'),
                'systolic_blood_pressure'  => $data['systolic_blood_pressure'],
                'diastolic_blood_pressure' => $data['diastolic_blood_pressure'],
                'blood_type'               => $data['blood_type'],
                'heart_disease'            => $data['heart_disease'],
                'diabetes'                 => $data['diabetes'],
                'blood_clotting_disorder'  => $data['blood_clotting_disorder'],
                'hepatitis'                => $data['hepatitis'],
                'digestive_diseases'       => $data['digestive_diseases'],
                'other_diseases'           => $data['other_diseases'],
                'allergies_to_medicines'   => $data['allergies_to_medicines'],
                'medications'              => $data['medications'] ?? null,
                'allergies_to_food'        => $data['allergies_to_food'],
                'foods'                    => $data['foods'] ?? null,
                'created_at'               => Carbon::now()->locale('id')->isoFormat('YYYY-MM-DD HH:mm:ss'),
            ]
        );

        return $examination;
    }

    public function update($id, $data)
    {
        $examination = $this->examination->find($id);
        $data['created_at'] = Carbon::now()->locale('id')->isoFormat('YYYY-MM-DD HH:mm:ss');
        $examination->update($data);

        return $examination;
    }

    public function getAllExaminationGroupByCustomer()
    {
        $customers = $this->customer->with('examinations')->has('examinations')->get();
        return $customers;
    }

    public function getExaminationByCustomerId($customerId)
    {
        $examinations = $this->customer->with('examinations')->find($customerId);
        return $examinations;
    }
}
