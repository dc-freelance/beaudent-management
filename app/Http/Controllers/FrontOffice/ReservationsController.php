<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Interfaces\ReservationsInterface;
use App\Mail\ReservationConfirmation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ReservationsController extends Controller
{
    private $reservations;

    public function __construct(ReservationsInterface $reservations)
    {
        $this->reservations = $reservations;
    }

    public function reservations(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservations->datatable_reservations())
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('branch_id', function ($data) {
                    return $data->branches->name;
                })
                ->addColumn('request_date', function ($data) {
                    return Carbon::parse($data->request_date)->locale('id')->isoFormat('LL');
                })
                ->addColumn('request_time', function ($data) {
                    return Carbon::parse($data->request_time)->locale('id')->isoFormat('LT');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
                })
                ->addColumn('is_control', function ($data) {
                    return $data->is_control ? 'Kontrol' : 'Perawatan';
                })

                ->addColumn('action', function ($data) {
                    return view('front-office.reservations.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('front-office.reservations.reservations');
    }

    public function cancel_reservations(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservations->datatable_cancel_reservations())
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('branch_id', function ($data) {
                    return $data->branches->name;
                })
                ->addColumn('request_date', function ($data) {
                    return Carbon::parse($data->request_date)->locale('id')->isoFormat('LL');
                })
                ->addColumn('request_time', function ($data) {
                    return Carbon::parse($data->request_time)->locale('id')->isoFormat('LT');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
                })
                ->addColumn('is_control', function ($data) {
                    return $data->is_control ? 'Kontrol' : 'Perawatan';
                })

                ->addColumn('action', function ($data) {
                    return view('front-office.reservations.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('front-office.reservations.cancel_reservations');
    }

    public function confirm_reservations(Request $request)
    {
        $date = $request->input('date');
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservations->datatable_confirm_reservations($date))
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('branch_id', function ($data) {
                    return $data->branches->name;
                })
                ->addColumn('request_date', function ($data) {
                    return Carbon::parse($data->request_date)->locale('id')->isoFormat('LL');
                })
                ->addColumn('request_time', function ($data) {
                    return Carbon::parse($data->request_time)->locale('id')->isoFormat('LT');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
                })
                ->addColumn('is_control', function ($data) {
                    return $data->is_control ? 'Kontrol' : 'Perawatan';
                })

                ->addColumn('action', function ($data) {
                    return view('front-office.reservations.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('front-office.reservations.confirm_reservations', compact('date'));
    }

    public function reschedule($id)
    {
        $data = $this->reservations->getById($id);
        $reservation = $this->reservations->datatable_confirm_reservations();

        return view('front-office.reservations.reschedule', compact('data', 'reservation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'request_date' => 'required',
            'request_time' => 'required',
            'reasons' => 'required',
        ]);

        try {
            $this->reservations->reschedule($id, $request->all());

            return redirect()->route('front-office.reservations.confirm.index')->with('success', 'Penjadwalan Ulang Berhasil');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.reservations.confirm.index')->with('error', $th->getMessage());
        }
    }

    public function detail($id)
    {
        $data = $this->reservations->getById($id);

        return view('front-office.reservations.detail', compact('data'));
    }

    public function confirm($id)
    {
        try {
            $reservation = $this->reservations->getById($id);

            $this->reservations->confirm($id);
            Mail::to($reservation->customers->email)->send(new ReservationConfirmation($reservation, true));

            return redirect()->route('front-office.reservations.wait.index')->with('success', 'Reservasi telah dikonfirmasi');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.reservations.wait.index')->with('error', $th->getMessage());
        }
    }

    public function cancel($id)
    {
        try {
            $reservation = $this->reservations->getById($id);

            $this->reservations->cancel($id);
            Mail::to($reservation->customers->email)->send(new ReservationConfirmation($reservation, false));

            return redirect()->route('front-office.reservations.wait.index')->with('success', 'Reservasi telah dibatalkan');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.reservations.wait.index')->with('error', $th->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            $this->reservations->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Reservasi berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
