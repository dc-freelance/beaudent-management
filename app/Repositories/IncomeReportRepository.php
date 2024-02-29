<?php

namespace App\Repositories;

use App\Interfaces\IncomeReportInterface;
use App\Models\Transaction;

class IncomeReportRepository implements IncomeReportInterface
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
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
}
