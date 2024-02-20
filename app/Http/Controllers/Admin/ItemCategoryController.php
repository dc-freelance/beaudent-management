<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ItemCategoryInterface;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    private $itemCategory;

    public function __construct(ItemCategoryInterface $itemCategory)
    {
        $this->itemCategory = $itemCategory;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->itemCategory->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.item-category.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.item-category.index');
    }

    public function getById($id)
    {
        return response()->json($this->itemCategory->getById($id));
    }

    public function create()
    {
        return view('admin.item-category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            $this->itemCategory->store($request->all());
            return redirect()->route('admin.item-category.index')->with('success', 'Kategori barang berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.item-category.index')->with('danger', 'Kategori barang gagal disimpan');
        }
    }

    public function edit($id)
    {
        return view('admin.item-category.edit', [
            'data' => $this->itemCategory->getById($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            $this->itemCategory->update($id, $request->all());
            return redirect()->route('admin.item-category.index')->with('success', 'Kategori barang berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.item-category.index')->with('danger', 'Kategori barang gagal diubah');
        }
    }

    public function delete($id)
    {
        try {
            $this->itemCategory->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Kategori barang berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => 'Kategori barang gagal dihapus']);
        }
    }
}
