<?php

namespace App\Repositories;

use App\Interfaces\IncomeReportInterface;
use App\Models\AddonExamination;
use App\Models\DoctorBonus;
use App\Models\ExaminationTreatment;
use App\Models\Transaction;

class IncomeReportRepository implements IncomeReportInterface
{
    private $transaction;
    private $doctorBonus;
    private $examinationTreatment;
    private $addonExamination;

    public function __construct(Transaction $transaction, DoctorBonus $doctorBonus, ExaminationTreatment $examinationTreatment, AddonExamination $addonExamination)
    {
        $this->transaction          = $transaction;
        $this->doctorBonus          = $doctorBonus;
        $this->examinationTreatment = $examinationTreatment;
        $this->addonExamination     = $addonExamination;
    }

    public function getGeneral()
    {
        $results = $this->transaction->where('is_paid', 1)->with(['branch', 'customer', 'payment_method'])
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->where('date_time', '>=', request('start_date'))
                    ->where('date_time', '<=', request('end_date') . ' 23:59:59');
            })
            ->when(request()->filled('branch_id'), function ($query) {
                $query->where('branch_id', request('branch_id'));
            })
            ->orderBy('date_time', 'desc')
            ->get();

        return $results;
    }

    public function exportGeneral()
    {
        $results = $this->transaction->where('is_paid', 1)->with(['branch', 'customer', 'payment_method'])
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->where('date_time', '>=', request('start_date'))
                    ->where('date_time', '<=', request('end_date') . ' 23:59:59');
            })
            ->when(request()->filled('branch_id'), function ($query) {
                $query->where('branch_id', request('branch_id'));
            })
            ->orderBy('date_time', 'desc')
            ->get();

        return $results->map(function ($data) {
            return [
                'transaction_code' => $data->code,
                'transaction_date' => date('Y-m-d', strtotime($data->date_time)),
                'branch'           => $data->branch->name,
                'patient'          => $data->customer->name,
                'payment_method'   => $data->payment_method->name,
                'total'            => $data->total,
                'discount'         => $data->discount,
                'total_ppn'        => $data->total_ppn,
                'grand_total'      => $data->grand_total,
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
                $doctorBonus                        = $this->doctorBonus->where('examination_treatment_id', $examinationTreatment->id)->sum('bonus');
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
                'total_fee_treatment' => $data->examination_treatments->sum('doctor_bonus'),
                'total_fee_addon'     => $data->examination->addonTransactions->sum('fee'),
                'total_fee'           => $data->examination_treatments->sum('doctor_bonus') + $data->examination->addonTransactions->sum('fee'),
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
                $doctorBonus                        = $this->doctorBonus->where('examination_treatment_id', $examinationTreatment->id)->sum('bonus');
                $examinationTreatment->doctor_bonus = $doctorBonus;
            }
            $transaction->examination_treatments = $examinationTreatments;
            $addonExamination                    = $this->addonExamination->where('examination_id', $transaction->examination_id)->get();
            $transaction->addonTransactions      = $addonExamination;
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
                'total_fee_treatment' => $data->examination_treatments->sum('doctor_bonus'),
                'total_fee_addon'     => $data->addonTransactions->sum('fee'),
                'total_fee'           => $data->examination_treatments->sum('doctor_bonus') + $data->addonTransactions->sum('fee'),
            ];
        });

        return $transactions;
    }
}
