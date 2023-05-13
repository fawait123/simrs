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
                    <h4 class="card-title">@lang('custom.form_title')</h4>
                    <p class="card-title-desc">@lang('custom.form_subtitle')</p>

                    <form class="custom-validation" action="{{ route('doctor.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.nik')</label>
                                    <input type="text" name="nik" class="form-control"
                                        value="{{ isset($id) ? $data->nik : old('nik') }}" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.nip')</label>
                                    <input type="text" name="nip" value="{{ isset($id) ? $data->nip : old('nip') }}"
                                        class="form-control" required placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.name')</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ isset($id) ? $data->name : old('name') }}" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.gelar')</label>
                                    <input type="text" name="initialDegree"
                                        value="{{ isset($id) ? $data->initialDegree : old('initialDegree') }}"
                                        class="form-control" required placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.tempat_lahir')</label>
                                    <input type="text" name="placebirth"
                                        value="{{ isset($id) ? $data->placebirth : old('placebirth') }}"
                                        class="form-control" required placeholder="Type something" />
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.tanggal_lahir')</label>
                                    <input type="date" value="{{ isset($id) ? $data->birthdate : old('birthdate') }}"
                                        name="birthdate" class="form-control" required placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.gender')</label>
                                    <select name="gender" id="gender" required class="form-control">
                                        <option value="">pilih</option>
                                        <option value="L">Laki Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.spesialis')</label>
                                    <select name="specialist" id="gender" required class="form-control">
                                        <option value="">pilih</option>
                                        <option value="L">Laki Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.foto')</label>
                                    <input type="text" name="photos" class="form-control" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.alamat')</label>
                                    <div>
                                        <textarea required name="address" class="form-control" rows="5">{{ isset($id) ? $data->address : old('address') }}</textarea>
                                    </div>
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
