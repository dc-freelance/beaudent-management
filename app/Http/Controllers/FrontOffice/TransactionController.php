<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\TransactionInterface;
use App\Interfaces\PaymentMethodsInterface;
use App\Interfaces\AddonInterface;
use App\Models\ExaminationTreatment;
use App\Models\ExaminationItem;
use App\Models\AddonExamination;
use App\Models\Transaction;
use App\Models\Addon;
use Carbon\Carbon;
use DB;
use PDF;

class TransactionController extends Controller
{
    private $transaction;
    private $paymentMethod;
    private $addon;

    public function __construct(TransactionInterface $transaction, PaymentMethodsInterface $paymentMethod, AddonInterface $addon)
    {
        $this->transaction = $transaction;
        $this->paymentMethod = $paymentMethod;
        $this->addon = $addon;
    }

    public function list_billing(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                    ->of($this->transaction->list_billing())
                    ->addColumn('code', function ($data) {
                        return $data->code;
                    })
                    ->addColumn('customer', function ($data) {
                        return $data->customer->name;
                    })
                    ->addColumn('doctor', function ($data) {
                        return $data->doctor->name;
                    })
                    ->addColumn('request_date', function ($data) {
                        return Carbon::parse($data->examination->reservation->request_date)->locale('id')->isoFormat('LL');
                    })
                    ->addColumn('request_time', function ($data) {
                        return Carbon::parse($data->examination->reservation->request_time)->locale('id')->isoFormat('LT');
                    })
                    ->addColumn('deposit', function ($data) {
                        return 'Rp. ' . number_format($data->examination->reservation->deposit, 0, ',', '.');
                    })
                    ->addColumn('action', function ($data) {
                        return view('front-office.transaction.column.action', compact('data'));
                    })
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('front-office.transaction.index');
    }

    public function payment($transaction)
    {
        $detailTransaction = $this->transaction->detail_transaction($transaction);
        $detailExaminationTreatment = ExaminationTreatment::with('treatment')->where('examination_id', $detailTransaction->examination->id)->get();
        $detailExaminationItem = ExaminationItem::with('item')->where('examination_id', $detailTransaction->examination->id)->get();
        $detailAddonExamination = AddonExamination::with('addon')->where('examination_id', $detailTransaction->examination->id)->get();

        $listPaymentMethod = $this->paymentMethod->get();
        $listAddon = $this->addon->get();

        return view('front-office.transaction.payment', compact('transaction', 'detailTransaction', 'detailExaminationTreatment', 'detailExaminationItem', 'detailAddonExamination', 'listPaymentMethod', 'listAddon'));
    }

    public function payment_confirm($transaction, Request $request)
    {
        $request->validate([
            'transaction_note' => 'required',
            'transaction_payment_method_id' => 'required',
            'transaction_ppn_status' => 'required',
            'transaction_total' => 'required',
            'transaction_discount' => 'required',
            'transaction_total_ppn' => 'required',
            'transaction_grand_total' => 'required',
        ]);
        
        $request->merge([
            'transaction_total' => str_replace(['Rp.', '.', ','], '', $request->input('transaction_total')),
            'transaction_discount' => str_replace(['Rp.', '.', ','], '', $request->input('transaction_discount')),
            'transaction_total_ppn' => str_replace(['Rp.', '.', ','], '', $request->input('transaction_total_ppn')),
            'transaction_grand_total' => str_replace(['Rp.', '.', ','], '', $request->input('transaction_grand_total'))
        ]);
        try {
            DB::beginTransaction();
            $updateTransaction = Transaction::find($transaction);
            $updateTransaction->note = $request->transaction_note;
            $updateTransaction->is_paid = 1;
            $updateTransaction->payment_method_id = $request->transaction_payment_method_id;
            $updateTransaction->cashier_id = auth()->user()->id;
            $updateTransaction->ppn_status = $request->transaction_ppn_status;
            $updateTransaction->total = $request->transaction_total;
            $updateTransaction->discount = $request->transaction_discount;
            $updateTransaction->total_ppn = $request->transaction_total_ppn;
            $updateTransaction->grand_total = $request->transaction_grand_total;
            $updateTransaction->save();
            DB::commit();

            return redirect()->route('front-office.transaction.list-transaction')->with('success', 'Berhasil melakukan transaksi');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function addon_transaction($transaction, $examination, Request $request)
    {
        $request->validate([
            'addon_id' => 'required',
            'qty' => 'required',
        ]);

        try {
            $addon = Addon::find($request->addon_id);

            DB::beginTransaction();
            $storeAddonExamination = new AddonExamination();
            $storeAddonExamination->examination_id = $examination;
            $storeAddonExamination->user_id = auth()->user()->id;
            $storeAddonExamination->addon_id = $request->addon_id;
            $storeAddonExamination->qty = $request->qty;
            $storeAddonExamination->sub_total = $addon->price*$request->qty;
            $storeAddonExamination->fee = ($addon->price*$request->qty)*$addon->fee_percentage/100;
            $storeAddonExamination->save();

            DB::commit();
            return redirect()->back()->with('success', 'Data Layanan Tambahan Berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function remove_addon_transaction($addonExamination)
    {
        try {
            AddonExamination::find($addonExamination)->delete();
            return redirect()->back()->with('success', 'Data Layanan Tambahan Berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function list_transaction(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                    ->of($this->transaction->list_transaction())
                    ->addColumn('code', function ($data) {
                        return $data->code;
                    })
                    ->addColumn('customer', function ($data) {
                        return $data->customer->name;
                    })
                    ->addColumn('doctor', function ($data) {
                        return $data->doctor->name;
                    })
                    ->addColumn('request_date', function ($data) {
                        return Carbon::parse($data->examination->reservation->request_date)->locale('id')->isoFormat('LL');
                    })
                    ->addColumn('request_time', function ($data) {
                        return Carbon::parse($data->examination->reservation->request_time)->locale('id')->isoFormat('LT');
                    })
                    ->addColumn('deposit', function ($data) {
                        return 'Rp. ' . number_format($data->examination->reservation->deposit, 0, ',', '.');
                    })
                    ->addColumn('action', function ($data) {
                        return view('front-office.transaction.column.action-transaction', compact('data'));
                    })
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('front-office.transaction.transaction');
    }

    public function detail_transaction($transaction)
    {
        $detailTransaction = $this->transaction->detail_transaction($transaction);
        $detailExaminationTreatment = ExaminationTreatment::with('treatment')->where('examination_id', $detailTransaction->examination->id)->get();
        $detailExaminationItem = ExaminationItem::with('item')->where('examination_id', $detailTransaction->examination->id)->get();
        $detailAddonExamination = AddonExamination::with('addon')->where('examination_id', $detailTransaction->examination->id)->get();

        $listPaymentMethod = $this->paymentMethod->get();
        $listAddon = $this->addon->get();

        return view('front-office.transaction.transaction-detail', compact('transaction', 'detailTransaction', 'detailExaminationTreatment', 'detailExaminationItem', 'detailAddonExamination', 'listPaymentMethod', 'listAddon'));
    }

    public function print_transaction($transaction)
    {
        $detailTransaction = $this->transaction->detail_transaction($transaction);
        $detailExaminationTreatment = ExaminationTreatment::with('treatment')->where('examination_id', $detailTransaction->examination->id)->get();
        $detailExaminationItem = ExaminationItem::with('item')->where('examination_id', $detailTransaction->examination->id)->get();
        $detailAddonExamination = AddonExamination::with('addon')->where('examination_id', $detailTransaction->examination->id)->get();
        $dateTransaction = Carbon::parse($detailTransaction->updated_at)->locale('id')->isoFormat('LL');

        // return view('front-office.transaction.transaction-pdf', compact('transaction', 'detailTransaction', 'detailExaminationTreatment', 'detailExaminationItem', 'detailAddonExamination', 'dateTransaction'));
        $print = PDF::loadview('front-office.transaction.transaction-pdf', compact('transaction', 'detailTransaction', 'detailExaminationTreatment', 'detailExaminationItem', 'detailAddonExamination', 'dateTransaction'));
        return $print->download('transaction-print.pdf');
    }
}
