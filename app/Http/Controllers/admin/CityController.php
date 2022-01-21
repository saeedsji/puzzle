<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::sort()->paginate(20);
        $count = City::all()->count();
        return view('admin.city.index', compact('cities','count'));
    }
    public function create()
    {
        return view('admin.city.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:cities',
            'sort' => 'required|numeric',
        ]);
        City::create($validatedData);
        alert()->success('عملیات موفق', 'مورد جدید با موفقیت ثبت شد');
        return redirect(route('city.index'));
    }
    
    public function edit(City $city)
    {
        return view('admin.city.edit', compact('city'));
    }
    
    public function update(Request $request, City $city )
    {
        
        $validatedData = $request->validate([
            'name' => ['required',Rule::unique('cities', 'name')->ignore($city->name, 'name')],
            'sort' => 'required|numeric',
        ]);
        $city->update($validatedData);
        alert()->success('عملیات موفق', 'بروزرسانی با موفقیت انجام شد');
        return redirect(route('city.index'));
    }
    
    public function destroy(City $city)
    {
        $city->delete();
        toast('آیتم مورد نظر با موفقیت حذف شد','success')->timerProgressBar();
        return back();
    }
}
