<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjangList = Keranjang::where('status_checkout', 'Tidak')
                                    ->get();
        $totalPrice = Keranjang::join('tbl_produk', 'tbl_keranjang.id_produk', '=', 'tbl_produk.id')
                                ->where('status_checkout', 'Tidak')
                                ->sum('harga');
        $data = [
            'page_name' => 'Keranjang',
            'category_name' => 'keranjang',
            'total_price' => $totalPrice,
            'keranjang_list' => $keranjangList,
        ];
        return view('customer.keranjang')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'qty' => 'required|numeric',
		]);
        $stock = $request->stock;
        $newKeranjang = new Keranjang();
        if($stock < $request->qty){
            return redirect()->route('customer.index')->with('info', "Quantity lebih besar dibandingkan stock");
        }else{
            $newKeranjang->qty = $request->qty;
            $newKeranjang->id_produk = $request->idProduk;
            $newKeranjang->id_user = Auth::id();
            try {
                $newKeranjang->save();
                return redirect()->route('keranjang.index')->with('success', "Keranjang Berhasil Dimasukkan");

            } catch (\Throwable $th) {
                return redirect()->route('keranjang.index')->withErrors($th->getMessage());
            }
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->status_checkout = 'Ya';
        try {
            $keranjang->save();
            return redirect()->route('keranjang.index')->with('success','Keranjang telah dicheckout');

        } catch (\Throwable $th) {
            return redirect()->route('keranjang.index')->withErrors($th->getMessage());
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
        //
    }
}
