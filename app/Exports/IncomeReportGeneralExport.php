<?php

namespace App\Exports;

use App\Interfaces\IncomeReportInterface;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class IncomeReportGeneralExport implements FromCollection
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }
}
