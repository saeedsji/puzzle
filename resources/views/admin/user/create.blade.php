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
                        <li class="breadcrumb-item"><a href="{{route('user.index')}}">کاربران</a></li>
                        <li class="breadcrumb-item active">لیست کاربران</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <form action="{{ route('user.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">شماره موبایل</label>
                                    <input type="text" name="phone" class="form-control englishText"
                                           value="{{old('phone')}}" id="phone">
                                    @error('phone')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">نام و نام خانوادگی</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           value="{{old('name')}}">
                                    @error('name')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">ایمیل</label>
                                    <input type="text" name="email" class="form-control englishText" id="email"
                                           value="{{old('email')}}">
                                    @error('email')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">نوع کاربر</label>
                                    <select name="type" class="form-control" id="type">
                                        <option value="">انتخاب ...</option>
                                        @for ($i = 1; $i <= count(\App\Enums\UserType::getKeys())  ; $i++)
                                            <option value="{{$i}}" {{old('type') == $i ? 'selected' : ''}}>{{\App\Enums\UserType::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('type')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">رمز عبور</label>
                                    <input type="password" name="password" class="form-control englishText"
                                           id="password">
                                    @error('password')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="confirmPassword">تکرار رمز عبور</label>
                                    <input type="password" name="confirmPassword" class="form-control englishText"
                                           id="confirmPassword">
                                    @error('confirmPassword')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="userStatus">وضعیت کاربر</label>
                                    <select name="status" class="form-control" id="userStatus">
                                        <option value="">انتخاب ...</option>
                                        @for ($i = 1; $i <= count(\App\Enums\UserStatus::getKeys())  ; $i++)
                                            <option value="{{$i}}" {{old('status') == $i ? 'selected' : ''}}>{{\App\Enums\UserStatus::get($i)}}</option>
                                        @endfor
                                    </select>
                                    @error('status')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">نقش کاربر ادمین</label>
                                    <select id="role" name="role" class="form-control">
                                        <option value="">انتخاب ...</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('role')
                                    @include('admin.sections.validation')
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
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection
