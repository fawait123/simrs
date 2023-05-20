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
                    <h4 class="card-title">@lang('queue.title')</h4>
                    <p class="card-title-desc">@lang('queue.subtitle')</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">@lang('queue.cardtitle')</h4>
                                    <div data-simplebar style="max-height: 339px;">
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-centered table-nowrap">
                                                <tbody id="list-data-queue">
                                                    <tr>
                                                        <td colspan="4">
                                                            <b>@lang('queue.notfound')</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> <!-- enbd table-responsive-->
                                    </div> <!-- data-sidebar-->
                                </div><!-- end card-body-->
                                <div class="card-footer">
                                    <h6 class="float-start">@lang('queue.total')</h6>
                                    <h6 class="float-end" id="queue-total">0</h6>
                                </div>
                            </div> <!-- end card-->
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
        let url = '{{ route('list.queue.json') }}'
        let userID = '{{ auth()->user()->id }}'
        let user = {!! auth()->user()->toJson() !!}
        $(document).ready(function() {
            console.log(userID)
            $("select[name='patientID']").select2()
        })
    </script>
    <script src="{{ mix('js/queue.js') }}"></script>
@endsection
