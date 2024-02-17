<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\SupplierInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $supplier;

    public function __construct(SupplierInterface $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->supplier->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('phone_number', function ($data) {
                    return $data->phone_number;
                })
                ->addColumn('address', function ($data) {
                    return $data->address;
                })
                ->addColumn('debt', function ($data) {
                    return 'Rp. ' . number_format($data->debt, 0, ',', '.');
                })
                ->addColumn('action', function ($data) {
                    return view('admin.supplier.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.supplier.index');
    }

    public function getById($id)
    {
        return response()->json($this->supplier->getById($id));
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'phone_number' => 'required',
            'address'      => 'required',
        ]);

        try {
            $this->supplier->store($request->all());

            return redirect()->route('admin.supplier.index')->with('success', 'Pemasok berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.supplier.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->supplier->getById($id);

        return view('admin.supplier.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'         => 'required',
            'phone_number' => 'required',
            'address'      => 'required',
        ]);

        try {
            $this->supplier->update($id, $request->all());

            return redirect()->route('admin.supplier.index')->with('success', 'Pemasok berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.supplier.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        $this->supplier->delete($id);

        return response()->json(['status' => 'success', 'message' => 'Pemasok berhasil dihapus']);
    }
}
