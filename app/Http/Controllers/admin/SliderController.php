<?php

namespace App\Http\Controllers\admin;

use App\Enums\SliderType;
use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::filter()->sort()->paginate(20);
        $count = Slider::filter()->count();
    
        return view('admin.slider.index', compact('sliders','count'));
    }
    
    public function create()
    {
        $advertises = Advertise::latest()->get();
        return view('admin.slider.create', compact('advertises'));
    }
    
    public function store(Request $request)
    {
        
        $advertiseIdValidation = $request['type'] == SliderType::advertise ? 'required' : 'nullable';
        $linktValidation = $request['type'] == SliderType::link ? 'required' : 'nullable';
        $screenValidation = $request['type'] == SliderType::screen ? 'required' : 'nullable';
        $validatedData = $request->validate([
            'title' => 'required',
            'sort' => 'required',
            'image' => 'required',
            'status' => 'required',
            'position' => 'required',
            'type' => 'required',
            'advertise_id' => $advertiseIdValidation,
            'link' => $linktValidation,
            'screen' => $screenValidation,
            'description'=>'nullable|max:220',
        ]);
        $slider = Slider::create($validatedData);
        alert()->success('عملیات موفق', 'مورد جدید با موفقیت ثبت شد');
        return redirect(route('slider.index'));
        
    }
    
    public function edit(Slider $slider)
    {
        $advertises = Advertise::latest()->get();
        return view('admin.slider.edit', compact('slider', 'advertises'));
    }
    
    public function update(Request $request, Slider $slider)
    {
        $advertiseIdValidation = $request['type'] == SliderType::advertise ? 'required' : 'nullable';
        $linktValidation = $request['type'] == SliderType::link ? 'required' : 'nullable';
        $screenValidation = $request['type'] == SliderType::screen ? 'required' : 'nullable';
        $validatedData = $request->validate([
            'title' => 'required',
            'sort' => 'required',
            'image' => 'required',
            'status' => 'required',
            'position' => 'required',
            'type' => 'required',
            'advertise_id' => $advertiseIdValidation,
            'link' => $linktValidation,
            'screen' => $screenValidation,
            'description'=>'nullable|max:220',

        ]);
        
        $validatedData['advertise_id'] = $validatedData['type'] == SliderType::advertise ? $validatedData['advertise_id'] : null;
        $validatedData['screen'] = $validatedData['type'] == SliderType::screen ? $validatedData['screen'] : null;
        $validatedData['link'] = $validatedData['type'] == SliderType::link ? $validatedData['link'] : null;
        $slider->update($validatedData);
    
        alert()->success('عملیات موفق', 'به روز رسانی با موفقیت انجام شد');
        return redirect(route('slider.index'));
    }
    
    
    public function destroy(Slider $slider)
    {
        $slider->delete();
        alert()->success('عملیات موفق', 'آیتم مورد نظر با موفقیت حذف شد');
        return back();
    }
}
