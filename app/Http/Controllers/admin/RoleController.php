<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(20);
        $count = Role::all()->count();
        return view('admin.role.index', compact('roles', 'count'));
    }
    
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create',compact('permissions'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
        ]);
        $role = Role::create($validatedData);
        $role->syncPermissions($request['permissions']);
        alert()->success('عملیات موفق', 'مورد جدید با موفقیت ثبت شد');
        return redirect(route('role.index'));
    }
    
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role','permissions'));
    }
    
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('roles', 'name')->ignore($role->name, 'name')],
        ]);
        $role->update($validatedData);
        $role->syncPermissions($request['permissions']);
        alert()->success('عملیات موفق', 'بروزرسانی با موفقیت انجام شد');
        return redirect(route('role.index'));
    }
    
    public function destroy(Role $role)
    {
        $role->delete();
        toast('آیتم مورد نظر با موفقیت حذف شد', 'success')->timerProgressBar();
        return back();
    }
}
