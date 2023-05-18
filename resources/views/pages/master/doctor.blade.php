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
            <div>
                <div>
                    <a href="{{ url('pages/master/form/' . $title) }}"
                        class="btn btn-success waves-effect waves-light mb-3"><i
                            class="mdi mdi-plus me-1"></i>@lang('doctor.button_add')</a>
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                        style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                        <thead>
                            <tr class="bg-transparent">
                                <th>@lang('doctor.nik')/@lang('doctor.nip')</th>
                                <th>@lang('doctor.name')</th>
                                <th>@lang('doctor.specialist')</th>
                                <th>@lang('doctor.gender')</th>
                                <th>@lang('doctor.placebirth')</th>
                                <th>@lang('doctor.birthdate')</th>
                                <th>@lang('doctor.age')</th>
                                <th>@lang('doctor.academic')</th>
                                <th>@lang('doctor.religion')</th>
                                <th>@lang('doctor.address')</th>
                                <th>@lang('doctor.phone')</th>
                                <th>@lang('doctor.email')</th>
                                <th style="width: 120px;">@lang('doctor.action')</th>
                            </tr>
                        </thead>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->nik }}/{{ $item->nip }}</td>
                                        <td>
                                            <img src="{{ URL::asset($item->photos) }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <span>{{ $item->name }}, {{ $item->degree }}</span>
                                        </td>
                                        <td>
                                            {{ $item->specialist->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $item->gender == 'L' ? 'Laki Laki' : 'Perempuan' }}
                                        </td>
                                        <td>
                                            {{ $item->placebirth }}
                                        </td>
                                        <td>
                                            {{ $item->birthdate }}
                                        </td>
                                        <td>
                                            {{ round($item->age / 365) }}
                                        </td>
                                        <td>
                                            {{ $item->academic }}
                                        </td>
                                        <td>
                                            {{ $item->religion }}
                                        </td>
                                        <td>
                                            {{ $item->province . ', ' . $item->district . ', ' . $item->subdistrict . ', ' . $item->village . ', ' . $item->rtrw }}
                                        </td>
                                        <td>
                                            {{ $item->phone }}
                                        </td>
                                        <td>
                                            {{ $item->email }}
                                        </td>
                                        <td>
                                            <a href="{{ url('pages/master/form/' . $title . '/' . $item->id) }}"
                                                class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
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
