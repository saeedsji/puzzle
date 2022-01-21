<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['city_id','name','sort'];
    
    public function scopeSort($q)
    {
        return $q->orderBy('sort');
    }
    
    public function city()
    {
        return $this->belongsTo(City::class)->withDefault([
            'name' => 'حذف شده',
        ]);
    }
}
