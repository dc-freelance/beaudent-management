<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionInterface
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
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
}
