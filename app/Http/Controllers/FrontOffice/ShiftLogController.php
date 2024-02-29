<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Interfaces\ShiftLogInterface;
use App\Interfaces\ConfigShiftInterface;
use App\Interfaces\UserManagementInterface;
use App\Interfaces\BranchInterface;
use App\Interfaces\ReservationsInterface;

use App\Models\Reservations;
use Illuminate\Http\Request;
use PDF;

class ShiftLogController extends Controller
{
    private $shiftLog;
    private $configShift;
    private $userManagement;
    private $branch;
    private $reservation;

    public function __construct(ShiftLogInterface $shiftLog, ConfigShiftInterface $configShift, UserManagementInterface $userManagement, BranchInterface $branch, ReservationsInterface $reservation)
    {
        $this->shiftLog = $shiftLog;
        $this->configShift = $configShift;
        $this->userManagement = $userManagement;
        $this->branch = $branch;
        $this->reservation = $reservation;
    }

    public function open_shift()
    {
        $configShift = $this->configShift->get();
        $checking = $this->shiftLog->validation_close_shift();

        return view('front-office.shift-log.open-shift', compact('configShift', 'checking'));
    }

    public function open_shift_create(Request $request)
    {
        $request->validate([
            'shift_id' => 'required',
            'user' => 'required',
        ]);

        try {
            $this->shiftLog->store($request->all());

            return redirect()->route('front-office.shift-log.open-shift')->with('success', 'Shift Berhasil Dibuka!');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.shift-log.open-shift')->with('error', $th->getMessage());
        }
    }

    public function close_shift()
    {
        $checking = $this->shiftLog->validation_open_shift();
        $totalCashPayment = $this->shiftLog->sum_transaction_close_shift();
        // $totalCashPayment = Reservations::where('user_id', auth()->user()->id)->where('status', 'paid')->sum('total_cash_payment');
        // $totalCashPayment = Reservations::with('treatments')
        //                     ->where('branch_id', auth()->user()->branch_id)
        //                     ->get();
        // dd($totalCashPayment);

        if ($checking != null) {
            return view('front-office.shift-log.close-shift', compact('checking', 'totalCashPayment'));
        } else {
            return redirect()->route('front-office.shift-log.open-shift')->with('error', "Anda Harus Buka Sesi Terlebih Dahulu!");
        }
    }

    public function close_shift_update(Request $request, $id)
    {
        $request->validate([
            'user' => 'required',
            'total_cash_payment' => 'required',
            'total_cash_received' => 'required',
        ]);

        try {
            $request->merge([
                'total_cash_received' => str_replace(['Rp.', '.', ','], '', $request->input('total_cash_received'))
            ]);
            $this->shiftLog->update($id, $request->all());

            return redirect()->route('front-office.shift-log.open-shift')->with('success', 'Shift Berhasil Ditutup!');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.shift-log.open-shift')->with('error', $th->getMessage());
        }
    }

    public function recap_shift(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->shiftLog->recap_shift())
                ->addColumn('config_shift', function ($data) {
                    return $data->config_shift->name;
                })
                ->addColumn('start_time', function ($data) {
                    return $data->start_time;
                })
                ->addColumn('end_time', function ($data) {
                    return $data->end_time;
                })
                ->addColumn('user', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('branch', function ($data) {
                    return $data->branch->name;
                })
                ->addColumn('total_cash_payment', function ($data) {
                    return 'Rp. ' . number_format($data->total_cash_payment, 0, ',', '.');
                })
                ->addColumn('total_cash_received', function ($data) {
                    return 'Rp. ' . number_format($data->total_cash_received, 0, ',', '.');
                })
                ->addColumn('action', function ($data) {
                    return view('front-office.shift-log.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('front-office.shift-log.recap-shift');
    }

    public function recap_shift_pdf($shiftLog)
    {
        $pdf = $this->shiftLog->recap_shift_pdf($shiftLog);
        $cash = $this->shiftLog->sum_recap_shift_cash($pdf->branch_id, $pdf->start_time, $pdf->end_time);
        $transfer = $this->shiftLog->sum_recap_shift_transfer($pdf->branch_id, $pdf->start_time, $pdf->end_time);
        $card = $this->shiftLog->sum_recap_shift_card($pdf->branch_id, $pdf->start_time, $pdf->end_time);

        // return view('front-office.shift-log.recap-shift-pdf', compact('pdf', 'cash', 'transfer', 'card'));

        $print = PDF::loadview('front-office.shift-log.recap-shift-pdf', compact('pdf', 'cash', 'transfer', 'card'));
        return $print->download('shift-recap.pdf');
    }
}
