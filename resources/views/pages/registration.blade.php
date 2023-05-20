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
                    <h4 class="card-title">@lang('registration.title')</h4>
                    <p class="card-title-desc">@lang('registration.subtitle')</p>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('registration') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="patientID">@lang('registration.patient')</label>
                                    <select name="patientID" id="patientID"
                                        class="form-control @error('patientID') is-invalid @enderror">
                                        <option value="">select</option>
                                        @foreach ($patients as $item)
                                            <option value="{{ $item->patientID }}">{{ $item->patient->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('patientID')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">@lang('registration.button')</button>
                                </div>
                            </form>
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
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("select[name='patientID']").select2()
        })
    </script>
@endsection
