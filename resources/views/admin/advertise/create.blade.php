@extends('layouts.panel')
@section('title', 'افزودن آگهی')

@section('style')
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">افزودن آگهی</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('advertise.index')}}">آگهی ها</a></li>
                        <li class="breadcrumb-item active">افزودن آگهی</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <form action="{{ route('advertise.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">عنوان آگهی</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{old('title')}}">
                                    @error('title')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city_id">شهر</label>
                                    <select id="city_id" class="form-control city" name="city_id">
                                        <option value="">انتخاب شهر ...</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' :''}}>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                    @include('admin.components.validation')
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="region_id">منطقه</label>
                                    <select id="region_id" class="form-control region" name="region_id">
                                        @if(!empty(old('city_id')))
                                            @foreach(\App\Models\Region::where('city_id',old('city_id'))->sort()->get() as $region)
                                                <option value="{{$region->id}}" {{old('region_id') == $region->id ? 'selected' : ''}} >{{$region->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">لطفا ابتدا شهر را انتخاب کنید</option>
                                        @endif
                                    </select>
                                    @error('region_id')
                                    @include('admin.components.validation')
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">نوع آگهی</label>
                                    <select name="type" class="form-control" id="type">
                                        <option value="">انتخاب ...</option>
                                        @for ($i = 1; $i <= count(\App\Enums\AdvertiseType::getKeys())  ; $i++)
                                            <option value="{{$i}}" {{old('type') == $i ? 'selected' : ''}}>{{\App\Enums\AdvertiseType::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('type')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="advertiseStatus">وضعیت آگهی</label>
                                    <select name="status" class="form-control" id="advertiseStatus">
                                        <option value="">انتخاب ...</option>
                                        @for ($i = 1; $i <= count(\App\Enums\AdvertiseStatus::getKeys())  ; $i++)
                                            <option value="{{$i}}" {{old('status') == $i ? 'selected' : ''}}>{{\App\Enums\AdvertiseStatus::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('status')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">شماره تماس با آگهی</label>
                                    <input type="text" name="phone" class="form-control englishText" id="phone"
                                           value="{{old('phone')}}">
                                    @error('phone')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="whatsapp">شماره واتس اپ</label>
                                    <input type="text" name="whatsapp" class="form-control englishText" id="whatsapp"
                                           value="{{old('whatsapp')}}">
                                    @error('whatsapp')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10">{{old('description')}}</textarea>
                                    @error('description')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
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
                <div class="card">
                    <div class="card-content ">
                        <div class="card-body">
                            <h4 class="card-title mb-3">دسته بندی ها</h4>

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="height: 500px;overflow: scroll;">
                                        @foreach($categories as $category)
                                            <li>
                                                <input name="cats[]" value="{{$category->id}}"
                                                       id="{{$category->id}}" type="checkbox">
                                                <label for="{{$category->id}}">{{{ $category->name }}}</label>
                                                @if(count($category->childs))
                                                    @include('admin.components.createCat',['childs' => $category->childs])
                                                @endif
                                            </li>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $('.city').change(function () {
                if ($(this).val() != '') {
                    var city_id = $(this).val();
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "{{route('getRegionByCity')}}",
                        method: "POST",
                        data: {
                            city_id: city_id,
                            _token: _token
                        },
                        success: function (result) {
                            console.log(result);
                            $('.region').html(result);
                        }

                    })

                }
            });
        });
    </script>

@endsection
