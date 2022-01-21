@extends('layouts.panel')
@section('title', 'افزودن اسلایدر')

@section('style')
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">افزودن اسلایدر</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('slider.index')}}">کاربران</a></li>
                        <li class="breadcrumb-item active">لیست اسلایدر ها</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <form action="{{ route('slider.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sort">ترتیب</label>
                                    <input type="number" id="sort" class="form-control"
                                           name="sort"
                                           value="{{old('sort')}}">
                                    @error('sort')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="title">عنوان</label>
                                    <input type="text" id="title" class="form-control"
                                           name="title"
                                           value="{{old('title')}}">  @error('title')
                                    @include('admin.components.validation')
                                    @enderror

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="position">محل نمایش</label>
                                    <select id="position" name="position"
                                            class="form-control">
                                        <option value="">هیچکدام</option>
                                        @for ($i = 1; $i <= count(\App\Enums\SliderPosition::getKeys()); $i++)
                                            <option value="{{$i}}" {{old('position') == $i ? 'selected' : ''}}>{{\App\Enums\SliderPosition::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('position')
                                    @include('admin.components.validation')
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sliderStatus">وضعیت</label>
                                    <select id="sliderStatus" name="status"
                                            class="form-control">
                                        <option value="">هیچکدام</option>
                                        @for ($i = 1; $i <= count(\App\Enums\SliderStatus::getKeys()); $i++)
                                            <option value="{{$i}}" {{old('status') == $i ? 'selected' : ''}}>{{\App\Enums\SliderStatus::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('status')
                                    @include('admin.components.validation')
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">نوع</label>
                                    <select id="type" name="type"
                                            class="form-control">
                                        <option value="">هیچکدام</option>
                                        @for ($i = 1; $i <= count(\App\Enums\SliderType::getKeys()); $i++)
                                            <option value="{{$i}}" {{old('type') == $i ? 'selected' : ''}}>{{\App\Enums\SliderType::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('type')
                                    @include('admin.components.validation')
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12" id="productdiv" style="display: none;">
                                <div class="form-group">
                                    <label for="advertise_id">آگهی مربوطه</label>
                                    <select id="advertise_id" class="form-control select2" name="advertise_id"
                                            style="width: 100%;">
                                        <option value="">انتخاب دوره</option>
                                        @foreach($advertises as $advertise)
                                            <option value="{{$advertise->id}}" {{old('advertise_id') == $advertise->id ? 'selected' : ''}}>{{$advertise->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 " id="categorydiv" style="display: none;">
                                <div class="form-group">
                                    <label for="screen">صفحه اپلیکیشن</label>
                                    <select id="screen" name="screen"
                                            class="form-control">
                                        <option value="">هیچکدام</option>
                                        @for ($i = 1; $i <= count(\App\Enums\Screen::getKeys()); $i++)
                                            <option value="{{\App\Enums\Screen::getKey($i)}}" {{old('screen') == \App\Enums\Screen::getKey($i) ? 'selected' : ''}}>{{\App\Enums\Screen::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('screen')
                                    @include('admin.components.validation')
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-12" id="linkdiv" style="display: none;">
                                <div class="form-group">
                                    <label for="link">لینک </label>
                                    <input type="text" placeholder="Example:https://aramia.me/" id="link"
                                           class="form-control englishText" value="{{old('link')}}"
                                           name="link">
                                    @error('link')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="position">تصویر اسلایدر</label>
                                <div class="input-group">
                                    <input wire:model.lazy="image" type="text" id="image_label"
                                           class="form-control englishText"
                                           name="image" value="{{old('image')}}"
                                           aria-label="Image" aria-describedby="button-image">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button"
                                                id="button-image">انتخاب تصویر
                                        </button>
                                    </div>
                                </div>
                                @error('image')
                                @include('admin.components.validation')
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <img id="showImage" class="img-thumbnail" src="" alt="">
                            </div>
                        </div>





                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">عملیات</h4>
                        <hr/>
                        <button type="submit" class="btn btn-success waves-effect waves-light w-100">
                            <i class="bx bx-check font-size-18 align-middle mr-2"></i>ثبت اطلاعات
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')

    <script>

        $(document).ready(function () {
            $('#type').on('change', function () {
                if (this.value == 1) {
                    $("#productdiv").show();
                } else {
                    $("#productdiv").hide();
                }
                if (this.value == 2) {
                    $("#categorydiv").show();
                } else {
                    $("#categorydiv").hide();

                }
                if (this.value == 3) {
                    $("#linkdiv").show();
                } else {
                    $("#linkdiv").hide();

                }
            });
        });

        $(function () {
            $('.select2').select2()
        });

        $(document).ready(function () {
            var type = $("#type").val();
            if (type == 1) {
                $("#productdiv").show();
            } else {
                $("#productdiv").hide();
            }
            if (type == 2) {
                $("#categorydiv").show();
            } else {
                $("#categorydiv").hide();

            }
            if (type == 3) {
                $("#linkdiv").show();
            } else {
                $("#linkdiv").hide();

            }

            var image = $("#selectedImageInput").val();
            $('#previwe').attr('src', image);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });

        // set file link
        function fmSetLink($url) {
            document.getElementById('image_label').value = $url;
            $('#showImage').attr('src', $url);
        }
    </script>
    <script>
        $(document).ready(function () {
            url = document.getElementById('image_label').value;
            $('#showImage').attr('src', url);
        });

    </script>
@endsection
