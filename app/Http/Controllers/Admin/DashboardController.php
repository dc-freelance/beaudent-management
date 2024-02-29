<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DashboardInterface;
use Carbon\Carbon;

use function App\Helpers\rupiahFormat;

class DashboardController extends Controller
{
    private $dashboard_data;

    public function __construct(DashboardInterface $data)
    {
        $this->dashboard_data = $data;
    }

    public function index()
    {
        $data = array(
            'pemasukan' => rupiahFormat($this->dashboard_data->earnings()),
            'reservasi' => $this->dashboard_data->reservation(),
            'layanan' => $this->dashboard_data->treatments(),
            'pasien' => $this->dashboard_data->patient(),
            'dokter' => $this->dashboard_data->doctor(),
            'cabang' => $this->dashboard_data->branch()
        );

        return view('admin.dashboard.index', compact('data'));
    }

    public function chart($year)
    {
        $data = array(
            'pemasukan_bulan' => $this->dashboard_data->year_earnings($year)->toArray(),
            'pemasukan_tahun' => rupiahFormat(array_sum($this->dashboard_data->year_earnings($year)->toArray()))
        );

        return $data;
    }
}
