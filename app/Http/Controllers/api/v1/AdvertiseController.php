<?php

namespace App\Http\Controllers\api\v1;

use App\Enums\AdvertiseStatus;
use App\Enums\AdvertiseType;
use App\Http\Controllers\api\BaseController;
use App\Http\Resources\v1\AdvertiseCollection;
use App\Http\Resources\v1\AdvertiseResource;
use App\Http\Resources\v1\CategoryCollection;
use App\Http\Resources\v1\CityCollection;
use App\Http\Resources\v1\RegionCollection;
use App\Models\Advertise;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\City;
use App\Models\Image;
use App\Models\Lastseen;
use App\Models\Region;
use App\Rules\AdvertiseExist;
use App\Rules\CategoryExist;
use App\Rules\RegionExist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdvertiseController extends BaseController
{
    public function advertises(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perpage' => ['required'],
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        
        $advertises = Advertise::published()->notExpire()->filter()->latest()->paginate($request['perpage']);
        return $this->sendSucess('', new AdvertiseCollection($advertises));
    }
    
    public function advertise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'advertise_id' => ['required', new AdvertiseExist()],
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        $user_id = auth()->guard('sanctum')->id();
        if (!empty($user_id))
            $this->addLasteen($user_id, $request['advertise_id']);
        
        $advertise = Advertise::find($request['advertise_id']);
        return $this->sendSucess('', new AdvertiseResource($advertise));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => ['required', new CategoryExist()],
            'title' => ['required'],
            'region_id' => ['required', new RegionExist()],
            'phone' => ['required'],
            'whatsapp' => ['nullable'],
            'description' => ['nullable', 'min:10'],
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        
        $request['user_id'] = auth()->id();
        $request['status'] = AdvertiseStatus::published;
        $request['type'] = AdvertiseType::normal;
        $request['expire'] = Carbon::now()->addDays(30);
        $advertise = Advertise::create($request->all());
        $categories = json_decode($request['categories']);
        $advertise->categories()->sync($categories);
        if ($request->hasFile('images'))
        {
            $images = $request->file('images');
            $this->uploadImages($images, $advertise);
        }
        return $this->sendSucess('آگهی با موفقیت ثبت شد');
        
    }
    
    public function categories()
    {
        $categories = Category::root()->active()->sort()->get();
        return $this->sendSucess('بازگشت موفق دسته بندی ها', new CategoryCollection($categories));
    }
    
    public function cities()
    {
        $cities = City::sort()->get();
        return $this->sendSucess('بازگشت موفق شهر ها', new CityCollection($cities));
    }
    
    public function regions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => ['required'],
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        $regions = Region::where('city_id', $request['city_id'])->sort()->get();
        return $this->sendSucess('بازگشت موفق منطقه ها', new RegionCollection($regions));
    }
    
    public function uploadImages($images, $advertise)
    {
        $main = true;
        foreach ($images as $image)
        {
            $filename = $image->getClientOriginalName();
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            $path = $image->storeAs('advertise/' . $year . '/' . $month . '/' . $advertise->id, $filename);
            Image::create([
                'advertise_id' => $advertise->id,
                'url' => Storage::url($path),
                'dir' => $path,
                'main' => $main,
            ]);
            $main = false;
        }
    }
    
    public function bookmark(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'advertise_id' => ['required', new AdvertiseExist()],
        ]);
        if ($validator->fails())
        {
            return response([
                'message' => $validator->errors()->first(),
                'success' => false
            ]);
        }
        $check = Bookmark::where('user_id', auth()->id())->where('advertise_id', $request['advertise_id'])->first();
        if (!empty($check))
        {
            $check->delete();
            return $this->sendSucess('آگهی از نشان شده ها حذف شد');
        }
        else
        {
            Bookmark::create(['user_id' => auth()->id(), 'advertise_id' => $request['advertise_id']]);
            return $this->sendSucess('آگهی به نشان شده هااضافه شد');
        }
    }
    
    public function bookmarks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perpage' => 'required'
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        $bookmarks = Bookmark::where('user_id', auth()->id())->latest()->pluck('advertise_id');
        $bookmarks_ordered = implode(',', $bookmarks->toArray());
        $advertises = Advertise::whereIn('id', $bookmarks)
            ->published()->notExpire()->filter()
            ->orderByRaw("FIELD(id, $bookmarks_ordered)")
            ->paginate($request['perpage']);
        return $this->sendSucess('', new AdvertiseCollection($advertises));
        
    }
    
    public function lastseens(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perpage' => 'required'
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        $lastseens = Lastseen::where('user_id', auth()->id())->latest()->get()->pluck('advertise_id');
        $lastseen_ordered = implode(',', $lastseens->toArray());
        $advertises = Advertise::whereIn('id', $lastseens)->published()->notExpire()->filter()->orderByRaw("FIELD(id, $lastseen_ordered)")->paginate($request['perpage']);
        return $this->sendSucess('', new AdvertiseCollection($advertises));
    }
    
    public function addLasteen($user_id, $advertise_id)
    {
        try
        {
            $last_seen = Lastseen::where('user_id', $user_id)->where('advertise_id', $advertise_id)->first();
            if (!empty($last_seen->id))
                $last_seen->delete();
            
            LastSeen::create([
                'user_id' => $user_id,
                'advertise_id' => $advertise_id
            ]);
        }
        catch (\Exception $e)
        {
        
        }
        
    }
    
    
}
