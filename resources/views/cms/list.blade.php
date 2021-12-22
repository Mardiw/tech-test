@extends('layouts.app')

@section('content')

<div class="layout-px-spacing">
    @if ($errors->any())
    <x-admin-alert-error />
    @elseif (session()->has('success'))
    <x-admin-alert-success message="{{ session()->get('success') }}" />
    @elseif (session()->has('info'))
    <x-admin-alert-info message="{{ session()->get('info') }}" />
    @elseif (session()->has('warning'))
    <x-admin-alert-info message="{{ session()->get('warning') }}" />
    @endif
    <div class="layout-top-spacing layout-spacing">
        <div class="text-center">
            <a href="{{route('produk.create')}}" class="btn btn-primary mb-2 mr-2 float-right">
                Tambah Produk
            </a>
        </div>
    </div>
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <h4>Data Produk</h4>
                <div class="table-responsive mb-4 mt-4">
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Image</th>
                                <th>Harga</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                @foreach ($produk_list as $produk)
                                <form id="form-delete-{{$produk->id}}" action="{{ route('produk.destroy', ['produk' => $produk->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <tr>
                                    <td>{{$produk->id}}</td>
                                    <td>{{$produk->nama_produk}}</td>
                                    <td>
                                        <img width="150px" src="{{ url('storage/'.$produk->image) }}" alt="{{$produk->image}}" />
                                    </td>
                                    <td>{{$produk->stock}}</td>
                                    <td>Rp. {{ number_format($produk->harga, 0, '.', ',') }}</td>
                                    <td>
                                        <a href="{{route('produk.show', ['produk' => $produk->id])}}"><i class="fa fa-search" aria-hidden="true" style="color: #12a54a; font-size: 20px"></i></a>
                                        <a href="{{route('produk.edit', ['produk' => $produk->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #0b1c52; font-size: 20px"></i></a>
                                        <a onclick="confirmDelete('{{$produk->id}}')" href="#"><i class="fa fa-trash-o" aria-hidden="true" style="color: red; font-size: 20px"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Image</th>
                                <th>Harga</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_js')
    <script>
        function confirmDelete(id)
        {
            var x = confirm("Apakah produk ini mau dihapus?");
            if (x)
                $('#form-delete-'+id).submit();
            else
                return false;
        }
    </script>
@endsection
