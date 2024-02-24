<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TreatmentInterface;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    private $treatment;

    public function __construct(TreatmentInterface $treatment)
    {
        $this->treatment = $treatment;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->treatment->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('code', function ($data) {
                    return $data->code != null ? $data->code : '-';
                })
                ->addColumn('parent_id', function ($data) {
                    $treatment = $this->treatment->getById($data->parent_id);

                    return $treatment ? $treatment->name : '-';
                })
                ->addColumn('price', function ($data) {
                    return 'Rp '.number_format($data->price, 0, ',', '.');
                })
                ->addColumn('treatment_category_id', function ($data) {
                    return $data->treatment_category_id ? $data->treatment_categories->category : '-';
                })
                ->addColumn('is_control', function ($data) {
                    return $data->is_control ? 'Ya' : 'Tidak';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.treatment.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.treatment.index');
    }

    public function getById($id)
    {
        return $this->treatment->getById($id);
    }

    public function create()
    {
        $parents = $this->treatment->get()->where('parent_id', null);
        $treatment_categories = $this->treatment->getTreatmentCategories();

        return view('admin.treatment.create', compact('parents', 'treatment_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'parent_id' => 'nullable',
            'price' => 'required',
            'treatment_category_id' => 'required',
            'is_control' => 'nullable',
        ]);

        if ($request->is_parent == 'parent') {
            $request['parent_id'] = null;
            $request['is_control'] = false;
        }

        try {
            $this->treatment->create($request->all());

            return redirect()->route('admin.treatment.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.treatment.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->treatment->getById($id);
        $parents = $this->treatment->get()->where('parent_id', null);
        $treatment_categories = $this->treatment->getTreatmentCategories();

        return view('admin.treatment.edit', compact('data', 'parents', 'treatment_categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'parent_id' => 'nullable',
            'price' => 'required',
            'treatment_category_id' => 'required',
            'is_control' => 'nullable',
        ]);

        if ($request->is_parent == 'parent') {
            $request['parent_id'] = null;
            $request['is_control'] = false;
        }

        try {
            $this->treatment->update($id, $request->all());

            return redirect()->route('admin.treatment.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.treatment.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->treatment->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
