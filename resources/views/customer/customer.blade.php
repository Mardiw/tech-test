@extends('layouts.live-customer')
@section('content')
<div class="layout-px-spacing">
    <div class="layout-top-spacing layout-spacing">
        <div class="text-center">
            @guest
            <a href="{{route('login')}}" class="btn btn-primary mb-2 mr-2 float-right">
                Login
            </a>
            @endguest
            @auth
            <a href="{{route('keranjang.index')}}" class="btn btn-primary mb-2 mr-2 float-right">
                Keranjang
            </a>
            @endauth
        </div>
    </div>
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                @if ($errors->any())
                <x-admin-alert-error />
                @elseif (session()->has('success'))
                <x-admin-alert-success message="{{ session()->get('success') }}" />
                @elseif (session()->has('info'))
                <x-admin-alert-info message="{{ session()->get('info') }}" />
                @elseif (session()->has('warning'))
                <x-admin-alert-info message="{{ session()->get('warning') }}" />
                @endif
                <h1 class="text-center">OUR PRODUCT</h1>
                <div class="row">
                    @foreach ($produk_list as $produk)
                    <x-produk :produk="$produk"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('additional_css')
    <link href="{{asset('cork1/assets/css/elements/infobox.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .infobox-1{
            width: 35%;
            margin-top : 1%;
        }
    </style>
@endsection

@section('additional_js')
    <script>
        function confirmSubmit(id)
        {
            $('#form-create'+id).submit();
        }
    </script>
@endsection
