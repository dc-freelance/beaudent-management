<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AddonInterface;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    private $addon;

    public function __construct(AddonInterface $addon)
    {
        $this->addon = $addon;
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            return datatables()
                ->of($this->addon->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('price', function ($data) {
                    return 'Rp ' . number_format($data->price, 0, ',', '.');
                })
                ->addColumn('fee_percentage', function ($data) {
                    return number_format($data->fee_percentage, 1, ',', '.') . '%';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.addon.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.addon.index');
    }

    public function getById($id)
    {
        return $this->addon->getById($id);
    }

    public function create()
    {
        return view('admin.addon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'fee_percentage' => 'required',
        ]);

        try {
            $request->merge([
                'price' => str_replace(['Rp.', '.', ','], '', $request->input('price'))
            ]);
            $this->addon->store($request->all());

            return redirect()->route('admin.addon.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.addon.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->addon->getById($id);

        return view('admin.addon.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'fee_percentage' => 'required',
        ]);

        try {
            $request->merge([
                'price' => str_replace(['Rp.', '.', ','], '', $request->input('price'))
            ]);
            $this->addon->update($id, $request->all());

            return redirect()->route('admin.addon.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.addon.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->addon->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
