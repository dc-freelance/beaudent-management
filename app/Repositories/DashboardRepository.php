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
        $transaction = null;
        Auth::user()->branch_id == 1 ?
            $transaction = $this->transaction->select('date_time')->where('is_paid', 1)->orderBy('date_time', 'desc')->get()
            :
            $transaction = $this->transaction->select('date_time')->where('branch_id', Auth::user()->branch_id)->where('is_paid', 1)->orderBy('date_time', 'desc')->get();

        $dump_years = [];

        if (isset($transaction)) {
            foreach ($transaction as $data) {
                if (!in_array(Carbon::parse($data->date_time)->format('Y'), $dump_years)) {
                    array_push($dump_years, Carbon::parse($data->date_time)->format('Y'));
                };
            };
        };

        return $dump_years;
    }

    public function earnings()
    {
        $data = null;
        Auth::user()->branch_id == 1 ?
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

    public function year_earnings($branch = null, $year)
    {
        $data = null;
        if (Auth::user()->branch_id == 1) {
            if ($branch == null || $branch == 0) {
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
                    });
            } else {
                $data = $this->transaction
                    ->select('id', 'date_time', 'grand_total')
                    ->where('branch_id', $branch)
                    ->whereYear('date_time', $year)
                    ->where('is_paid', 1)
                    ->get()
                    ->groupBy(function ($date) {
                        return Carbon::parse($date->date_time)->format('m');
                    })
                    ->map(function ($item) {
                        return $item->sum('grand_total');
                    });
            };
        } else {
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
        };

        return $data;
    }

    public function reservation()
    {
        $data = null;
        Auth::user()->branch_id == 1 ?
            $data = $this->reservation->whereYear('request_date', Carbon::now()->format('Y'))->whereMonth('request_date', Carbon::now()->format('m'))->count()
            :
            $data = $this->reservation->where('branch_id', Auth::user()->branch_id)->whereYear('request_date', Carbon::now()->format('Y'))->whereMonth('request_date', Carbon::now()->format('m'))->count();
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
