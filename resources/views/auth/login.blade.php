@extends('layouts.auth')
@section('title', 'ورود')

@section('style')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-login text-center">
                        <div class="bg-login-overlay"></div>
                        <div class="position-relative">
                            <h5 class="text-white font-size-20">خوش آمدید!</h5>
                            <p class="text-white-50 mb-0">جهت دسترسی به پنل مدیریت وارد شوید</p>
                            <a href="/" class="logo logo-admin mt-4">
                                <img src="/assets/panel/images/logo-sm-dark.png" alt="" height="30">
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <div class="p-2">
                            <form class="form-horizontal" action="{{route('loginPost')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="phone">شماره موبایل</label>
                                    <input type="text" class="form-control englishText" id="phone" name="phone"
                                           value="{{old('phone')}}">
                                    @error('phone')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">رمز عبور</label>
                                    <input type="password" class="form-control englishText" id="password"
                                           name="password">
                                    @error('password')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                                <div class="form-group text-center">
                                    {!! captcha_img('math'); !!}
                                </div>
                                <div class="form-group">
                                    <label for="captcha" class="label-element">عبارت امنیتی </label>
                                    <input name="captcha" type="text" class="form-control text-center"  autocomplete="off" dir="ltr"  id="captcha">
                                    @error('captcha')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">
                                        ورود
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
