<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function list_billing();

    public function list_transaction();

    public function detail_transaction($id);
}
