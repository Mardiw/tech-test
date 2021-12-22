<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->akses == '0') {
            $produkList = Produk::all();
            $data = [
                'page_name' => 'Produk',
                'category_name' => 'produk',
                'produk_list' => $produkList,
            ];
            return view('cms.list')->with($data);
        }
        elseif(auth()->user()->akses == '1'){
            $produkList = Produk::all();
            $data = [
                'page_name' => 'Produk',
                'category_name' => 'produk',
                'produk_list' => $produkList,
            ];
            return view('customer.customer')->with($data);
        }
        else{
            return auth()->logout();
        }
    }
}
