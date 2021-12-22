<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produkList = Produk::all();
        $data = [
            'page_name' => 'Produk',
            'category_name' => 'produk',
            'produk_list' => $produkList,
        ];
        return view('cms.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'page_name' => 'Produk',
            'category_name' => 'produk',
        ];
        return view('cms.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_produk' => 'required|unique:tbl_produk,nama_produk',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'stock' => 'required|numeric',
            'harga' => 'required|numeric|',
		]);

        $newProduk = new Produk();
        $newProduk->nama_produk = $request->nama_produk;
        $newProduk->stock = $request->stock;
        $newProduk->harga = $request->harga;

        $image = $request->file('image');
        $directory ='image/images/produk/';
        $imageName = uniqid().'_'.$image->getClientOriginalName();
        Storage::disk('local')->put($directory.$imageName, file_get_contents($image));
        $newProduk->image = $directory.$imageName;

        try {
            $newProduk->save();
            return redirect()->route('produk.index')->with('success', "Produk Berhasil Dibuat");

        } catch (\Throwable $th) {
            return redirect()->route('produk.create')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $data = [
            'page_name' => 'Produk',
            'category_name' => 'produk',
            'produk' => $produk
        ];
        return view('cms.detail_produk')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $data = [
            'page_name' => 'Produk',
            'category_name' => 'produk',
            'produk' => $produk,
        ];
        return view('cms.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $this->validate($request, [
            'nama_produk' => 'required|unique:tbl_produk,nama_produk,'.$produk->id,
            'stock' => 'required|numeric',
            'harga' => 'required|numeric',
		]);

        $produk->nama_produk = $request->nama_produk;
        $produk->stock = $request->stock;
        $produk->harga = $request->harga;

        $image = $request->file('image');
        if($image){
            $directory ='image/images/produk/';
            $imageName = uniqid().'_'.$image->getClientOriginalName();
            Storage::disk('local')->put($directory.$imageName, file_get_contents($image));
            $produk->image = $directory.$imageName;
        }
        try {
            $produk->save();
            return redirect()->route('produk.index')->with('success', "Produk Berhasil Di-Update");

        } catch (\Throwable $th) {
            return redirect()->route('produk.edit', ['produk' => $id])->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        try {
            $produk->delete();
            return redirect()->route('produk.index')->with('success', "Produk berhasil dihapus");
        } catch (\Throwable $th) {
            return redirect()->route('produk.index')->withErrors($th->getMessage());
        }
    }
}
