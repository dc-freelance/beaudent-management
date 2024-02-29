<?php

namespace App\Repositories;

use App\Interfaces\PatientVisitReportInterface;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class PatientVisitReportRepository implements PatientVisitReportInterface
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getGeneral()
    {
        $results = $this->transaction
                    ->with('branch','customer')
                    ->select(
                        'transactions.customer_id',
                        DB::raw('COUNT(transactions.id) as total_data'),
                    )
                    ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                        $query->whereBetween('date_time', [request('start_date'), request('end_date')]);
                    })
                    ->when(request()->filled('branch_id'), function ($query) {
                        if (request('branch_id') != 'all') {
                            $query->whereRelation('branch', 'id', request('branch_id'));
                        }
                    })
                    ->where('is_paid', 1)
                    ->groupBy('transactions.customer_id')
                    ->orderBy('total_data', 'DESC')
                    ->get();
        return $results;
    }

    public function exportGeneral()
    {
        $results = $this->transaction
            ->with('branch', 'customer')
            ->select(
                'transactions.customer_id',
                DB::raw('COUNT(transactions.id) as total_data'),
            )
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->whereBetween('date_time', [request('start_date'), request('end_date')]);
            })
            ->when(request()->filled('branch_id'), function ($query) {
                $query->where('branch_id', request('branch_id'));
            })
            ->where('is_paid', 1)
            ->whereNull('transactions.deleted_at')
            ->groupBy('transactions.customer_id')
            ->orderBy('total_data', 'DESC')
            ->get();

        return $results;
    }
}
