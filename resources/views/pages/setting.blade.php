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
                    <h4 class="card-title">@lang('setting.display')</h4>
                    <p class="card-title-desc">@lang('setting.display_desc')</p>

                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h6>@lang('setting.display')</h6>
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
                            <h6>@lang('setting.bahasa')</h6>
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
                    <h4 class="card-title">@lang('setting.identitas')</h4>
                    <p class="card-title-desc">@lang('setting.identitas_desc')</p>
                    <form action="{{ route('setting') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">@lang('setting.name')</label>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    type="text" placeholder="@lang('setting.name')" id="example-text-input"
                                    value="{{ auth()->user()->identity ? auth()->user()->identity->name : '' }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">@lang('setting.phone')</label>
                            <div class="col-md-10">
                                <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    type="text" placeholder="@lang('setting.phone')" id="example-text-input"
                                    value="{{ auth()->user()->identity ? auth()->user()->identity->phone : '' }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">@lang('setting.email')</label>
                            <div class="col-md-10">
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    type="text" placeholder="@lang('setting.email')" id="example-text-input"
                                    value="{{ auth()->user()->identity ? auth()->user()->identity->email : '' }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">@lang('setting.gender')</label>
                            <div class="col-md-10">
                                <select name="gender" id="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">select</option>
                                    <option value="L"
                                        {{ auth()->user()->identity ? (auth()->user()->identity->gender == 'L' ? 'selected' : '') : '' }}>
                                        Laki Laki</option>
                                    <option value="P"
                                        {{ auth()->user()->identity ? (auth()->user()->identity->gender == 'P' ? 'selected' : '') : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">@lang('setting.button')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (auth()->user()->identity)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('setting.registrasi')</h4>
                        <p class="card-title-desc">@lang('setting.registrasidetail')</p>
                        <div>
                            <div class="table-responsive mb-4">
                                <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                                    style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                    <thead>
                                        <tr class="bg-transparent">
                                            <th>#</th>
                                            <th>@lang('patient.name')</th>
                                            <th>@lang('patient.gender')</th>
                                            <th>@lang('setting.tgl_daftar')</th>
                                            <th>@lang('setting.tgl_periksa')</th>
                                            <th>@lang('setting.doctor')</th>
                                            <th>@lang('setting.status')</th>
                                            <th>@lang('setting.harga')</th>
                                            <th>@lang('patient.address')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($registrations) > 0)
                                            @foreach ($registrations as $item)
                                                <tr>
                                                    <td>{{ $item->registrationID . ' / ' . $item->medicalRecordID }}</td>
                                                    <td>
                                                        <img src="{{ URL::asset($item->patient->photos) }}"
                                                            alt="" class="avatar-xs rounded-circle me-2">
                                                        <span>{{ $item->patient->name }}</span>
                                                    </td>
                                                    <td>{{ $item->patient->gender == 'L' ? 'Laki Laki' : 'Perempuan' }}
                                                    </td>
                                                    <td>{{ date('d M Y', strtotime($item->registrationDate)) . ' / ' . date('H:i', strtotime($item->registrationTime)) . ' WIB' }}
                                                    </td>
                                                    <td>{{ date('d M Y', strtotime($item->checkDate)) . ' / ' . date('H:i', strtotime($item->checkTime)) . ' WIB' }}
                                                    </td>
                                                    <td>{{ $item->doctor->name ?? '' }}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td>{{ number_format($item->price, 2, ',', '.') }}</td>
                                                    <td>{{ $item->patient->province . ', ' . $item->patient->district . ', ' . $item->patient->subdistrict . ', ' . $item->patient->village . ', ' . $item->patient->rtrw }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2">No data in this table</td>
                                                <td class="d-none"></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('setting.patient')</h4>
                        <p class="card-title-desc">@lang('setting.patient_desc')</p>
                        <div>
                            <div>
                                <a href="{{ route('patient') }}" class="btn btn-success waves-effect waves-light mb-3"><i
                                        class="mdi mdi-plus me-1"></i>@lang('patient.button_add')</a>
                            </div>
                            <div class="table-responsive mb-4">
                                <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                                    style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                    <thead>
                                        <tr class="bg-transparent">
                                            <th>@lang('patient.nik')</th>
                                            <th>@lang('patient.name')</th>
                                            <th>@lang('patient.gender')</th>
                                            <th>@lang('patient.placebirth')</th>
                                            <th>@lang('patient.birthdate')</th>
                                            <th>@lang('patient.age')</th>
                                            <th>@lang('patient.academic')</th>
                                            <th>@lang('patient.religion')</th>
                                            <th>@lang('patient.work')</th>
                                            <th>@lang('patient.address')</th>
                                            <th>@lang('patient.phone')</th>
                                            <th>@lang('patient.email')</th>
                                            <th>@lang('patient.ktp')</th>
                                            <th style="width: 120px;">@lang('patient.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count(auth()->user()->identity->patients) > 0)
                                            @foreach (auth()->user()->identity->patients as $item)
                                                <tr>
                                                    <td>{{ $item->patient->nik }}</td>
                                                    <td>
                                                        <img src="{{ URL::asset($item->patient->photos) }}"
                                                            alt="" class="avatar-xs rounded-circle me-2">
                                                        <span>{{ $item->patient->name }}</span>
                                                    </td>
                                                    <td>{{ $item->patient->gender == 'L' ? 'Laki Laki' : 'Perempuan' }}
                                                    </td>
                                                    <td>{{ $item->patient->placebirth }}</td>
                                                    <td>{{ date('d M Y', strtotime($item->patient->birthdate)) }}</td>
                                                    <td>{{ round($item->patient->age / 365) }}</td>
                                                    <td>{{ $item->patient->academic }}</td>
                                                    <td>{{ $item->patient->religion }}</td>
                                                    <td>{{ $item->patient->work }}</td>
                                                    <td>{{ $item->patient->province . ', ' . $item->patient->district . ', ' . $item->patient->subdistrict . ', ' . $item->patient->village . ', ' . $item->patient->rtrw }}
                                                    </td>
                                                    <td>{{ $item->patient->phone }}</td>
                                                    <td>{{ $item->patient->email }}</td>
                                                    <td>
                                                        <a href="{{ URL::asset($item->patient->ktp) }}"
                                                            target="blank"><img
                                                                src="{{ URL::asset($item->patient->ktp) }}"
                                                                alt="" class="avatar-xs rounded-circle me-2"></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('setting.patient.edit', $item->patientID) }}"
                                                            class="px-3 text-primary"><i
                                                                class="uil uil-pen font-size-18"></i></a>
                                                        <a href="javascript:void(0);"
                                                            class="px-3 text-danger  button-delete" data-model="room"
                                                            data-id="{{ $item->patient->id }}"><i
                                                                class="uil uil-trash-alt font-size-18"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2">No data in this table</td>
                                                <td class="d-none"></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
