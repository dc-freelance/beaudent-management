<?php

namespace App\Repositories;

use App\Interfaces\ShiftReportInterface;
use App\Models\ShiftLog;
use App\Models\Transaction;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

class ShiftReportRepository implements ShiftReportInterface
{
    private $shiftLog;

    public function __construct(ShiftLog $shiftLog)
    {
        $this->shiftLog = $shiftLog;
    }

    public function getGeneral()
    {
        $results = $this->shiftLog
                    ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                        $query->where('created_at', '>=', request('start_date'))
                            ->where('created_at', '<=', request('end_date') . ' 23:59:59');
                    })
                    ->when(request()->filled('branch_id'), function ($query) {
                        if (request('branch_id') != 'all') {
                            $query->whereRelation('branch', 'id', request('branch_id'));
                        }
                    })
                    ->with('user', 'config_shift', 'branch')
                    ->select(
                        'shift_logs.config_shift_id',
                        'shift_logs.user_id',
                        'shift_logs.branch_id',
                        'created_at as tanggal',
                        DB::raw('SUM(total_cash_received) as sub_total'),
                    )
                    ->whereNull('deleted_at')
                    ->groupBy('config_shift_id')
                    ->orderBy('sub_total', 'DESC')
                    ->get();
        return $results;
    }
    public function exportGeneral(){
        $results = $this->shiftLog
            ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                $query->where('created_at', '>=', request('start_date'))
                ->where('created_at', '<=', request('end_date') . ' 23:59:59');
            })
            ->when(request()->filled('branch_id'), function ($query) {
                if (request('branch_id') != 'all') {
                    $query->where('shift_log.branch_id', request('branch_id'));
                }
            })
            ->with('user', 'config_shift', 'branch')
            ->select(
                'shift_logs.config_shift_id',
                'shift_logs.user_id',
                // 'shift_logs.branch_id',
                'created_at as tanggal',
                DB::raw('SUM(total_cash_received) as sub_total'),
            )
            ->whereNull('deleted_at')
            ->groupBy('config_shift_id')
            ->orderBy('sub_total', 'DESC')
            ->get();
        return $results;
    }
}
