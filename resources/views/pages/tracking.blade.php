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

    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('tracker.title')</h4>
                    <p class="card-title-desc">@lang('tracker.subtitle')</p>
                </div>
            </div>
        </div>
    </div>

    @if ($data)
        <div class="row mb-4">
            <div class="col-xl-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <div>
                                <img src="{{ asset($data->patient->photos) }}" alt=""
                                    class="avatar-lg rounded-circle img-thumbnail">
                            </div>
                            <h5 class="mt-3 mb-1">{{ $data->patient->name ?? '' }}</h5>
                            <p class="text-muted">{{ $data->patient->nik ?? '' }}</p>

                            <div class="mt-4">
                                <button type="button" class="btn btn-light btn-sm"><i class="uil uil-print me-2"></i>
                                    @lang('tracker.cetak')</button>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="text-muted">
                            <h5 class="font-size-16">@lang('tracker.alamat')</h5>
                            <p>{{ $data->patient->province . ', ' . $data->patient->dictrict . ', ' . $data->patient->subdistrict . ', ' . $data->patient->village . ', ' . $data->patient->rtrw }}
                            </p>
                            <div class="table-responsive mt-4">
                                <div>
                                    <p class="mb-1">@lang('tracker.nomor') :</p>
                                    <h5 class="font-size-16">{{ $data->medicalRecordID }}</h5>
                                </div>
                                <div>
                                    <p class="mb-1">@lang('tracker.user') :</p>
                                    <h5 class="font-size-16">{{ $data->user->name }}</h5>
                                </div>
                                <div class="mb-1">
                                    <p class="mb-1">@lang('tracker.dokter') :</p>
                                    <h5 class="font-size-16">{{ $data->doctor->name . ', ' . $data->doctor->degree }}</h5>
                                </div>
                                <div class="mb-1">
                                    <p class="mb-1">@lang('tracker.tanggal') :</p>
                                    <h5 class="font-size-16">
                                        {{ date('d M Y', strtotime($data->checkDate)) . ' / ' . date('H:i', strtotime($data->checkTime)) . ' WIB' }}
                                    </h5>
                                </div>
                                <div>
                                    <p class="mb-1">@lang('tracker.perusahaan') :</p>
                                    <h5 class="font-size-16">{{ $data->status }}</h5>
                                </div>
                                <div>
                                    <p class="mb-1">@lang('tracker.harga') :</p>
                                    <h5 class="font-size-16">{{ number_format($data->price, 2, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card mb-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                                <i class="uil uil-bed-double font-size-20"></i>
                                <span class="d-none d-sm-block">@lang('tracker.medis')</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content p-4">
                        <div class="tab-pane active" id="tasks" role="tabpanel">
                            <div>
                                <h5 class="font-size-16 mb-3">@lang('tracker.keluhan')</h5>
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="fw-bold text-dark">{{ $medicalrecord->complaint }}</a>
                                                </td>
                                                <td style="width: 160px;"><i
                                                        class="uil uil-check-circle font-size-20 text-success"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h5 class="font-size-16 mb-3">@lang('tracker.diagonosa')</h5>
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="fw-bold text-dark">{{ $medicalrecord->diagnosis }}</a>
                                                </td>
                                                <td style="width: 160px;"><i
                                                        class="uil uil-check-circle font-size-20 text-success"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h5 class="font-size-16 mb-3">@lang('tracker.tindakan')</h5>
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            @foreach (json_decode($medicalrecord->action) as $item)
                                                <tr>
                                                    <td>
                                                        <a href="#" class="fw-bold text-dark">{{ $item->action }}</a>
                                                    </td>
                                                    <td>{{ $item->result }}</td>
                                                    <td style="width: 160px;"><i
                                                            class="uil uil-check-circle font-size-20 text-success"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row mb-4">
            <div class="col--md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>@lang('tracker.notfound')</h1>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
@endsection
