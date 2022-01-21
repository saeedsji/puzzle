<?php

namespace App\Models;

use App\Enums\AdvertiseStatus;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;

class Advertise extends Model
{
    use Metable;
    use Sluggable;
    
    protected $fillable = ['user_id', 'region_id', 'category_id', 'title', 'status', 'type', 'slug', 'view', 'expire', 'phone', 'whatsapp', 'description'];
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'حذف شده',
            'phone' => 'حذف شده',
        ]);
    }
    
    public function scopeFilter($query)
    {
        $title = request('title');
        $type = request('type');
        $status = request('status');
        $from = request('from');
        $to = request('to');
        
        
        if (isset($title) && trim($title) != '')
        {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
        if (isset($type) && trim($type) != '')
        {
            $query->where('type', $type);
        }
        
        if (isset($status) && trim($status) != '')
        {
            $query->where('status', $status);
        }
        
        if (isset($from) && trim($from) != '')
        {
            $from = convertToEnDate($from);
            $query->whereDate('created_at', '>=', $from);
        }
        
        if (isset($to) && trim($to) != '')
        {
            $to = convertToEnDate($to);
            $query->whereDate('created_at', '<=', $to);
        }
        if (isset($platform) && trim($platform) != '')
        {
            $query->whereMeta('regitserPlatform', $platform);
        }
        
        
        return $query;
    }
    
    public function imageUrl()
    {
        $image = Image::where('advertise_id', $this->id)->where('main', true)->first();
        return !empty($image->url) ? $image->url : 'no image url';
    }
    
    public function scopePublished($q)
    {
        return $q->where('status', AdvertiseStatus::published);
    }
    
    public function scopeNotExpire($q)
    {
        return $q->where('expire', '>', Carbon::now()->timestamp);
    }
    
    public function images()
    {
        return $this->hasMany(Image::class,'advertise_id');
    }
    
    
}
