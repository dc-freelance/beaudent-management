<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ItemUnitInterface;
use Illuminate\Http\Request;

class ItemUnitController extends Controller
{
    private $itemUnit;

    public function __construct(ItemUnitInterface $itemUnit)
    {
        $this->itemUnit = $itemUnit;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->itemUnit->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.item-unit.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.item-unit.index');
    }

    public function getById($id)
    {
        return response()->json($this->itemUnit->getById($id));
    }

    public function create()
    {
        return view('admin.item-unit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            $this->itemUnit->store($request->all());
            return redirect()->route('admin.item-unit.index')->with('success', 'Satuan barang berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.item-unit.index')->with('danger', 'Satuan barang gagal disimpan');
        }
    }

    public function edit($id)
    {
        return view('admin.item-unit.edit', [
            'data' => $this->itemUnit->getById($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            $this->itemUnit->update($id, $request->all());
            return redirect()->route('admin.item-unit.index')->with('success', 'Satuan barang berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.item-unit.index')->with('danger', 'Satuan barang gagal diubah');
        }
    }

    public function delete($id)
    {
        try {
            $this->itemUnit->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Satuan barang berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => 'Satuan barang gagal dihapus']);
        }
    }
}
