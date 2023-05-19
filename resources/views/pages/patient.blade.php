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
            @endslo
        @endcomponent

        @php
            if (isset($id)):
                $regionals = '';
                foreach (json_decode($data->regionals) as $item):
                    $regionals .= $item . '|';
                endforeach;
            endif;
        @endphp

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('patient.form_title')</h4>
                        <p class="card-title-desc">@lang('patient.form_subtitle')</p>

                        <form class="custom-validation"
                            action="{{ isset($id) ? route('setting.patient.update', $id) : route('setting.patient.store') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @if (isset($id))
                                @method('put')
                            @endif
                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.nik')</label>
                                        <input type="text" name="nik" class="form-control"
                                            value="{{ isset($id) ? $data->nik : old('nik') }}" required
                                            placeholder="@lang('patient.nik')" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.name')</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ isset($id) ? $data->name : old('name') }}" required
                                            placeholder="@lang('patient.name')" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.gender')</label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">select</option>
                                            <option value="L"
                                                {{ isset($id) ? (($data->gender == 'L' ? 'selected' : old('gender') == 'L') ? 'selected' : '') : '' }}>
                                                Laki Laki</option>
                                            <option value="P"
                                                {{ isset($id) ? (($data->gender == 'P' ? 'selected' : old('gender') == 'P') ? 'selected' : '') : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.placebirth')</label>
                                        <input type="text" name="placebirth" class="form-control"
                                            value="{{ isset($id) ? $data->placebirth : old('placebirth') }}" required
                                            placeholder="@lang('patient.placebirth')" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.birthdate')</label>
                                        <input type="date" name="birthdate" class="form-control"
                                            value="{{ isset($id) ? $data->birthdate : old('birthdate') }}" required
                                            placeholder="@lang('patient.birthdate')" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.academic')</label>
                                        <select name="academic" id="academic" class="form-control" required>
                                            <option value="">select</option>
                                            <option value="SD"
                                                {{ isset($id) ? (($data->academic == 'SD' ? 'selected' : old('academic') == 'SD') ? 'selected' : '') : '' }}>
                                                SD</option>
                                            <option value="SMP"
                                                {{ isset($id) ? (($data->academic == 'SMP' ? 'selected' : old('academic') == 'SMP') ? 'selected' : '') : '' }}>
                                                SMP</option>
                                            <option value="SMA"
                                                {{ isset($id) ? (($data->academic == 'SMA' ? 'selected' : old('academic') == 'SMA') ? 'selected' : '') : '' }}>
                                                SMA</option>
                                            <option value="D3/S1"
                                                {{ isset($id) ? (($data->academic == 'D3/S1' ? 'selected' : old('academic') == 'D3/S1') ? 'selected' : '') : '' }}>
                                                D3/S1</option>
                                            <option value="S2"
                                                {{ isset($id) ? (($data->academic == 'S2' ? 'selected' : old('academic') == 'S2') ? 'selected' : '') : '' }}>
                                                S2</option>
                                            <option value="S3"
                                                {{ isset($id) ? (($data->academic == 'S3' ? 'selected' : old('academic') == 'S3') ? 'selected' : '') : '' }}>
                                                S3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.religion')</label>
                                        <select name="religion" id="religion" class="form-control" required>
                                            <option value="">select</option>
                                            <option value="Islam"
                                                {{ isset($id) ? (($data->religion == 'Islam' ? 'selected' : old('religion') == 'Islam') ? 'selected' : '') : '' }}>
                                                Islam</option>
                                            <option value="Kristen"
                                                {{ isset($id) ? (($data->religion == 'Kristen' ? 'selected' : old('religion') == 'Kristen') ? 'selected' : '') : '' }}>
                                                Kristen</option>
                                            <option value="Hindu"
                                                {{ isset($id) ? (($data->religion == 'Hindu' ? 'selected' : old('religion') == 'Hindu') ? 'selected' : '') : '' }}>
                                                Hindu</option>
                                            <option value="Buddha"
                                                {{ isset($id) ? (($data->religion == 'Buddha' ? 'selected' : old('religion') == 'Buddha') ? 'selected' : '') : '' }}>
                                                Buddha</option>
                                            <option value="Konghucu"
                                                {{ isset($id) ? (($data->religion == 'Konghucu' ? 'selected' : old('religion') == 'Konghucu') ? 'selected' : '') : '' }}>
                                                Konghucu</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.work')</label>
                                        <input type="text" name="work" class="form-control"
                                            value="{{ isset($id) ? $data->work : old('work') }}" required
                                            placeholder="@lang('patient.work')" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.province')</label>
                                        <select name="province" id="province" class="form-control select2-province"
                                            required></select>
                                    </div>
                                    <input type="hidden" name="provinces">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.district')</label>
                                        <select name="district" id="district" class="form-control select2-district" required>
                                            <option value="">select district</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="districts">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.subdistrict')</label>
                                        <select name="subdistrict" id="subdistrict" class="form-control select2-subdistrict"
                                            required>
                                            <option value="">select subdistrict</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="subdistricts">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.village')</label>
                                        <select name="village" id="village" class="form-control select2-village" required>
                                            <option value="">select village</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="villages">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">@lang('patient.rt')</label>
                                                <input type="text" name="rt" class="form-control"
                                                    value="{{ isset($id) ? explode('/', $data->rtrw)[0] ?? '' : old('rw') }}"
                                                    required placeholder="@lang('patient.rt')" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">@lang('patient.rw')</label>
                                                <input type="text" name="rw" class="form-control"
                                                    value="{{ isset($id) ? explode('/', $data->rtrw)[1] ?? '' : old('rw') }}"
                                                    required placeholder="@lang('patient.rw')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.phone')</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ isset($id) ? $data->phone : old('phone') }}" required
                                            placeholder="@lang('patient.phone')" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.email')</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ isset($id) ? $data->email : old('email') }}" required
                                            placeholder="@lang('patient.email')" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.photos')</label>
                                        <input type="file" name="photos" class="form-control"
                                            data-allowed-file-extensions="jpg jpeg png svg"
                                            data-default-file="{{ isset($id) ? URL::asset($data->photos) : '' }}"
                                            value="{{ isset($id) ? $data->photos : old('photos') }}"
                                            {{ isset($id) ? '' : 'required' }} placeholder="@lang('patient.photos')" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('patient.ktp')</label>
                                        <input type="file" name="ktp" class="form-control"
                                            data-allowed-file-extensions="jpg jpeg png svg"
                                            data-default-file="{{ isset($id) ? URL::asset($data->ktp) : '' }}"
                                            value="{{ isset($id) ? $data->ktp : old('ktp') }}"
                                            {{ isset($id) ? '' : 'required' }} placeholder="@lang('patient.ktp')" />
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
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script>
        function clearOptions(id) {
            //$('#' + id).val(null);
            $('.' + id).empty().trigger('change');
        }

        function province() {
            const urlProvinsi = "{{ URL::asset('regionals/provinsi.json') }}";
            let regionals = []

            console.log('Load Provinsi...');
            fetch(urlProvinsi).then((res) => res.json()).then((data) => {
                let responseData = $.map(data, function(obj) {
                    obj.text = obj.nama
                    return obj;
                });

                const datas = [{
                    id: "",
                    nama: "- Pilih Provinsi -",
                    text: "- Pilih Provinsi -"
                }].concat(responseData);

                //implemen data ke select provinsi
                $(".select2-province").select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    data: datas
                })
            })

        }

        function district() {
            const urlKabupaten = "{{ URL::asset('regionals/kabupaten/') }}";
            var selectProv = $('.select2-province');
            $(selectProv).change(function() {
                var value = $(selectProv).find(':selected').val();
                var text = $(selectProv).find(':selected').text();
                let concat = value + ":" + text;

                $("input[name='provinces']").val(concat)

                clearOptions('select2-district');

                if (value) {
                    console.log(urlKabupaten + "/" + value + ".json")
                    fetch(urlKabupaten + "/" + value + ".json").then((res) => res.json()).then((
                        data) => {
                        const responseData = $.map(data, function(obj) {
                            obj.text = obj.nama
                            return obj;
                        });

                        const datas = [{
                            id: "",
                            nama: "- Pilih Kabupaten -",
                            text: "- Pilih Kabupaten -"
                        }].concat(responseData);

                        //implemen data ke select provinsi
                        $(".select2-district").select2({
                            dropdownAutoWidth: true,
                            width: '100%',
                            data: datas
                        })
                    })
                }
            });
        }

        function subdistrict1() {
            const urlKecamatan = "{{ URL::asset('regionals/kecamatan/') }}";
            var selectKab = $('.select2-district');
            $(selectKab).change(function() {
                var value = $(selectKab).find(':selected').val();
                var text = $(selectKab).find(':selected').text();
                clearOptions('select2-subdistrict');

                if (value) {
                    console.log(urlKecamatan + "/" + value + ".json")
                    fetch(urlKecamatan + "/" + value + ".json").then((res) => res.json()).then((
                        data) => {
                        const responseData = $.map(data, function(obj) {
                            obj.text = obj.nama
                            return obj;
                        });

                        const datas = [{
                            id: "",
                            nama: "- Pilih kecamatan -",
                            text: "- Pilih kecamatan -"
                        }].concat(responseData);

                        //implemen data ke select provinsi
                        $(".select2-subdistrict").select2({
                            dropdownAutoWidth: true,
                            width: '100%',
                            data: datas
                        })

                        let concat = value + ":" + text;

                        $("input[name='districts']").val(concat)
                    })
                }
            });
        }

        function subdistrict() {
            const urlKelurahan = "{{ URL::asset('regionals/kelurahan/') }}";
            var selectKec = $('.select2-subdistrict');
            $(selectKec).change(function() {
                var value = $(selectKec).find(':selected').val();
                var text = $(selectKec).find(':selected').text();
                clearOptions('select2-village');

                if (value) {
                    console.log(urlKelurahan + "/" + value + ".json")
                    fetch(urlKelurahan + "/" + value + ".json").then((res) => res.json()).then((
                        data) => {
                        const responseData = $.map(data, function(obj) {
                            obj.text = obj.nama
                            return obj;
                        });

                        const datas = [{
                            id: "",
                            nama: "- Pilih kelurahan -",
                            text: "- Pilih kelurahan -"
                        }].concat(responseData);

                        //implemen data ke select provinsi
                        $(".select2-village").select2({
                            dropdownAutoWidth: true,
                            width: '100%',
                            data: datas
                        })

                        let concat = value + ":" + text;

                        $("input[name='subdistricts']").val(concat)

                    })
                }
            });
        }

        function village() {
            var selectKel = $('.select2-village');
            $(selectKel).change(function() {
                var value = $(selectKel).find(':selected').val();
                var text = $(selectKel).find(':selected').text();

                if (value) {
                    console.log("on change selectKel");

                    // var text = $('#select2-kelurahan :selected').text();
                    console.log("value = " + value + " / " + "text = " + text);

                    let concat = value + ":" + text;
                    console.log(concat)

                    $("input[name='villages']").val(concat)
                }
            });
        }
        $(document).ready(function() {
            // url regionals
            province()
            district()
            subdistrict1()
            subdistrict()
            village()

            // dropify
            $("input[name='photos']").dropify()
            $("input[name='ktp']").dropify()
            // select2
            $(".select2-province").select2()
            $(".select2-district").select2()
            $(".select2-subdistrict").select2()
            $(".select2-village").select2()
        })
    </script>
    @if (isset($id))
        <script>
            $(document).ready(function() {
                let regionals = '{{ $regionals }}'
                regionals = regionals.split("|")
                regionals = regionals.filter((el) => el != '')
                let province = regionals[0]
                let district = regionals[1]
                let subdistrict = regionals[2]
                let village = regionals[3]
                let option1 = $("<option selected></option>").val(province.split(":")[0]).text(province.split(":")[1]);
                $('.select2-province').append(option1).trigger('change')
                let option2 = $("<option selected></option>").val(district.split(":")[0]).text(district.split(":")[1]);
                $('.select2-district').append(option2).trigger('change')
                let option3 = $("<option selected></option>").val(subdistrict.split(":")[0]).text(subdistrict.split(
                    ":")[1]);
                $('.select2-subdistrict').append(option3).trigger('change')
                let option4 = $("<option selected></option>").val(village.split(":")[0]).text(village.split(
                    ":")[1]);
                $('.select2-village').append(option4).trigger('change')
            })
        </script>
    @endif
@endsection
