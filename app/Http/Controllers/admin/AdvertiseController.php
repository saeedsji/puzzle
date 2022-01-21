<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public function index()
    {
        $advertises = Advertise::filter()->latest()->paginate(20);
        $count = Advertise::filter()->count();
        return view('admin.advertise.index', compact('advertises', 'count'));
    }
    
    public function create()
    {
        $cities = City::sort()->get();
        $categories = Category::root()->sort()->get();
        return view('admin.advertise.create',compact('cities','categories'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'region_id' => 'required',
            'title' => 'required|min:5|max:220',
            'status' => 'required',
            'type' => 'required',
            'view' => 'nullable|numeric|min:0',
            'phone' => 'nullable',
            'whatsapp' => 'nullable',
            'description' => 'nullable|min:5',
        ]);
        $validatedData['expire'] = Carbon::now()->addDays(30);
        $advertise = Advertise::create($validatedData);
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
    
    
    public function getRegionByCity(Request $request)
    {
        $city_id = $request['city_id'];
        $regions = Region::where('city_id', $city_id)->get();
        $output = '';
        foreach ($regions as $region)
        {
            $output .= '<option value="' . $region->id . '" >' . $region->name . '</option>';
        }
        return $output;
    }
    
}
