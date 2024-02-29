<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncomeReportDoctorExport implements FromCollection, WithHeadings
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
            'Dokter',
            'Layanan',
            'Bonus Dokter',
        ];
    }

    public function collection()
    {
        return $this->data;
    }
}
