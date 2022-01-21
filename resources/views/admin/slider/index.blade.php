@extends('layouts.panel')
@section('title', 'اسلایدر ها')

@section('style')
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">اسلایدر ها</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-3">
                    <a href="{{route('slider.create')}}" type="button" class="btn btn-light waves-effect">
                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> افزودن
                    </a>

                </div>

                <div class="card-body">
                    <h4 class="card-title mb-4"> تعداد : {{$count}}</h4>


                    <div class="table-responsive table-hover">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>ترتیب</th>
                                <th>عنوان</th>
                                <th>نوع</th>
                                <th>وضعیت</th>
                                <th>محل نمایش</th>
                                <th class="text-center">تصویر</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sliders as $slider)
                                <tr>
                                    <td>{{$slider->sort}} </td>
                                    <td>{{$slider->title}} </td>
                                    <td>{{\App\Enums\SliderType::get($slider->type)}}</td>
                                    <td>{!! \App\Enums\SliderStatus::getHtml($slider->status) !!}</td>
                                    <td>{{\App\Enums\SliderPosition::get($slider->position)}}</td>

                                    <td class="text-center">
                                        <a target="_blank" href="{{$slider->image}}">
                                            <img class="img-thumbnail" style="width: 60px;height: 30px;" src="{{$slider->image}}" alt="">
                                        </a>
                                    </td>
                                    <td>

                                        <form action="{{ route('slider.destroy', $slider->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a title="ویرایش " class="text-success"  href="{{ route('slider.edit',$slider->id) }}">
                                                <i class="fa fa-edit"> </i>
                                            </a>
                                            <button title="حذف" class="deleteBtn text-danger" onclick="return confirm('برای حذف این آیتم اطمینان دارید؟')" type="submit">
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
                        {!! $sliders->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
