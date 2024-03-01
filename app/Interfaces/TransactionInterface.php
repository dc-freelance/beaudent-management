<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function list_billing();
    public function list_transaction();
    public function detail_transaction($id);

    public function getByExaminationId($examination_id);
    public function getExaminationTreatments($examination_id);
    public function getExaminationItems($examination_id);
    public function getExaminationAddons($examination_id);
    public function getTransactionSummary($examination_id);
}
