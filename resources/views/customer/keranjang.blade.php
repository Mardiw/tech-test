@extends('layouts.app')
@section('content')
<div class="layout-px-spacing">
    <div class="layout-top-spacing layout-spacing">
        <div class="text-center">
            <a href="" class="btn btn-primary mb-2 mr-2 float-right">
                Keranjang
            </a>
        </div>
    </div>
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            @if ($errors->any())
            <x-admin-alert-error />
            @elseif (session()->has('success'))
            <x-admin-alert-success message="{{ session()->get('success') }}" />
            @elseif (session()->has('info'))
            <x-admin-alert-info message="{{ session()->get('info') }}" />
            @elseif (session()->has('warning'))
            <x-admin-alert-info message="{{ session()->get('warning') }}" />
            @endif
            <div class="widget-content widget-content-area br-6">
                <h4>Keranjang</h4>
                <ul class="list-group list-group-media">
                    @if ($keranjang_list->isEmpty())
                    <h3 class="text-center">Keranjang Kosong</h3>
                    @else
                    <form action="{{ route('keranjang.update_all') }}" id="form-checkout" method="post">
                        @csrf
                        @method('patch')
                    @foreach ($keranjang_list as $keranjang)
                    <li class="list-group-item list-group-item-action">
                        <div class="media">
                            <div class="mr-3">
                                <img width="150px" src="{{ url('storage/'.$keranjang->produk->image) }}" alt="{{$keranjang->produk->image}}" />
                            </div>
                            <div class="media-body">
                                <h6 class="tx-inverse">{{$keranjang->produk->nama_produk}}</h6>
                                <p class="mg-b-0">Rp {{ number_format($keranjang->produk->harga, 0, '.', ',') }}</p>
                                <p class="mg-b-0">Quantity: {{$keranjang->qty}}</p>

                                <input type="hidden" name="keranjangIds[]" value="{{$keranjang->id}}">

                            </div>
                        </div>
                    </li>
                    @endforeach
                    </form>
                    @endif
                    @if ($total_price == 0)
                    @else
                    <div class="layout-top-spacing">
                    <h3 class="text-right">Total Harga</h3>
                    <h3 class="text-right">Rp {{ number_format($total_price, 0, '.', ',') }}</h3>
                    </div>
                    @endif
                </ul>
                <div class="layout-top-spacing">
                    <a href="{{route('customer.index')}}" class="btn"><i class="flaticon-cancel-12"></i> Back</a>
                    <button type="submit" onclick="confirmCheckout()" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_js')
    <script>
        function confirmCheckout()
        {
            $('#form-checkout').submit();
        }
    </script>
@endsection
