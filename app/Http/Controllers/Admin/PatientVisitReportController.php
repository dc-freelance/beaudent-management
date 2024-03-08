<?php

namespace App\Http\Controllers\Admin;

use App\Exports\IncomeReportGeneralExport;
use App\Exports\PatientVisitReportGeneralExport;
use App\Http\Controllers\Controller;
use App\Interfaces\BranchInterface;
use App\Interfaces\PatientVisitReportInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function Ramsey\Uuid\v1;

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
            return view('admin.patient_visit_report.table.patient-visit', compact('results'));
        }

        $branches = $this->branch->get()->where('code', '!=', 'PST');
        return view('admin.patient_visit_report.index', compact('branches'));
    }

    public function exportGeneral(Request $request)
    {
        $data = $this->patientVisitReport->getGeneral();
        $prefix = 'Laporan Kunjungan Pasien';
        if ($request->branch_id != 'all') {
            $branch = $this->branch->getById($request->branch_id);
            $prefix = 'Laporan Kunjungan Pasien ' . $branch->name;
        } else {
            $prefix = 'Laporan Kunjungan Pasien Semua Cabang';
        }
        $filename = $prefix . ' ' . date('d-m-Y') . '.xlsx';
        return Excel::download(new PatientVisitReportGeneralExport($data), $filename);
    }
}
