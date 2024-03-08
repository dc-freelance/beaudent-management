<?php

namespace App\Interfaces;

interface ExaminationInterface
{
    public function getAll();
    public function getById($id);
    public function store($data);
    public function update($id, $data);

    public function getExaminationByTransactionId($transactionId);
    public function getAllExaminationGroupByCustomer();
    public function getExaminationByCustomerId($customerId);
}
