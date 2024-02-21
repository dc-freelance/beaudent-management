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
        // $totalCashPayment = Reservations::where('user_id', auth()->user()->id)->where('status', 'paid')->sum('total_cash_payment');
        // $totalCashPayment = Reservations::with('treatments')
        //                     ->where('branch_id', auth()->user()->branch_id)
        //                     ->get();
        // dd($totalCashPayment);

        if ($checking != null) {
            return view('front-office.shift-log.close-shift', compact('checking'));
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
            $this->shiftLog->update($id, $request->all());

            return redirect()->route('front-office.shift-log.open-shift')->with('success', 'Shift Berhasil Ditutup!');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.shift-log.open-shift')->with('error', $th->getMessage());
        }
    }
}
