<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorCategoryInterface;
use Illuminate\Http\Request;

class DoctorCategoryController extends Controller
{
    private $doctorCategory;

    public function __construct(DoctorCategoryInterface $doctorCategory)
    {
        $this->doctorCategory = $doctorCategory;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->doctorCategory->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.doctor-category.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.doctor-category.index');
    }

    public function getById($id)
    {
        return response()->json($this->doctorCategory->getById($id));
    }

    public function create()
    {
        return view('admin.doctor-category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:doctor_categories,name'
        ]);

        try {
            $this->doctorCategory->store($request->except('_token'));
            return redirect()->route('admin.doctor-category.index')->with('success', 'Kategori dokter berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.doctor-category.index')->with('error', $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        return view('admin.doctor-category.edit', [
            'data' => $this->doctorCategory->getById($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:doctor_categories,name,' . $id
        ]);

        try {
            $this->doctorCategory->update($id, $request->except('_token'));
            return redirect()->route('admin.doctor-category.index')->with('success', 'Kategori dokter berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('admin.doctor-category.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->doctorCategory->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Kategori dokter berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
