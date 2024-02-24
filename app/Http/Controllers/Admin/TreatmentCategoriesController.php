<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\TreatmentCategoriesInterface;

class TreatmentCategoriesController extends Controller
{

    private $treatment_categories;

    public function __construct(TreatmentCategoriesInterface $treatment_categories)
    {
        $this->treatment_categories = $treatment_categories;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->treatment_categories->get())
                ->addColumn('category', function ($data) {
                    return $data->category;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.treatment_categories.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.treatment_categories.index');
    }

    public function getById($id)
    {
        return $this->treatment_categories->getById($id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $treatment_categories = $this->treatment_categories->get();
        return view('admin.treatment_categories.create', compact('treatment_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' =>'required',
        ]);

        try {
            $this->treatment_categories->create($request->all());

            return redirect()->route('admin.treatment-categories.index')->with('success', 'Kategori layanan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.treatment-categories.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->treatment_categories->getById($id);
        $treatment_categories = $this->treatment_categories->get();

        return view('admin.treatment_categories.edit', compact('data', 'treatment_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' =>'required',
        ]);

        try {
            $this->treatment_categories->update($id, $request->all());

            return redirect()->route('admin.treatment-categories.index')->with('success', 'Kategori layanan berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.treatment-categories.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $this->treatment_categories->delete($id);

            return response()->json(['status' =>'success','message' => 'Kategori layanan berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error','message' => $th->getMessage()]);
        }
    }
}
