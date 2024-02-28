<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DiscountItemInterface;
use App\Interfaces\DiscountInterface;
use App\Interfaces\ItemInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountItemController extends Controller
{

    private $discount_item, $data_discount, $data_item;

    public function __construct(DiscountItemInterface $discount_item, DiscountInterface $data_discount, ItemInterface $data_item)
    {
        $this->discount_item = $discount_item;
        $this->data_discount = $data_discount;
        $this->data_item = $data_item;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->discount_item->get())
                ->addColumn('discount_id', function ($data) {
                    return $data->discounts->name;
                })
                ->addColumn('item_id', function ($data) {
                    return $data->items->name;
                })
                ->addColumn('discount_type', function ($data) {
                    return $data->discount_type === 'Percentage' ? 'Percentage' : 'Nominal';
                })
                ->addColumn('discount', function ($data) {
                    if ($data->discount_type == 'Percentage') {
                        return number_format($data->discount, 1, ',', '.') . '%';
                    } else {
                        return 'Rp ' . number_format($data->discount, 0, ',', '.');
                    }
                })
                ->addColumn('action', function ($data) {
                    return view('admin.discount_item.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.discount_item.index');
    }

    public function getById($id)
    {
        return $this->discount_item->getById($id);
    }

    public function create()
    {
        $data_discount = $this->data_discount->get();
        $data_item = $this->data_item->get();

        if($data_item->isEmpty()) {
            return redirect()->route('admin.discount_item.index')->with('error', 'Silahkan tambahkan barang terlebih dahulu');
        }
        elseif($data_discount->isEmpty()) {
            return redirect()->route('admin.discount_item.index')->with('error', 'Silahkan tambahkan diskon terlebih dahulu');
        }

        return view('admin.discount_item.create', compact('data_discount', 'data_item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'discount_id' => 'required',
            'item_id' => 'required',
            'discount_type' => 'required',
            'discount' => 'required'
        ]);

        try {
            $discount_item = $request->input('discount');
    
            // Menghilangkan simbol mata uang dan karakter tidak valid
            $discount_item = str_replace(['Rp.', '.', ','], '', $discount_item);
    
            // Mengonversi nilai discount ke tipe data numerik jika discount_type adalah 'nominal'
            if ($request->input('discount_type') === 'Nominal') {
                $discount_item = (float) $discount_item;
            }
    
            $request->merge([
                'discount' => $discount_item
            ]);
    
            $this->discount_item->create($request->all());
    
            return redirect()->route('admin.discount_item.index')->with('success', 'Diskon Barang berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.discount_item.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->discount_item->getById($id);
        $discount_item = $this->discount_item->get();
        $data_discount = $this->data_discount->get();
        $data_item = $this->data_item->get();

        return view('admin.discount_item.edit', compact('data','discount_item', 'data_discount', 'data_item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'discount_id' => 'required',
            'item_id' => 'required',
            'discount_type' => 'required',
            'discount' => 'required'
        ]);

        try {
            $discount_item = $request->input('discount');
    
            // Menghilangkan simbol mata uang dan karakter tidak valid
            $discount_item = str_replace(['Rp.', '.', ','], '', $discount_item);
    
            // Mengonversi nilai discount ke tipe data numerik jika discount_type adalah 'nominal'
            if ($request->input('discount_type') === 'nominal') {
                $discount_item = (float) $discount_item;
            }
    
            $request->merge([
                'discount' => $discount_item
            ]);
    
            $this->discount_item->update($id, $request->all());
    
            return redirect()->route('admin.discount_item.index')->with('success', 'Diskon Barang berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.discount_item.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->discount_item->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Diskon Barang berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
