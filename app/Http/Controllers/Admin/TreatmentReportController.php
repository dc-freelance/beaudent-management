<?php

namespace App\Http\Controllers\Admin;

use App\Exports\IncomeReportGeneralExport;
use App\Exports\TreatmentReportGeneralExport;
use App\Http\Controllers\Controller;
use App\Interfaces\BranchInterface;
use App\Interfaces\TreatmentReportInterface;
use Illuminate\Http\Request;

class TreatmentReportController extends Controller
{
    private $treatmentReport;
    private $branch;

    public function __construct(TreatmentReportInterface $treatmentReport, BranchInterface $branch)
    {
        $this->treatmentReport = $treatmentReport;
        $this->branch       = $branch;
    }
    public function getGeneral(Request $request)
    {
        $results =  $this->treatmentReport->getGeneral();
        if (auth()->user()->hasRole('admin_cabang')) {
            $results = $results->where('branch_id', auth()->user()->branch_id);
        }
        if ($request->ajax()) {
            return view('admin.treatment_report.table.treatment_report', compact('results'));
        }

        $branches = collect($this->branch->get());
        $branches = $branches->where('id', '!=', 1);
        return view('admin.treatment_report.index', compact('branches'));
    }

    public function exportGeneral(Request $request)
    {
        $results = $this->treatmentReport->exportGeneral();
        $prefix = 'Laporan Layanan';
        if ($request->branch_id) {
            $branch = $this->branch->getById($request->branch_id);
            $prefix = 'Laporan Layanan ' . $branch->name;
        }
        $filename = $prefix . ' ' . date('d-m-Y') . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new TreatmentReportGeneralExport($results), $filename);
    }
}
