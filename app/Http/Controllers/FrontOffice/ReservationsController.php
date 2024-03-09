<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Interfaces\ReservationsInterface;
use App\Mail\DepositConfirmation;
use App\Mail\Reschedule;
use App\Mail\ReservationConfirmation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use function App\Helpers\rupiahFormat;

class ReservationsController extends Controller
{
    private $reservations;

    public function __construct(ReservationsInterface $reservations)
    {
        $this->reservations = $reservations;
    }

    public function reservations(Request $request)
    {
        $date = $request->input('date');
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservations->datatable_reservations($date, 'Pending'))
                ->addColumn('id', function ($data) {
                    return $data->id;
                })
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('waktu_reservasi', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
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
                    return $data->is_control == 1 ? 'Kontrol' : 'Perawatan';
                })

                ->addColumn('action', function ($data) {
                    return view('front-office.reservations.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('front-office.reservations.reservations');
    }

    public function done(Request $request)
    {
        $date = $request->input('date');
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservations->datatable_reservations($date, 'Done'))
                ->addColumn('id', function ($data) {
                    return $data->id;
                })
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('waktu_reservasi', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
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
                    return $data->is_control == 1 ? 'Kontrol' : 'Perawatan';
                })

                ->addColumn('action', function ($data) {
                    return view('front-office.reservations.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('front-office.reservations.done');
    }

    public function deposit(Request $request)
    {
        $date = $request->input('date');
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservations->datatable_reservations($date, 'Pending Deposit'))
                ->addColumn('id', function ($data) {
                    return $data->id;
                })
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('waktu_reservasi', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
                })
                ->addColumn('branch_id', function ($data) {
                    return $data->branches->name;
                })
                ->addColumn('transfer_date', function ($data) {
                    return $data->transfer_date;
                })
                ->addColumn('deposit', function ($data) {
                    return $data->deposit;
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
                })

                ->addColumn('action', function ($data) {
                    return view('front-office.deposit.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('front-office.deposit.deposit');
    }

    public function wait_deposit(Request $request)
    {
        $date = $request->input('date');
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservations->datatable_reservations($date, 'Waiting Deposit'))
                ->addColumn('id', function ($data) {
                    return $data->id;
                })
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('waktu_reservasi', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
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
                    return $data->is_control == 1 ? 'Kontrol' : 'Perawatan';
                })

                ->addColumn('action', function ($data) {
                    return view('front-office.deposit.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('front-office.deposit.wait');
    }

    public function cancel_reservations(Request $request)
    {
        $date = $request->input('date');
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservations->datatable_reservations($date, 'Cancel'))
                ->addColumn('id', function ($data) {
                    return $data->id;
                })
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('waktu_reservasi', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
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
                    return $data->is_control == 1 ? 'Kontrol' : 'Perawatan';
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
                ->of($this->reservations->datatable_reservations($date, 'Confirm'))
                ->addColumn('id', function ($data) {
                    return $data->id;
                })
                ->addColumn('no', function ($data) {
                    return $data->no;
                })
                ->addColumn('waktu_reservasi', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY');
                })
                ->addColumn('customer_id', function ($data) {
                    return $data->customers->name;
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
                    return $data->is_control == 1 ? 'Kontrol' : 'Perawatan';
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
        $reservation = $this->reservations->datatable_reservations(null, 'Confirm');

        return view('front-office.reservations.reschedule', compact('data', 'reservation'));
    }

    public function update(Request $request, $id)
    {
        $new = $request->validate([
            'request_date' => 'required',
            'request_time' => 'required',
            'reasons' => 'required',
        ]);

        try {
            $reservation = $this->reservations->getById($id);
            // Mail::to($reservation->customers->email)->send(new Reschedule($reservation, $new));

            $this->reservations->reschedule($id, $request->all());

            $this->reservations->reschedule_confirmation($reservation->customers->phone_number, $reservation, $new);

            return redirect()->route('front-office.reservations.confirm.index')->with('success', 'Penjadwalan Ulang Berhasil');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.reservations.confirm.index')->with('error', $th->getMessage());
        }
    }

    public function detail($id)
    {
        $data = $this->reservations->getById($id);
        $data->deposit && $data->deposit = rupiahFormat($data->deposit);

        return view('front-office.reservations.detail', compact('data'));
    }

    public function deposit_detail($id)
    {
        $data = $this->reservations->getById($id);
        $data->deposit && $data->deposit = rupiahFormat($data->deposit);

        return view('front-office.deposit.detail', compact('data'));
    }

    public function confirm($id)
    {
        try {
            $reservation = $this->reservations->getById($id);

            // Mail::to($reservation->customers->email)->send(new ReservationConfirmation($reservation, true));

            $this->reservations->confirm($id);

            $this->reservations->reservation_confirmation($reservation->customers->phone_number, true, $reservation);

            return redirect()->route('front-office.reservations.wait.index')->with('success', 'Reservasi telah dikonfirmasi');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.reservations.wait.index')->with('error', $th->getMessage());
        }
    }

    public function deposit_confirm($id)
    {
        try {
            $reservation = $this->reservations->getById($id);

            // Mail::to($reservation->customers->email)->send(new DepositConfirmation($reservation, true));

            $this->reservations->deposit_confirm($id);

            $this->reservations->deposit_confirmation($reservation->customers->phone_number, $reservation);


            return redirect()->route('front-office.deposit.wait.index')->with('success', 'Deposit telah dikonfirmasi');
        } catch (\Throwable $th) {
            return redirect()->route('front-office.deposit.wait.index')->with('error', $th->getMessage());
        }
    }

    public function cancel($id)
    {
        try {
            $reservation = $this->reservations->getById($id);

            // Mail::to($reservation->customers->email)->send(new ReservationConfirmation($reservation, false));

            $this->reservations->cancel($id);

            $this->reservations->reservation_confirmation($reservation->customers->phone_number, false, $reservation);

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
