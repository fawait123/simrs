@extends('layouts.master-layouts')
@section('title')
    @lang('translation.Horizontal_Layout')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            @php
                echo ucFirst($title);
            @endphp
        @endslot
        @slot('title')
            @php
                echo ucFirst($title);
            @endphp
        @endslot
    @endcomponent

    {{-- table --}}
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Display</h4>
                    <p class="card-title-desc">Setting tampilan aplikasi anda</p>

                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h6>Tampilan</h6>
                            <div class="dropdown d-inline-block">
                                @if (Session::get('layout') == 'dark')
                                    <button type="button" class="btn header-item noti-icon waves-effect"
                                        onclick="window.location.href='{{ url('layout', 'light') }}'">
                                        <i class="uil-brightness text-primary"></i>
                                        <p class="text-dark text-bold text-primary">Light</p>
                                    </button>
                                @else
                                    <button type="button" class="btn header-item noti-icon waves-effect"
                                        onclick="window.location.href='{{ url('layout', 'dark') }}'">
                                        <i class="uil-brightness-half text-dark"></i>
                                        <p class="text-dark text-bold">Dark</p>
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <h6>Bahasa</h6>
                            <div class="dropdown d-inline-block language-switch">
                                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    @switch(Session::get('lang'))
                                        @case('id')
                                            <img src="{{ URL::asset('/assets/images/flags/id.png') }}" alt="Header Language"
                                                height="16">
                                            <p class="align-middle text-dark">Indonesia</p>
                                        @break

                                        @default
                                            <img src="{{ URL::asset('/assets/images/flags/us.jpg') }}" alt="Header Language"
                                                height="16">
                                            <p class="align-middle text-dark">English</p>
                                    @endswitch
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">

                                    <!-- item-->
                                    <a href="{{ url('index/en') }}" class="dropdown-item notify-item">
                                        <img src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="user-image"
                                            class="me-1" height="12"> <span class="align-middle">English</span>
                                    </a>
                                    {{-- lange indonesia --}}
                                    <a href="{{ url('index/id') }}" class="dropdown-item notify-item">
                                        <img src="{{ URL::asset('assets/images/flags/id.png') }}" alt="user-image"
                                            class="me-1" height="12"> <span class="align-middle">Indonesia</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Identitas</h4>
                    <p class="card-title-desc">Silahkan lengkapi data identitas kamu</p>

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Telp</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Pasien yang kamu daftarkan</h4>
                    <p class="card-title-desc">Silahkan lengkapi data identitas kamu</p>

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Telp</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
@endsection
