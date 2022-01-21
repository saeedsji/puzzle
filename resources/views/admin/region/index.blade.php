@extends('layouts.panel')
@section('title', 'منطقه ها')

@section('style')
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">منطقه ها</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-3">
                    <a href="{{route('region.create')}}" type="button" class="btn btn-light waves-effect">
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
                                <th>شهر</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($regions as $region)
                                <tr>
                                    <td>{{$region->sort}} </td>
                                    <td>{{$region->name}} </td>
                                    <td>{{$region->city->name}} </td>
                                    <td>

                                        <form action="{{ route('region.destroy', $region->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a title="ویرایش " class="text-success"
                                               href="{{ route('region.edit',$region->id) }}">
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
                        {!! $regions->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
