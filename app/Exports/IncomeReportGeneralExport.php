<?php

namespace App\Exports;

use App\Interfaces\IncomeReportInterface;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncomeReportGeneralExport implements FromCollection, WithHeadings
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Tanggal',
            'Cabang',
            'Pasien',
            'Metode Pembayaran',
            'Total',
            'Diskon',
            'Total PPN',
            'Grand Total'
        ];
    }

    public function collection()
    {
        return $this->data;
    }
}
