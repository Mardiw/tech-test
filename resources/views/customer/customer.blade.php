@extends('layouts.app')
@section('content')
    <div class="layout-px-spacing">
        <div class="layout-top-spacing layout-spacing">
            <div class="text-center">
                @auth
                    <a href="{{ route('keranjang.index') }}" class="btn btn-primary mb-2 mr-2 float-right">
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
                            <x-produk :produk="$produk" />
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- REGISTER MODAL --}}
            <div class="modal fade" id="register_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Register</h3>
                        </div>
                        <div class="modal-body">
                            <form class="text-left" method="POST" action="{{ route('register', ['source' => 'web']) }}">
                                @csrf
                                <div class="form">
                                    <div id="name-field" class="field-wrapper input">
                                        <label for="email">Nama Lengkap</label>
                                        <input id="name" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Nama Lengkapmu" value="{{ old('name') }}">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div id="email-field" class="field-wrapper input">
                                        <label for="email">Email</label>
                                        <input id="email-field" name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                            value="{{ old('email') }}" autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div id="alamat-field" class="field-wrapper input">
                                        <label for="email">Alamat</label>
                                        <input id="alamat-field" name="alamat" type="text"
                                            class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat"
                                            value="{{ old('alamat') }}" autocomplete="email">

                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div id="phone-field" class="field-wrapper input">
                                        <label for="email">No Telpon</label>
                                        <input id="phone" name="phone" type="text"
                                            class="form-control @error('phone') is-invalid @enderror" placeholder="Telepon"
                                            value="{{ old('phone') }}">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <label for="email">Password</label>
                                        <input id="password" name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" value="{{ old('password') }}">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                                            class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg> --}}

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div id="password-confirmation-field" class="field-wrapper input mb-2">
                                        <label for="email">Confirm Password</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password"
                                            class="form-control" placeholder="Confirm Password">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            id="toggle-password-confirmation" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg> --}}
                                    </div>

                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper">
                                            <button type="submit" id="register-button" class="btn btn-primary"
                                                value="">Daftar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- LOGIN MODAL --}}
            <div class="modal fade" id="login_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Login</h3>
                        </div>
                        <div class="modal-body">
                            <form class="text-left" method="POST" action="{{ route('login', ['source' => 'web']) }}">
                                @csrf
                                <div class="form">
                                    <div id="email-field" class="field-wrapper input">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                    </div>

                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <div class="d-flex justify-content-between">
                                            <label for="password">Password</label>
                                        </div>
                                        <input id="password" name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                                            class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg> --}}
                                    </div>
                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper">
                                            <button type="submit" class="btn btn-primary" value="">Login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('additional_css')
    <link href="{{ asset('cork1/assets/css/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .infobox-1 {
            width: 35%;
            margin-top: 1%;
        }
    </style>
@endsection

@section('additional_js')
    <script src="/cork1/assets/js/authentication/form-2.js"></script>
    <script>
        function confirmSubmit(id) {
            $('#form-create' + id).submit();
        }
    </script>
@endsection
