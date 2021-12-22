<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $produkList = Produk::all();
        $data = [
            'page_name' => 'Produk',
            'category_name' => 'produk',
            'produk_list' => $produkList,
        ];
        return view('customer.customer')->with($data);

    }
}
