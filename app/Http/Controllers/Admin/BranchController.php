<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BranchInterface;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private $branch;

    public function __construct(BranchInterface $branch)
    {
        $this->branch = $branch;
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            return datatables()
                ->of($this->branch->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('phone_number', function ($data) {
                    return $data->phone_number;
                })
                ->addColumn('address', function ($data) {
                    return $data->address;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.branch.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.branch.index');
    }

    public function getById($id)
    {
        return $this->branch->getById($id);
    }

    public function create()
    {
        return view('admin.branch.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'phone_number' => 'required',
            'address'     => 'required',
        ]);

        try {
            $this->branch->store($request->all());
            return redirect()->route('admin.branch.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.branch.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data    = $this->branch->getById($id);
        return view('admin.branch.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required',
            'phone_number' => 'required',
            'address'     => 'required',
        ]);

        try {
            $this->branch->update($id, $request->all());
            return redirect()->route('admin.branch.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.branch.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->branch->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
