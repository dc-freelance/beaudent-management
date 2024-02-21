<?php

namespace App\Interfaces;

interface ShiftLogInterface
{
    public function get();

    public function getById($id);

    public function store($data);

    public function update($id, $data);

    public function delete($id);

    public function validation_open_shift();

    public function validation_close_shift();

    public function sum_transaction_close_shift();

    public function recap_shift();

    public function recap_shift_pdf($id);

    public function sum_recap_shift_cash($branch, $start, $end);

    public function sum_recap_shift_transfer($branch, $start, $end);

    public function sum_recap_shift_card($branch, $start, $end);
}
