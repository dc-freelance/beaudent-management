<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorCategoryInterface;
use App\Interfaces\DoctorInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $doctor;
    private $doctorCategory;

    public function __construct(DoctorInterface $doctor, DoctorCategoryInterface $doctorCategory)
    {
        $this->doctor         = $doctor;
        $this->doctorCategory = $doctorCategory;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->doctor->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('phone_number', function ($data) {
                    return $data->phone_number;
                })
                ->addColumn('join_date', function ($data) {
                    return Carbon::parse($data->join_date)->locale('id')->isoFormat('LL');
                })
                ->addColumn('category', function ($data) {
                    return $data->doctorCategory->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.doctor.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.doctor.index');
    }

    public function getById($id)
    {
        return response()->json($this->doctor->getById($id));
    }

    public function create()
    {
        $categories = $this->doctorCategory->get();
        if ($categories->isEmpty()) return redirect()->route('admin.doctor-category.index')->with('error', 'Silahkan tambahkan kategori dokter terlebih dahulu');
        return view('admin.doctor.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|unique:doctors,email',
            'phone_number' => 'required',
            'join_date'    => 'required',
            'category_id'  => 'required'
        ]);

        try {
            $this->doctor->store($request->except('_token'));
            return redirect()->route('admin.doctor.index')->with('success', 'Dokter berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.doctor.index')->with('error', $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        $categories = $this->doctorCategory->get();
        return view('admin.doctor.edit', [
            'data'       => $this->doctor->getById($id),
            'categories' => $categories
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|unique:doctors,email,' . $id,
            'phone_number' => 'required',
            'join_date'    => 'required',
            'category_id'  => 'required'
        ]);

        try {
            $this->doctor->update($id, $request->except('_token', '_method'));
            return redirect()->route('admin.doctor.index')->with('success', 'Dokter berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.doctor.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->doctor->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Dokter berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
