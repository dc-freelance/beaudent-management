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
            return datatables()
                ->of($results)
                ->addColumn('code', function ($data) {
                    return $data->code;
                })
                ->addColumn('created_at', function ($data) {
                    return date('Y-m-d', strtotime($data->date_time));
                })
                ->addColumn('branch', function ($data) {
                    return $data->branch->name;
                })
                ->addColumn('patient', function ($data) {
                    return $data->customer->name;
                })
                ->addColumn('payment_method', function ($data) {
                    return $data->payment_method->name;
                })
                ->addColumn('total', function ($data) {
                    return number_format($data->total, 0, ',', '.');
                })
                ->addColumn('discount', function ($data) {
                    return number_format($data->discount, 0, ',', '.');
                })
                ->addColumn('total_ppn', function ($data) {
                    return number_format($data->total_ppn, 0, ',', '.');
                })
                ->addColumn('grand_total', function ($data) {
                    return number_format($data->grand_total, 0, ',', '.');
                })
                ->addIndexColumn()
                ->make(true);
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
            return datatables()
                ->of($results)
                ->addColumn('transaction_code', function ($data) {
                    return $data['transaction_code'];
                })
                ->addColumn('transaction_date', function ($data) {
                    return $data['transaction_date'];
                })
                ->addColumn('branch', function ($data) {
                    return $data['branch'];
                })
                ->addColumn('patient', function ($data) {
                    return $data['patient'];
                })
                ->addColumn('doctor', function ($data) {
                    return $data['doctor'];
                })
                ->addColumn('treatment', function ($data) {
                    return $data['treatments'];
                })
                ->addColumn('total_fee_treatment', function ($data) {
                    return number_format($data['total_fee_treatment'], 0, ',', '.');
                })
                ->addColumn('total_fee_addon', function ($data) {
                    return number_format($data['total_fee_addon'], 0, ',', '.');
                })
                ->addColumn('total_fee', function ($data) {
                    return number_format($data['total_fee'], 0, ',', '.');
                })
                ->addIndexColumn()
                ->make(true);
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
