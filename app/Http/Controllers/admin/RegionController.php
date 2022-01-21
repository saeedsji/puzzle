<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::sort()->paginate(20);
        $count = Region::all()->count();
        return view('admin.region.index', compact('regions', 'count'));
    }
    
    public function create()
    {
        $cities = City::sort()->get();
        return view('admin.region.create',compact('cities'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:cities',
            'sort' => 'required|numeric',
            'city_id' => 'required',
        ]);
        Region::create($validatedData);
        alert()->success('عملیات موفق', 'مورد جدید با موفقیت ثبت شد');
        return redirect(route('region.index'));
    }
    
    public function edit(Region $region)
    {
        $cities = City::sort()->get();
        return view('admin.region.edit', compact('region','cities'));
    }
    
    public function update(Request $request, Region $region)
    {
        
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('cities', 'name')->ignore($region->name, 'name')],
            'sort' => 'required|numeric',
        ]);
        $region->update($validatedData);
        alert()->success('عملیات موفق', 'بروزرسانی با موفقیت انجام شد');
        return redirect(route('region.index'));
    }
    
    public function destroy(Region $region)
    {
        $region->delete();
        toast('آیتم مورد نظر با موفقیت حذف شد', 'success')->timerProgressBar();
        return back();
    }
}
