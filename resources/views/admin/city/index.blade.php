@extends('layouts.panel')
@section('title', 'شهر ها')

@section('style')
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">شهر ها</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-3">
                    <a href="{{route('city.create')}}" type="button" class="btn btn-light waves-effect">
                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> افزودن
                    </a>
                </div>

                <div class="card-body">
                    <h4 class="card-title mb-4"> تعداد : {{$count}}</h4>


                    <div class="table-responsive table-hover">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>ترتیب نمایش</th>
                                <th>نام</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($cities as $city)
                                <tr>
                                    <td>{{$city->sort}} </td>
                                    <td>{{$city->name}} </td>
                                    <td>

                                        <form action="{{ route('city.destroy', $city->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a title="ویرایش " class="text-success"
                                               href="{{ route('city.edit',$city->id) }}">
                                                <i class="fa fa-edit"> </i>
                                            </a>
                                            <button title="حذف" class="deleteBtn text-danger"
                                                    onclick="return confirm('برای حذف این آیتم اطمینان دارید؟')"
                                                    type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">موردی وجود ندارد ...</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {!! $cities->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
