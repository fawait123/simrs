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
                            class="mdi mdi-plus me-1"></i>@lang('medicine.button_add')</a>
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                        style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                        <thead>
                            <tr class="bg-transparent">
                                <th>@lang('medicine.name')</th>
                                <th>@lang('medicine.dosis')</th>
                                <th>@lang('medicine.stok')</th>
                                <th>@lang('medicine.price')</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->dosage }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>{{ number_format($item->price, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ url('pages/master/form/' . $title . '/' . $item->id) }}"
                                                class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="px-3 text-danger  button-delete"
                                                data-model="medicine" data-id="{{ $item->id }}"><i
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
