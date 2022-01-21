@extends('layouts.panel')
@section('title', 'ویرایش شهر')

@section('style')
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ویرایش شهر</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('city.index')}}">دسترسی ها</a></li>
                        <li class="breadcrumb-item active">ویرایش شهر</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <form action="{{ route('city.update',$city->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sort">ترتیب نمایش</label>
                                    <input type="number" name="sort" class="form-control englishText" id="sort"
                                           value="{{$city->sort}}">
                                    @error('sort')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">نام شهر</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           value="{{$city->name}}">
                                    @error('name')
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
                            <i class="bx bx-check font-size-18 align-middle mr-2"></i>بروزرسانی اطلاعات
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </form>

@endsection

@section('script')
@endsection
