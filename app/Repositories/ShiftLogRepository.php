<?php

namespace App\Repositories;

use App\Interfaces\ShiftLogInterface;
use App\Models\ShiftLog;
use App\Models\Transaction;
use Carbon\Carbon;

class ShiftLogRepository implements ShiftLogInterface
{
    private $shiftLog;

    public function __construct(ShiftLog $shiftLog)
    {
        $this->shiftLog = $shiftLog;
    }

    public function get()
    {
        return $this->shiftLog->all()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->shiftLog->find($id);
    }

    public function store($data)
    {
        $this->shiftLog->create([
            'config_shift_id' => $data['shift_id'],
            'start_time' => now(),
            'user_id' => auth()->user()->id,
            'branch_id' => auth()->user()->branch_id
        ]);
    }

    public function update($id, $data)
    {
        $shiftLog = $this->shiftLog->find($id);
        $shiftLog->update([
            'end_time' => now(),
            'total_cash_payment' => $data['total_cash_payment'],
            'total_cash_received' => $data['total_cash_received']
        ]);
    }

    public function delete($id)
    {
        $shiftLog = $this->shiftLog->find($id);
        $shiftLog->delete();
    }

    public function validation_open_shift()
    {
        $currentDate = Carbon::now()->toDateString();
        $logExists = ShiftLog::where('start_time', '>=', $currentDate)
                            ->where('user_id', auth()->user()->id)
                            ->where('branch_id', auth()->user()->branch_id)
                            ->where('end_time', null)
                            ->first();
        return $logExists;
    }

    public function validation_close_shift()
    {
        $currentDate = Carbon::now()->toDateString();
        $logExists = ShiftLog::with('config_shift', 'user', 'branch')
                            ->where('start_time', '>=', $currentDate)
                            ->where('user_id', auth()->user()->id)
                            ->where('branch_id', auth()->user()->branch_id)
                            ->where('end_time', null)
                            ->first();
        
        return $logExists;
    }

    public function sum_transaction_close_shift()
    {
        $currentDate = Carbon::now()->toDateString();
        $totalCashPayment = Transaction::where('date_time', '>=', $currentDate)
                                        ->where('branch_id', auth()->user()->branch_id)
                                        ->where('is_paid', 1)
                                        ->where('payment_method_id', 1)
                                        ->sum('grand_total');

        return $totalCashPayment;
    }

    public function recap_shift()
    {
        return $this->shiftLog->with('config_shift', 'user', 'branch')->where('branch_id', auth()->user()->branch_id)->get();
    }

    public function recap_shift_pdf($id)
    {
        return $shiftLog = $this->shiftLog->with('config_shift', 'user', 'branch')->where('id', $id)->first();
    }

    public function sum_recap_shift_cash($branch, $start, $end)
    {
        $totalSum = Transaction::where('date_time', '>=', $start)
                               ->where('date_time', '<=', $end)
                               ->where('branch_id', $branch)
                               ->where('is_paid', 1)
                               ->where('payment_method_id', 1)
                               ->sum('grand_total');
        return $totalSum;
    }

    public function sum_recap_shift_transfer($branch, $start, $end)
    {
        $totalSum = Transaction::where('date_time', '>=', $start)
                               ->where('date_time', '<=', $end)
                               ->where('branch_id', $branch)
                               ->where('is_paid', 1)
                               ->where('payment_method_id', 2)
                               ->sum('grand_total');
        return $totalSum;
    }
    
    public function sum_recap_shift_card($branch, $start, $end)
    {
        $totalSum = Transaction::where('date_time', '>=', $start)
                               ->where('date_time', '<=', $end)
                               ->where('branch_id', $branch)
                               ->where('is_paid', 1)
                               ->where('payment_method_id', 3)
                               ->sum('grand_total');
        return $totalSum;
    }
}
