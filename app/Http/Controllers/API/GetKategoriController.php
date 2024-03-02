<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoctorCategory;
use Illuminate\Http\Request;

class GetKategoriController extends Controller
{
    function getKategori(Request $request) {
        $kategori = json_decode($request->get('kategori'),true);
        if (($key = array_search('all', $kategori)) !== false) {
            unset($kategori[$key]);
        }
        if (count($kategori) > 0) {
            $data = DoctorCategory::whereIn('id',$kategori)->get();
            return $data;
        }
    }
}
