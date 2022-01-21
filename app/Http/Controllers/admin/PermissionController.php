<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(20);
        $count = Permission::all()->count();
        return view('admin.permission.index', compact('permissions','count'));
    }
    public function create()
    {
        return view('admin.permission.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions',
        ]);
        Permission::create($validatedData);
        alert()->success('عملیات موفق', 'مورد جدید با موفقیت ثبت شد');
        return redirect(route('permission.index'));
    }

    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission )
    {
    
        $validatedData = $request->validate([
            'name' => ['required',Rule::unique('permissions', 'name')->ignore($permission->name, 'name')],
        ]);
        $permission->update($validatedData);
        alert()->success('عملیات موفق', 'بروزرسانی با موفقیت انجام شد');
        return redirect(route('permission.index'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        toast('آیتم مورد نظر با موفقیت حذف شد','success')->timerProgressBar();
        return back();
    }
}
