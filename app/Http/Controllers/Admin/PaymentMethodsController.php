<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\PaymentMethodsInterface;

class PaymentMethodsController extends Controller
{
    private $payment_methods;

    public function __construct(PaymentMethodsInterface $payment_methods)
    {
        $this->payment_methods = $payment_methods;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->payment_methods->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.payment_methods.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.payment_methods.index');
    }

    public function getById($id)
    {
        return $this->payment_methods->getById($id);
    }

    public function create()
    {
        $payment_methods = $this->payment_methods->get();
        return view('admin.payment_methods.create', compact('payment_methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
        ]);

        try {
            $this->payment_methods->create($request->all());

            return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.payment-methods.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->payment_methods->getById($id);
        $payment_methods = $this->payment_methods->get();

        return view('admin.payment_methods.edit', compact('data', 'payment_methods'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required',
        ]);

        try {
            $this->payment_methods->update($id, $request->all());

            return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.payment-methods.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->payment_methods->delete($id);

            return response()->json(['status' =>'success','message' => 'Metode pembayaran berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error','message' => $th->getMessage()]);
        }
    }

}
