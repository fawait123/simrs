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
