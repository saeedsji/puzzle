@extends('layouts.panel')
@section('title', '')

@section('style')
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">کاربران</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">کاربران</a></li>
                        <li class="breadcrumb-item active">لیست کاربران</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">فیلتر کاربران</h4>
                    <form class="needs-validation" novalidate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="validationCustom01">نام</label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="نام"
                                           value="جان" required="">
                                    <div class="valid-feedback">
                                        صحیح است!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="validationCustom02">نام خانوادگی</label>
                                    <input type="text" class="form-control" id="validationCustom02"
                                           placeholder="نام خانوادگی" value="اسنو" required="">
                                    <div class="valid-feedback">
                                        صحیح است!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <button type="button" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-filter-alt font-size-18 align-middle mr-2"></i> اعمال فیلتر
                        </button>
                        <a title="حذف تمام فیلتر ها" href="{{route('user.index')}}" type="button" class="btn btn-light waves-effect">
                            <i class="bx bx-rotate-left font-size-16 align-middle mr-2"></i>
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-3">
                    <a href="{{route('user.create')}}" type="button" class="btn btn-light waves-effect">
                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> افزودن
                    </a>
                    <a title="برای گرفتن خروجی اکسل با فیلتر لطفا ابتدا فیلتر را اعمال کنید" href="{{route('user.create')}}" type="button" class="btn btn-light waves-effect">
                        <i class="bx bx-export font-size-16 align-middle mr-2"></i> خروجی اکسل
                    </a>

                </div>

                <div class="card-body">
                    <h4 class="card-title mb-4"> تعداد : {{$count}}</h4>


                    <div class="table-responsive table-hover">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>شماره موبایل</th>
                                <th>نام</th>
                                <th>وضعیت</th>
                                <th>ثبت نام</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <th>{{$user->phone}}</th>
                                    <th>{{$user->name}}</th>
                                    <th>{!! \App\Enums\UserStatus::getHtml($user->status) !!}</th>
                                    <td class="small">{{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('(H:i:s) Y/m/d')}}</td>
                                    <td>

                                        <a class="text-success" title="ویرایش و پروفایل"
                                           href="{{ route('user.edit',$user->id) }}"><i class="fa fa-edit"> </i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">موردی وجود ندارد ...</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {!! $users->appends(['name'=>request('name'),'phone'=>request('phone'),'email'=>request('email'),'from'=>request('from'),'to'=>request('to') ,])->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
