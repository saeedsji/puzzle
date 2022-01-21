@extends('layouts.panel')
@section('title', 'افزودن دسته بندی')

@section('style')
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">افزودن دسته بندی</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('category.index')}}">دسته بندی ها</a></li>
                        <li class="breadcrumb-item active">افزودن دسته بندی</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <form action="{{ route('category.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sort">ترتیب نمایش</label>
                                    <input type="number" name="sort" class="form-control" id="sort"
                                           value="{{old('sort')}}">
                                    @error('sort')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">نام دسته بندی</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           value="{{old('name')}}">
                                    @error('name')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categoryStatus">وضعیت</label>
                                    <select name="status" class="form-control" id="categoryStatus">
                                        <option value="">انتخاب ...</option>
                                        @for ($i = 1; $i <= count(\App\Enums\CategoryStatus::getKeys())  ; $i++)
                                            <option value="{{$i}}" {{old('status') == $i ? 'selected' : ''}}>{{\App\Enums\CategoryStatus::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('status')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="parent_id">سر دسته</label>
                                    <select name="parent_id" class="form-control" id="parent_id">
                                        <option value="0">هیچکدام (دسته اصلی)</option>
                                        @foreach ($categories  as $category)
                                            <option value="{{$category->id}}" {{$default_parent_id == $category->id ? 'selected' : '' }} {{old('parent_id') == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                                            @foreach($category->childs as $child)
                                                <option value="{{$child->id}}" {{$default_parent_id == $child->id ? 'selected' : '' }} {{old('parent_id') == $child->id ? 'selected' : ''}}>
                                                    - {{$child->name}}</option>
                                                @foreach($child->childs as $child_child)
                                                    <option value="{{$child_child->id}}" {{$default_parent_id == $child_child->id ? 'selected' : '' }} {{old('parent_id') == $child_child->id ? 'selected' : ''}}>
                                                        -  - {{$child_child->name}}</option>
                                                @endforeach
                                            @endforeach

                                        @endforeach
                                    </select>
                                    @error('parent_id')
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
                            <h4 class="card-title">آیکن دسته بندی</h4>
                            <div class="row">
                                <div class="col-md-12">
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
                                        @error('image')
                                        @include('admin.sections.validation')
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <img id="showImage" class="img-thumbnail" src="" alt="">
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
