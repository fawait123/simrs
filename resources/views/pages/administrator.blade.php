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
                    <h4 class="card-title">@lang('administrator.title')</h4>
                    <p class="card-title-desc">@lang('administrator.subtitle')</p>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('administrator.submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="patientID">@lang('administrator.patientID')</label>
                                    <select name="patientID" id="patientID" class="form-control">
                                        <option value="">select</option>
                                        @foreach ($patients as $item)
                                            <option value="{{ $item->patientID }}">{{ $item->patient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="statuses">@lang('administrator.status')</label>
                                    <select name="statuses" id="statuses" class="form-control">
                                        <option value="">select</option>
                                        <option value="Umum">Umum</option>
                                        <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="patientID">@lang('administrator.price')</label>
                                    <input type="number" name="price" class="form-control"
                                        placeholder="@lang('administrator.price')">
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">@lang('administrator.button')</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6" id="detail-registration">

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
            $("select[name='patientID']").select2();

            $("select[name='patientID']").change(function() {
                $("#detail-registration").html('<p>Loading...</p>')
                let value = $(this).val()
                $.ajax({
                    url: '{{ route('administrator.json') }}',
                    type: 'get',
                    data: {
                        id: value
                    },
                    success: function(res) {
                        if (res) {
                            let html = `<ul class="list-group">
                                <li class="list-group-item"><b>REGISTRASI ID : ${res.registrationID}</b></li>
                                <li class="list-group-item">PENANGGUNG JAWAB : ${res.user.name}</li>
                                <li class="list-group-item">NAMA : ${res.patient.name}</li>
                                <li class="list-group-item">UMUR : ${(parseInt(res.patient.age) / 365).toFixed()}</li>
                                <li class="list-group-item">ALAMAT : ${res.patient.province+', '+res.patient.district+', '+res.patient.subdistrict+', '+res.patient.village+', '+res.patient.rtrw}</li>
                            </ul>`

                            $("#detail-registration").html(html)
                        }
                    }
                })
            })
        })
    </script>
@endsection
