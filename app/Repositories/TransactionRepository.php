<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;
use App\Models\AddonExamination;
use App\Models\ExaminationItem;
use App\Models\ExaminationTreatment;
use App\Models\Transaction;

class TransactionRepository implements TransactionInterface
{
    private $transaction;
    private $examinationTreatment;
    private $examinationItem;
    private $examinationAddon;

    public function __construct(Transaction $transaction, ExaminationTreatment $examinationTreatment, ExaminationItem $examinationItem, AddonExamination $examinationAddon)
    {
        $this->transaction          = $transaction;
        $this->examinationTreatment = $examinationTreatment;
        $this->examinationItem      = $examinationItem;
        $this->examinationAddon     = $examinationAddon;
    }

    public function list_billing()
    {
        return $this->transaction->with('branch', 'doctor', 'customer', 'payment_method', 'cashier', 'examination')
            ->where('is_paid', 0)
            ->where('branch_id', auth()->user()->branch_id)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function list_transaction()
    {
        return $this->transaction->with('branch', 'doctor', 'customer', 'payment_method', 'cashier', 'examination')
            ->where('is_paid', 1)
            ->where('branch_id', auth()->user()->branch_id)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function detail_transaction($id)
    {
        return $this->transaction->with('branch', 'doctor', 'customer', 'payment_method', 'cashier', 'examination')
            ->where('id', $id)
            ->first();
    }

    public function getExaminationTreatments($examination_id)
    {
        return $this->examinationTreatment
            ->with('treatment')
            ->where('examination_id', $examination_id)->get();
    }

    public function getExaminationItems($examination_id)
    {
        return $this->examinationItem->where('examination_id', $examination_id)->get();
    }

    public function getExaminationAddons($examination_id)
    {
        return $this->examinationAddon->where('examination_id', $examination_id)->get();
    }

    public function getTransactionSummary($examination_id)
    {
        $treatments = $this->examinationTreatment
            ->where('examination_id', $examination_id)
            ->sum('sub_total');

        $items = $this->examinationItem
            ->where('examination_id', $examination_id)
            ->sum('sub_total');

        $addons = $this->examinationAddon
            ->where('examination_id', $examination_id)
            ->sum('sub_total');

        $treatments = $treatments ?? 0;
        $items      = $items ?? 0;
        $addons     = $addons ?? 0;

        return [
            'treatments' => $treatments,
            'items'      => $items,
            'addons'     => $addons,
            'total'      => $treatments + $items + $addons,
        ];
    }

    public function getByExaminationId($examination_id)
    {
        return $this->transaction->where('examination_id', $examination_id)->first();
    }
}
