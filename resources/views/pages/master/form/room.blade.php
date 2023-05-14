@extends('layouts.master-layouts')
@section('title')
    @lang('translation.Horizontal_Layout')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            @php
                echo $title;
            @endphp
        @endslot
        @slot('title')
            @php
                echo $title;
            @endphp
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('room.form_title')</h4>
                    <p class="card-title-desc">@lang('room.form_subtitle')</p>

                    <form class="custom-validation"
                        action="{{ isset($id) ? route('room.update', $id) : route('room.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label">@lang('room.name')</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ isset($id) ? $data->name : old('name') }}" required
                                        placeholder="@lang('room.name')" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                    @lang('doctor.simpan')
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    @lang('doctor.reset')
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->
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
