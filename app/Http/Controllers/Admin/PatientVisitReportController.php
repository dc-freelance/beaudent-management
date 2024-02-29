<?php

namespace App\Http\Controllers\Admin;

use App\Exports\IncomeReportGeneralExport;
use App\Exports\PatientVisitReportGeneralExport;
use App\Http\Controllers\Controller;
use App\Interfaces\BranchInterface;
use App\Interfaces\PatientVisitReportInterface;
use Illuminate\Http\Request;

class PatientVisitReportController extends Controller
{
    private $patientVisitReport;
    private $branch;

    public function __construct(PatientVisitReportInterface $patientVisitReport, BranchInterface $branch)
    {
        $this->patientVisitReport = $patientVisitReport;
        $this->branch             = $branch;
    }

    public function getGeneral(Request $request)
    {
        $results = $this->patientVisitReport->getGeneral();
        if ($request->ajax()) {
            return datatables()
                ->of($results)
                ->addColumn('name', function ($data) {
                    return $data->customer->name;
                })
                ->addColumn('phone_number', function ($data) {
                    return $data->customer->phone_number;
                })
                ->addColumn('email', function ($data) {
                    return $data->customer->email;
                })
                ->addColumn('total_data', function ($data) {
                    return $data->total_data;
                })
                ->addIndexColumn()
                ->make(true);
        }

        $branches = $this->branch->get();
        return view('admin.patient_visit_report.index', compact('branches'));
    }

    public function exportGeneral(Request $request)
    {
        $results = $this->patientVisitReport->getGeneral();
        $prefix = 'Laporan Kunjungan Pasien';
        if ($request->branch_id != 'all') {
            $branch = $this->branch->getById($request->branch_id);
            $prefix = 'Laporan Kunjungan Pasien ' . $branch->name;
        } else {
            $prefix = 'Laporan Kunjungan Pasien Semua Cabang';
        }
        $filename = $prefix . ' ' . date('d-m-Y') . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new PatientVisitReportGeneralExport($results), $filename);
    }
}
