@extends('layouts.panel')
@section('title', 'آگهی ها')

@section('style')

@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">آگهی ها</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">آگهی ها</a></li>
                        <li class="breadcrumb-item active">لیست آگهی ها</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">فیلتر آگهی</h4>
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
                    <a href="{{route('advertise.create')}}" type="button" class="btn btn-light waves-effect">
                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> افزودن
                    </a>
                </div>

                <div class="card-body">
                    <h4 class="card-title mb-4"> تعداد : {{$count}}</h4>


                    <div class="table-responsive table-hover">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>عنوان</th>
                                <th>وضعیت</th>
                                <th>ثبت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($advertises as $advertise)
                                <tr>
                                    <th>{{$advertise->user->name}}</th>
                                    <th>{{$advertise->title}}</th>
                                    <th>{!! \App\Enums\AdvertiseStatus::getHtml($advertise->status) !!}</th>
                                    <td class="small">{{\Morilog\Jalali\Jalalian::forge($advertise->created_at)->format('(H:i:s) Y/m/d')}}</td>
                                    <td>
                                        <a class="text-success" title="ویرایش"
                                           href="{{ route('advertise.edit',$advertise->id) }}"><i class="fa fa-edit"> </i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">موردی وجود ندارد ...</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <hr>
                        <div class="mt-4">
                            {!! $advertises->appends(['title'=>request('title'),'status'=>request('status'),'phone'=>request('phone'),'from'=>request('from'),'to'=>request('to') ,])->render() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
