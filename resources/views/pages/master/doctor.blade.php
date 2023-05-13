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
                                    <input type="text" name="nik" class="form-control" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.nip')</label>
                                    <input type="text" name="nip" class="form-control" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.name')</label>
                                    <input type="text" name="name" class="form-control" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.gelar')</label>
                                    <input type="text" name="initialDegree" class="form-control" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.tempat_lahir')</label>
                                    <input type="text" name="placebirth" class="form-control" required
                                        placeholder="Type something" />
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('doctor.tanggal_lahir')</label>
                                    <input type="text" name="birthdate" class="form-control" required
                                        placeholder="Type something" />
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
                                        <textarea required name="address" class="form-control" rows="5"></textarea>
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

    {{-- table --}}
    <div class="row mt-5">
        <div class="col-lg-12">
            <div>
                <div class="table-responsive mb-4">
                    <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                        style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                        <thead>
                            <tr class="bg-transparent">
                                <th>NIK</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Spesialist</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <img src="http://127.0.0.1:8000/assets/images/users/avatar-2.jpg" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <span>{{ $item->nik }}</span>
                                        </td>
                                        <td>{{ $item->name }}</td>

                                        <td>
                                            {{ $item->gender == 'L' ? 'Laki Laki' : 'Perempuan' }}
                                        </td>
                                        <td>
                                            <div class="badge bg-pill bg-soft-success font-size-12">{{ $item->specialist }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="px-3 text-primary"><i
                                                    class="uil uil-pen font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="px-3 text-danger"><i
                                                    class="uil uil-trash-alt font-size-18"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr colspan="5">
                                    <td>No data in this table</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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
