<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CustomerInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()
                ->of($this->customer->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('phone_number', function ($data) {
                    return $data->phone_number;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('date_of_birth', function ($data) {
                    return $data->date_of_birth;
                })
                ->addColumn('gender', function ($data) {
                    return $data->gender;
                })
                ->addColumn('address', function ($data) {
                    return $data->address;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.customer.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.customer.index');
    }

    public function getById($id)
    {
        return $this->customer->getById($id);
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'date_of_birth'         => 'required',
            'place_of_birth'        => 'required',
            'identity_number'       => 'required',
            'gender'                => 'required',
            'occupation'            => 'required',
            'address'               => 'required',
            'phone_number'          => 'required',
            'religion'              => 'required',
            'email'                 => 'required',
            'marrital_status'       => 'required',
            'instagram'             => 'required',
            'youtube'               => 'required',
            'facebook'              => 'required',
            'source_of_information' => 'required',
        ]);

        try {
            $this->customer->store($request->all());
            return redirect()->route('admin.customer.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.customer.index')->with('error', $th->getMessage());
        }
    }

    public function detail($id)
    {
        $data = $this->customer->getById($id);
        return view('admin.customer.detail', compact('data'));
    }

    public function edit($id)
    {
        $data    = $this->customer->getById($id);
        return view('admin.customer.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                  => 'required',
            'date_of_birth'         => 'required',
            'place_of_birth'        => 'required',
            'identity_number'       => 'required',
            'gender'                => 'required',
            'occupation'            => 'required',
            'address'               => 'required',
            'phone_number'          => 'required',
            'religion'              => 'required',
            'email'                 => 'required',
            'marrital_status'       => 'required',
            'instagram'             => 'required',
            'youtube'               => 'required',
            'facebook'              => 'required',
            'source_of_information' => 'required',
        ]);

        try {
            $this->customer->update($id, $request->all());
            return redirect()->route('admin.customer.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.customer.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->customer->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
