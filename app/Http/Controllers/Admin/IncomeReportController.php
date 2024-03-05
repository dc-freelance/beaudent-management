<?php

namespace App\Http\Controllers\Admin;

use App\Exports\IncomeReportDoctorExport;
use App\Exports\IncomeReportGeneralExport;
use App\Http\Controllers\Controller;
use App\Interfaces\BranchInterface;
use App\Interfaces\DoctorInterface;
use App\Interfaces\IncomeReportInterface;
use Illuminate\Http\Request;

class IncomeReportController extends Controller
{
    private $incomeReport;
    private $branch;
    private $doctor;

    public function __construct(IncomeReportInterface $incomeReport, BranchInterface $branch, DoctorInterface $doctor)
    {
        $this->incomeReport = $incomeReport;
        $this->branch       = $branch;
        $this->doctor       = $doctor;
    }

    public function getGeneral(Request $request)
    {
        $results = $this->incomeReport->getGeneral();
        if (auth()->user()->hasRole('admin_cabang')) {
            $results = $results->where('branch_id', auth()->user()->branch_id);
        }

        if ($request->ajax()) {
            return view('admin.income_report.tables.general', compact('results'))->render();
        }

        $branches = $this->branch->get();
        return view('admin.income_report.index', compact('branches'));
    }

    public function exportGeneral(Request $request)
    {
        $results = $this->incomeReport->exportGeneral();

        $prefix = 'Laporan Pendapatan Umum';
        if ($request->branch_id) {
            $branch = $this->branch->getById($request->branch_id);
            $prefix = 'Laporan Pendapatan ' . $branch->name;
        }
        $filename = $prefix . ' ' . date('d-m-Y') . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new IncomeReportGeneralExport($results), $filename);
    }

    public function getDoctor(Request $request)
    {
        $results = $this->incomeReport->getDoctor();
        if (auth()->user()->hasRole('admin_cabang')) {
            $results = $results->where('branch_id', auth()->user()->branch_id);
        }

        if ($request->ajax()) {
            return view('admin.income_report.tables.doctor', compact('results'))->render();
        }

        $branches = $this->branch->get();
        $doctors = $this->doctor->get();
        return view('admin.income_report.doctor', compact('branches', 'doctors'));
    }

    public function exportDoctor(Request $request)
    {
        $results = $this->incomeReport->exportDoctor();
        $prefix = 'Laporan Pendapatan Dokter';
        if ($request->branch_id) {
            $branch = $this->branch->getById($request->branch_id);
            $prefix = 'Laporan Pendapatan ' . $branch->name . ' Dokter';
        }
        if ($request->doctor_id) {
            $doctor = $this->doctor->getById($request->doctor_id);
            $prefix = 'Laporan Pendapatan ' . $doctor->name;
        }
        $filename = $prefix . ' ' . date('d-m-Y') . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new IncomeReportDoctorExport($results), $filename);
    }
}
