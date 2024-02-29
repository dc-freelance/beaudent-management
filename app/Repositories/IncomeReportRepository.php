<?php

namespace App\Repositories;

use App\Interfaces\IncomeReportInterface;
use App\Models\DoctorBonus;
use App\Models\ExaminationTreatment;
use App\Models\Transaction;

class IncomeReportRepository implements IncomeReportInterface
{
    private $transaction;
    private $doctorBonus;
    private $examinationTreatment;

    public function __construct(Transaction $transaction, DoctorBonus $doctorBonus, ExaminationTreatment $examinationTreatment)
    {
        $this->transaction          = $transaction;
        $this->doctorBonus          = $doctorBonus;
        $this->examinationTreatment = $examinationTreatment;
    }

    public function getGeneral()
    {
        $results = $this->transaction->where('is_paid', 1)->with(['branch', 'customer', 'payment_method'])
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->where('created_at', '>=', request('start_date'))
                    ->where('created_at', '<=', request('end_date') . ' 23:59:59');
            })
            ->when(request()->filled('branch_id'), function ($query) {
                $query->where('branch_id', request('branch_id'));
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return $results;
    }

    public function exportGeneral()
    {
        $results = $this->transaction->where('is_paid', 1)->with(['branch', 'customer', 'payment_method'])
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->where('created_at', '>=', request('start_date'))
                    ->where('created_at', '<=', request('end_date') . ' 23:59:59');
            })
            ->when(request()->filled('branch_id'), function ($query) {
                $query->where('branch_id', request('branch_id'));
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return $results->map(function ($data) {
            return [
                'transaction_code' => $data->code,
                'transaction_date' => date('d/m/Y', strtotime($data->created_at)),
                'branch'           => $data->branch->name,
                'patient'          => $data->customer->name,
                'payment_method'   => $data->payment_method->name,
                'total'            => number_format($data->total, 0, ',', '.'),
                'discount'         => number_format($data->discount, 0, ',', '.') . '%',
                'total_ppn'        => number_format($data->total_ppn, 0, ',', '.'),
                'grand_total'      => number_format($data->grand_total, 0, ',', '.')
            ];
        });
    }

    public function getDoctor()
    {
        $transactions = $this->transaction
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->where('created_at', '>=', request('start_date'))
                    ->where('created_at', '<=', request('end_date') . ' 23:59:59');
            })
            ->when(request()->filled('branch_id'), function ($query) {
                $query->where('branch_id', request('branch_id'));
            })
            ->when(request()->filled('doctor_id'), function ($query) {
                $query->where('doctor_id', request('doctor_id'));
            })
            ->where('is_paid', 1)
            ->get();

        foreach ($transactions as $transaction) {
            $examinationTreatments = $this->examinationTreatment->where('examination_id', $transaction->examination_id)->get();
            foreach ($examinationTreatments as $examinationTreatment) {
                $doctorBonus = $this->doctorBonus->where('examination_treatment_id', $examinationTreatment->id)->sum('bonus');
                $examinationTreatment->doctor_bonus = $doctorBonus;
            }
            $transaction->examination_treatments = $examinationTreatments;
        }

        $transactions = $transactions->map(function ($data) {
            return [
                'transaction_code' => $data->code,
                'transaction_date' => $data->created_at->format('Y-m-d'),
                'branch'           => $data->branch->name,
                'branch_id'        => $data->branch_id,
                'patient'          => $data->customer->name,
                'doctor'           => $data->doctor->name,
                'treatments'       => $data->examination_treatments->map(function ($treatment) {
                    return $treatment->treatment->name;
                })->implode(', '),
                'total_fee'        => $data->examination_treatments->sum('doctor_bonus')
            ];
        });

        return $transactions;
    }

    public function  exportDoctor()
    {
        $transactions = $this->transaction
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->where('created_at', '>=', request('start_date'))
                    ->where('created_at', '<=', request('end_date') . ' 23:59:59');
            })
            ->when(request()->filled('branch_id'), function ($query) {
                $query->where('branch_id', request('branch_id'));
            })
            ->when(request()->filled('doctor_id'), function ($query) {
                $query->where('doctor_id', request('doctor_id'));
            })
            ->where('is_paid', 1)
            ->get();

        foreach ($transactions as $transaction) {
            $examinationTreatments = $this->examinationTreatment->where('examination_id', $transaction->examination_id)->get();
            foreach ($examinationTreatments as $examinationTreatment) {
                $doctorBonus = $this->doctorBonus->where('examination_treatment_id', $examinationTreatment->id)->sum('bonus');
                $examinationTreatment->doctor_bonus = $doctorBonus;
            }
            $transaction->examination_treatments = $examinationTreatments;
        }

        $transactions = $transactions->map(function ($data) {
            return [
                'transaction_code' => $data->code,
                'transaction_date' => $data->created_at->format('Y-m-d'),
                'branch'           => $data->branch->name,
                'patient'          => $data->customer->name,
                'doctor'           => $data->doctor->name,
                'treatments'       => $data->examination_treatments->map(function ($treatment) {
                    return $treatment->treatment->name;
                })->implode(', '),
                'total_fee'        => $data->examination_treatments->sum('doctor_bonus')
            ];
        });

        return $transactions;
    }
}
