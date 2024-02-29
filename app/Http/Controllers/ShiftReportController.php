<?php

namespace App\Http\Controllers;

use App\Exports\ShiftReportGeneralExport;
use App\Interfaces\BranchInterface;
use App\Interfaces\ShiftReportInterface;
use Illuminate\Http\Request;

class ShiftReportController extends Controller
{
    private $shiftReport;
    private $branch;

    public function __construct(ShiftReportInterface $shiftReport, BranchInterface $branch)
    {
        $this->shiftReport = $shiftReport;
        $this->branch      = $branch;
    }

    public function getGeneral(Request $request)
    {
        $results = $this->shiftReport->getGeneral();
        if ($request->ajax()) {
            return datatables()
                ->of($results)
                ->addColumn('tanggal', function ($data) {
                    return date('Y-m-d', strtotime($data->tanggal));
                })
                ->addColumn('shift', function ($data) {
                    return $data->config_shift->name;
                })
                ->addColumn('user', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('cabang', function ($data) {
                    return $data->branch->name;
                })
                ->addColumn('sub_total', function ($data) {
                    return number_format($data->sub_total, 0, ',', '.');
                })
                ->addIndexColumn()
                ->make(true);
        }

        $branches = $this->branch->get();
        return view('admin.shift_report.index', compact('branches'));
    }

    public function exportGeneral(Request $request)
    {

        $results = $this->shiftReport->getGeneral();
        $prefix = 'Laporan Shif';
        if ($request->branch_id != 'all') {
            $branch = $this->branch->getById($request->branch_id);
            $prefix = 'Laporan Shift ' . $branch->name;
        } else {
            $prefix = 'Laporan Shift Semua cabang';
        }
        $filename = $prefix . ' ' . date('d-m-Y') . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new ShiftReportGeneralExport($results), $filename);
    }
}
