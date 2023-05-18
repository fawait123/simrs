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
                {{-- <div>
                    <a href="{{ url('pages/master/form/' . $title) }}"
                        class="btn btn-success waves-effect waves-light mb-3"><i
                            class="mdi mdi-plus me-1"></i>@lang('user.button_add')</a>
                </div> --}}
                <div class="table-responsive mb-4">
                    <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                        style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                        <thead>
                            <tr class="bg-transparent">
                                <th>@lang('user.name')</th>
                                <th>@lang('user.email')</th>
                                <th>@lang('user.role')</th>
                                <th>@lang('user.is_verified')</th>
                                <th style="width: 120px;">@lang('user.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                @foreach ($data as $item)
                                    @if ($item->id != 1)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $item->is_verified == 1 ? 'primary' : 'danger' }} text-white">{{ $item->is_verified == 1 ? 'terverifikasi' : 'belum diverfifikasi' }}</span>
                                            </td>
                                            <td align="center">
                                                {{-- <a href="{{ url('pages/master/form/' . $title . '/' . $item->id) }}"
                                                    class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a> --}}
                                                <div
                                                    style="display: flex; flex-direction: row;justify-content: center;align-items: center;">
                                                    <div
                                                        style="display: flex; flex-direction: row;justify-content: center;align-items: center;">
                                                        <input type="checkbox" id="switch{{ $loop->iteration }}"
                                                            switch="none" {{ $item->is_verified == 1 ? 'checked' : '' }}
                                                            data-id="{{ $item->id }}" />
                                                        <label for="switch{{ $loop->iteration }}" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                    </div>
                                                    <div
                                                        style="display: flex; flex-direction: row;justify-content: center;align-items: center;">
                                                        <a href="javascript:void(0);"
                                                            class="px-3 text-danger  button-delete" data-model="room"
                                                            data-id="{{ $item->id }}"><i
                                                                class="uil uil-trash-alt font-size-18"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
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

    <script>
        $(document).ready(function() {
            $("input[type='checkbox']").change(function() {
                let id = $(this).data('id')
                $.ajax({
                    url: "{{ route('user.status') }}",
                    type: "post",
                    data: {
                        id: id,
                        _method: 'put',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        // console.log(res)
                        window.location.reload();
                    }
                })
            })
        })
    </script>
@endsection
