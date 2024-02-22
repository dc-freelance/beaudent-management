<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DiscountInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private $discount;

    public function __construct(DiscountInterface $discount)
    {
        $this->discount = $discount;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->discount->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('discount_type', function ($data) {
                    return $data->discount_type === 'Percentage' ? 'Percentage' : 'Nominal';
                })
                ->addColumn('discount', function ($data) {
                    if ($data->discount_type == 'Percentage') {
                        return number_format($data->discount, 0, ',', '.').'%';
                    } else {
                        return 'Rp '.number_format($data->discount, 0, ',', '.');
                    }
                })
                ->addColumn('start_date', function ($data) {
                    return Carbon::parse($data->start_date)->locale('id')->isoFormat('LL');
                })
                ->addColumn('end_date', function ($data) {
                    return Carbon::parse($data->end_date)->locale('id')->isoFormat('LL');
                })
                ->addColumn('is_active', function ($data) {
                    return $data->is_active ? 'Aktif' : 'Tidak Aktif';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.discount.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.discount.index');
    }

    public function getById($id)
    {
        return $this->discount->getById($id);
    }

    public function create()
    {
        $discount = $this->discount->get();

        return view('admin.discount.create', compact('discount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'is_active' => 'required',
        ]);

        try {
            if ($request->discount_type === 'Percentage') {
                $request->merge(['discount' => (float) str_replace(',', '.', $request->discount)]);
            }
            else if ($request->discount_type === 'Nominal') {
                $request->merge([
                    'discount' => str_replace(['Rp.', '.', ','], '', $request->input('discount'))
                ]);
            }
    
            $this->discount->create($request->all());

            return redirect()->route('admin.discount.index')->with('success', 'Diskon berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.discount.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->discount->getById($id);
        $discount = $this->discount->get();

        return view('admin.discount.edit', compact('data', 'discount'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'is_active' => 'required',
        ]);

        try {
            if ($request->discount_type === 'Percentage') {
                $request->merge(['discount' => (float) str_replace(',', '.', $request->discount)]);
            }
            else if ($request->discount_type === 'Nominal') {
                $request->merge([
                    'discount' => str_replace(['Rp.', '.', ','], '', $request->input('discount'))
                ]);
            }
            
            $this->discount->update($id, $request->all());

            return redirect()->route('admin.discount.index')->with('success', 'Diskon berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.discount.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->discount->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Diskon berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
