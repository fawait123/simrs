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
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('medicalrecord.title')</h4>
                    <p class="card-title-desc">@lang('medicalrecord.subtitle')</p>
                    <form action="{{ route('medical-record.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="patientID">@lang('medicalrecord.patient')</label>
                                    <select name="patientID" id="patientID"
                                        class="form-control @error('patientID') is-invalid @enderror">
                                        <option value="">select</option>
                                        @foreach ($patients as $item)
                                            <option value="{{ $item->patient->id }}">
                                                {{ $item->patient->nik . ' | ' . $item->patient->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('patientID')
                                        <div class="invalid-feedback">This input required</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="goldar">@lang('medicalrecord.goldar')</label>
                                    <select name="goldar" id="goldar"
                                        class="form-control @error('goldar') is-invalid @enderror">
                                        <option value="">select</option>
                                        <option value="A">A</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                    @error('goldar')
                                        <div class="invalid-feedback">This input required</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keluhan">@lang('medicalrecord.keluhan')</label>
                                    <textarea name="complaint" id="keluhan" class="form-control  @error('complaint') is-invalid @enderror" cols="30"
                                        rows="3"></textarea>
                                    @error('complaint')
                                        <div class="invalid-feedback">This input required</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tindakan">@lang('medicalrecord.diagnosa')</label>
                                    <textarea name="diagnosis" id="tindakan" class="form-control @error('diagnosis') is-invalid @enderror" cols="30"
                                        rows="3"></textarea>
                                    @error('diagnosis')
                                        <div class="invalid-feedback">This input required</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="medicineID">@lang('medicalrecord.obat')</label>
                                    <select name="medicineID" id="medicineID"
                                        class="form-control @error('medicines') is-invalid @enderror" multiple="multiple">
                                        @foreach ($medicines as $item)
                                            <option value="{{ $item->name }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('medicines')
                                        <div class="invalid-feedback">This input required</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="medicines">
                                <div class="form-group">
                                    <label for="tindakan">@lang('medicalrecord.tindakan')</label>
                                </div>
                                <div class="col-12" id="container-group">
                                    <div class="row mb-3">
                                        <div class="col-5">
                                            <input type="text" name="actions[]" class="form-control"
                                                placeholder="tindakan">
                                        </div>
                                        <div class="col-5">
                                            <input type="text" name="results[]" class="form-control" placeholder="hasil">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary btn-rounded" id="btn-plus"><i
                                                    class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="activity-feed mb-0 ps-2" id="old-medical-record">
                            </ul>
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
            $("select[name='medicineID']").select2()

            $("select[name='medicineID']").change(function() {
                $("input[name='medicines']").val(JSON.stringify($(this).val()))
            })

            // tambah tindakan
            $('#btn-plus').on('click', function() {
                let html = `<div class="row mb-3">
                                    <div class="col-5">
                                        <input type="text" name="tindakan[]" class="form-control" placeholder="tindakan">
                                    </div>
                                    <div class="col-5">
                                        <input type="text" name="hasil[]" class="form-control" placeholder="hasil">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-danger btn-rounded btn-remove"><i
                                                class="fa fa-minus"></i></button>
                                    </div>
                                </div>`

                $("#container-group").append(html)
            })


            $(document).on('click', '.btn-remove', function() {
                $(this).parent().parent().remove();
            })

            $("select[name='patientID']").change(function() {
                $("#old-medical-record").html('<p>Loading...</p>')
                let value = $(this).val()
                $.ajax({
                    url: '{{ route('medical-record.json') }}',
                    type: 'get',
                    data: {
                        patientID: value
                    },
                    success: function(res) {
                        let html = ''
                        if (res.length > 0) {
                            res.map((el) => {
                                let name = el?.doctor?.name || ''
                                let degree = el?.doctor?.degree || ''
                                html += `<li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">${el.checkDate}</p>
                                                <h5 class="font-size-16">${name + ', '+ degree}</h5>
                                                <p class="text-muted">${el.complaint+' | '+el.diagnosis}</p>
                                            </div>
                                        </li>`
                            })
                        }
                        $("#old-medical-record").html(html)
                    }
                })
            })
        })
    </script>
@endsection
