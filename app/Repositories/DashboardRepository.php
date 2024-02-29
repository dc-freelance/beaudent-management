<?php

namespace App\Repositories;

use App\Interfaces\DashboardInterface;
use App\Models\Branch;
use App\Models\Customers;
use App\Models\Doctor;
use App\Models\Reservations;
use App\Models\Transaction;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardRepository implements DashboardInterface
{
    private $transaction;
    private $reservation;
    private $treatments;
    private $patient;
    private $doctor;
    private $branch;

    public function __construct(Transaction $transaction, Reservations $reservation, Treatment $treatments, Doctor $doctor, Customers $patient, Branch $branch)
    {
        $this->transaction = $transaction;
        $this->reservation = $reservation;
        $this->treatments = $treatments;
        $this->doctor = $doctor;
        $this->patient = $patient;
        $this->branch = $branch;
    }

    public function getAvailableYear()
    {
        $transaction = $this->transaction->select('date_time')->get();
        $dump_years = [];

        foreach ($transaction as $data) {
            if (!in_array(Carbon::parse($data->date_time)->format('Y'), $dump_years)) {
                array_push($dump_years, Carbon::parse($data->date_time)->format('Y'));
            };
        };

        return $dump_years;
    }

    public function earnings()
    {
        $data = null;
        Auth::user()->branch_id == null ?
            $data = $this->transaction
            ->whereYear('date_time', Carbon::now()->format('Y'))
            ->whereMonth('date_time', Carbon::now()->format('m'))
            ->where('is_paid', 1)
            ->sum('grand_total')
            :
            $data = $this->transaction
            ->where('branch_id', Auth::user()->branch_id)
            ->whereYear('date_time', Carbon::now()->format('Y'))
            ->whereMonth('date_time', Carbon::now()->format('m'))
            ->where('is_paid', 1)
            ->sum('grand_total');
        return $data;
    }

    public function year_earnings($year)
    {
        $data = null;
        Auth::user()->branch_id == null ?
            $data = $this->transaction
            ->select('id', 'date_time', 'grand_total')
            ->whereYear('date_time', $year)
            ->where('is_paid', 1)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date_time)->format('m');
            })
            ->map(function ($item) {
                return $item->sum('grand_total');
            })
            :
            $data = $this->transaction
            ->select('id', 'date_time', 'grand_total')
            ->where('branch_id', Auth::user()->branch_id)
            ->whereYear('date_time', $year)
            ->where('is_paid', 1)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date_time)->format('m');
            })
            ->map(function ($item) {
                return $item->sum('grand_total');
            });
        return $data;
    }

    public function reservation()
    {
        $data = null;
        Auth::user()->branch_id == null ?
            $data = $this->reservation->whereYear('created_at', Carbon::now()->format('Y'))->whereMonth('created_at', Carbon::now()->format('m'))->count()
            :
            null;
        return $data;
    }

    public function treatments()
    {
        return $this->treatments->count();
    }

    public function patient()
    {
        return $this->patient->count();
    }

    public function doctor()
    {
        return $this->doctor->count();
    }

    public function branch()
    {
        return $this->branch->count();
    }
}
