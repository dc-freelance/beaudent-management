<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ItemInterface;
use App\Interfaces\ItemCategoryInterface;
use App\Interfaces\ItemUnitInterface;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $item;
    private $itemCategory;
    private $itemUnit;

    public function __construct(ItemInterface $item, ItemCategoryInterface $itemCategory, ItemUnitInterface $itemUnit)
    {
        $this->item = $item;
        $this->itemCategory = $itemCategory;
        $this->itemUnit = $itemUnit;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->item->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('category', function ($data) {
                    return $data->category->name;
                })
                ->addColumn('unit', function ($data) {
                    return $data->unit->name;
                })
                ->addColumn('total_stock', function ($data) {
                    return $data->name;
                })
                ->addColumn('hpp', function ($data) {
                    return 'Rp ' . number_format($data->hpp, 0, ',', '.');
                })
                ->addColumn('price', function ($data) {
                    return 'Rp ' . number_format($data->price, 0, ',', '.');
                })
                ->addColumn('type', function ($data) {
                    $type = $data->type == 'Medicine' ? 'Obat' : 'BMHP';
                    return $type;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.item.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.item.index');
    }

    public function getById($id)
    {
        return $this->item->getById($id);
    }

    public function create()
    {
        $itemCategory = $this->itemCategory->get();
        $itemUnit = $this->itemUnit->get();
        return view('admin.item.create', compact('itemCategory', 'itemUnit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            // 'total_stock' => 'required',
            // 'hpp' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);

        try {
            $request->merge([
                'price' => str_replace(['Rp.', '.', ','], '', $request->input('price'))
            ]);

            $data = $request->all();

            $this->item->store($data);

            return redirect()->route('admin.item.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.item.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->item->getById($id);
        $itemCategory = $this->itemCategory->get();
        $itemUnit = $this->itemUnit->get();

        return view('admin.item.edit', compact('data', 'itemCategory', 'itemUnit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            // 'total_stock' => 'required',
            // 'hpp' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);

        try {
            $request->merge([
                'price' => str_replace(['Rp.', '.', ','], '', $request->input('price'))
            ]);

            $data = $request->all();
            // $data['total_stock'] = 0.0;
            // $data['hpp'] = 0.0;

            // $this->item->store($request->all());
            $this->item->update($id, $request->all());

            return redirect()->route('admin.item.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.item.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->item->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
