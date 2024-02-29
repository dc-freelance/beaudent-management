<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DashboardInterface;
use App\Models\Reservations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use function App\Helpers\rupiahFormat;

class DashboardController extends Controller
{
    private $dashboard_data;

    private $reservation_model;

    public function __construct(DashboardInterface $data)
    {
        $this->dashboard_data = $data;
        $this->reservation_model = new Reservations();
    }

    public function index(Request $request)
    {
        $data = array(
            'pemasukan' => rupiahFormat($this->dashboard_data->earnings()),
            'reservasi' => $this->dashboard_data->reservation(),
            'layanan' => $this->dashboard_data->treatments(),
            'pasien' => $this->dashboard_data->patient(),
            'dokter' => $this->dashboard_data->doctor(),
            'cabang' => $this->dashboard_data->branch(),
            'years' => $this->dashboard_data->getAvailableYear()
        );
        $query = null;
        if (Auth::user()->branch_id == null) {
            $query = $this->reservation_model->with('customers', 'branches')
                ->where('status', 'Pending')
                ->orderBy('request_date', 'asc')
                ->orderBy('request_time', 'asc')
                ->get();
        } else {
            $query = $this->reservation_model->with('customers', 'branches')
                ->where('branch_id', Auth::user()->branch_id)
                ->where('status', 'Pending')
                ->orderBy('request_date', 'asc')
                ->orderBy('request_time', 'asc')
                ->get();
        }

        if ($query->isNotEmpty()) {
            foreach ($query as $reservation) {
                if ($reservation->deposit != null) {
                    $reservation->deposit = rupiahFormat($reservation->deposit);
                }
            }
        }

        if ($request->ajax()) {
            return datatables()
                ->of($query)
                ->addColumn('id', function ($data) {
                    return $data->id;
                })
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('customer_name', function ($data) {
                    return $data->customers->name;
                })
                ->addColumn('branch_name', function ($data) {
                    return $data->branches->name;
                })
                ->addColumn('request_date', function ($data) {
                    return Carbon::parse($data->request_date)->locale('id')->isoFormat('LL');
                })
                ->addColumn('request_time', function ($data) {
                    return Carbon::parse($data->request_time)->locale('id')->isoFormat('LT');
                })
                ->addColumn('is_control', function ($data) {
                    return $data->is_control ? 'Kontrol' : 'Perawatan';
                })
                ->addIndexColumn()
                ->make(true);
            # code...
        }

        return view('admin.dashboard.index', compact('data'));
    }

    public function chart($year)
    {
        $data = array(
            'pemasukan_bulan' => $this->dashboard_data->year_earnings($year)->toArray(),
            'pemasukan_tahun' => rupiahFormat(array_sum($this->dashboard_data->year_earnings($year)->toArray())),
            'year' => $year
        );

        return $data;
    }

    public function getReservation() {
        $query = null;
        if (Auth::user()->branch_id == null) {
            $query = $this->reservation_model->with('customers', 'branches')
                ->where('status', 'Pending')
                ->orderBy('request_date', 'asc')
                ->orderBy('request_time', 'asc')
                ->get();
        } else {
            $query = $this->reservation_model->with('customers', 'branches')
                ->where('branch_id', Auth::user()->branch_id)
                ->where('status', 'Pending')
                ->orderBy('request_date', 'asc')
                ->orderBy('request_time', 'asc')
                ->get();
        }

        if ($query->isNotEmpty()) {
            foreach ($query as $reservation) {
                if ($reservation->deposit != null) {
                    $reservation->deposit = rupiahFormat($reservation->deposit);
                }
            }
        }

        return datatables()
            ->of($query)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('no', function ($data) {
                return $data->no;
            })
            ->addColumn('customer_name', function ($data) {
                return $data->customers->name;
            })
            ->addColumn('branch_name', function ($data) {
                return $data->branches->name;
            })
            ->addColumn('request_date', function ($data) {
                return Carbon::parse($data->request_date)->locale('id')->isoFormat('LL');
            })
            ->addColumn('request_time', function ($data) {
                return Carbon::parse($data->request_time)->locale('id')->isoFormat('LT');
            })
            ->addColumn('is_control', function ($data) {
                return $data->is_control ? 'Kontrol' : 'Perawatan';
            })
            ->addIndexColumn()
            ->make(true);
    }
}
