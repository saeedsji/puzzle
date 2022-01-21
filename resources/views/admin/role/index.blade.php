@extends('layouts.panel')
@section('title', 'نقش ها')

@section('style')
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">نقش ها</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">نقش ها</a></li>
                        <li class="breadcrumb-item active">لیست نقش ها</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-3">
                    <a href="{{route('role.create')}}" type="button" class="btn btn-light waves-effect">
                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> افزودن
                    </a>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-4"> تعداد : {{$count}}</h4>


                    <div class="table-responsive table-hover">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>دسترسی ها</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{$role->name}} </td>
                                    <td>
                                        @foreach($role->permissions->pluck('name')->toArray() as $permission)
                                            <span class="badge badge-light">{{$permission}}</span>
                                        @endforeach

                                    </td>
                                    <td>

                                        <form action="{{ route('role.destroy', $role->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a title="ویرایش " class="text-success"  href="{{ route('role.edit',$role->id) }}">
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
                        {!! $roles->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
