@extends('layouts.panel')
@section('title', 'دسته بندی ها')

@section('style')
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">دسته بندی ها</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-3">
                    @if(!empty($parent))
                        <a href="/admin/category?parent_id={{$parent->parent_id}}" type="button"
                           class="btn btn-light waves-effect">
                            <i class="bx bx-right-arrow-alt font-size-16 align-middle mr-2"></i> بازگشت
                        </a>
                    @endif

                    <a href="{{route('category.create')}}?parent_id={{!empty($parent->id) ? $parent->id : 0}}" type="button" class="btn btn-light waves-effect">
                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> افزودن
                    </a>
                </div>

                <div class="card-body">
                    <h4 class="card-title mb-4"> تعداد : {{$count}}</h4>
                    <h4 class="card-title mb-4">
                        @if(!empty($parent))
                            زیر دسته های : {{$parent->name}}
                        @else
                            دسته بندی های اصلی
                        @endif
                    </h4>
                    <div class="table-responsive table-hover">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>ترتیب</th>
                                <th>نام</th>
                                <th>وضعیت</th>
                                <th>زیردسته</th>
                                <th>آیکن</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <th>{{$category->sort}}</th>
                                    <th>{{$category->name}}</th>
                                    <th>{!! \App\Enums\CategoryStatus::getHtml($category->status) !!}</th>
                                    <th>{{$category->childs->count()}}</th>
                                    <th>
                                        @if($category->image)
                                            <a target="_blank" href="{{$category->image}}">
                                                <img class="img-thumbnail" src="{{$category->image}}"
                                                     style="height: 30px;width: 30px;" alt="">
                                            </a>

                                        @endif
                                    </th>
                                    <td>

                                        <form action="{{ route('category.destroy', $category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            @if($category->childs->count() > 0)
                                                <a class="text-primary" title="زیر دسته ها"
                                                   href="/admin/category?parent_id={{$category->id}}"><i
                                                            class="fa fa-list-alt mr-2"> </i></a>
                                            @endif

                                            <a class="text-success" title="ویرایش"
                                               href="{{ route('category.edit',$category->id) }}"><i
                                                        class="fa fa-edit"> </i></a>


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
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <h4 class="card-title"> نمایش درختی دسته بندی ها</h4>
                        <div class="container-fluid">
                            <div class="font-weight-bolder font-size-base mb-2 cursor-pointer">
                                <a class="{{empty(request('parent_id')) ? 'text-danger' : '' }}"
                                   href="{{route('category.index')}}">دسته بندی های اصلی</a>
                            </div>

                            @foreach($tree as $category)
                                <li style="cursor: pointer;">
                                    <a class="{{request('parent_id') == $category->id ? 'text-danger' : '' }}"
                                       title="مشاهده زیر دسته ها"
                                       href="/admin/category?parent_id={{$category->id}}">{{ $category->name }}</a>
                                    @if(count($category->childs))
                                        @include('admin.components.cat',['childs' => $category->childs])
                                    @endif
                                </li>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('script')
@endsection
