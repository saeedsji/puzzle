<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::filter()->latest()->paginate(20);
        $count = User::filter()->count();
        return view('admin.user.index', compact('users','count'));
    }
    
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric|unique:users',
            'name' => 'nullable|min:3',
            'email' => 'nullable|email|unique:users',
            'type' => 'required',
            'status' => 'required',
            'password' => 'nullable|min:6',
            'confirmPassword' => 'required_with:password|same:password',
        ]);
        $validatedData['password'] = $this->getPassword($validatedData['password']);
        $user = User::create($validatedData);
        $this->updateUserRole($user, $request['role']);
        alert()->success('عملیات موفق', 'مورد جدید با موفقیت ثبت شد');
        return redirect(route('user.index'));
    }
    
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }
    
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|min:3',
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($user->email, 'email')],
            'type' => 'required',
            'status' => 'required',
        ]);
        $user->update($validatedData);
        $this->updateUserRole($user, $request['role']);
        alert()->success('عملیات موفق', 'بروزرسانی با موفقیت انجام شد');
        return redirect(route('user.index'));
    }
    
    public function resetPassword(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6',
            'confirmPassword' => 'required_with:password|same:password',
        ]);
        $validatedData['password'] = $this->getPassword($validatedData['password']);
        $user->update($validatedData);
        alert()->success('عملیات موفق', 'رمز عبور با موفقیت تغییر کرد');
        return back();
    }
    
    public function getPassword($password)
    {
        return !empty($password) ? Hash::make($password) : null;
    }
    
    public function updateUserRole($user, $role)
    {
        if (!empty($role))
            $user->syncRoles($role);
    }
    
}
