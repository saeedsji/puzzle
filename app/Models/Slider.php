<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'type',
        'sort',
        'position',
        'status',
        'image',
        'screen',
        'course_id',
        'link',
    ];
    public function scopeFilter($query)
    {
        $status = request('status');
        $type = request('type');
        $position= request('position');
        
        if (isset($title) && trim($title) != '') {
            $query->where('title', 'LIKE', '%' . trim($title) . '%');
        }
        
        
        if (isset($position) && trim($position) != '') {
            $query->where('position', $position);
        }
        
        if (isset($status) && trim($status) != '') {
            $query->where('status', $status);
        }
        
        
        if (isset($type) && trim($type) != '') {
            $query->where('type', $type);
        }
        
        return $query;
    }
    public function scopeSort($q)
    {
        return $q->orderBy('sort');
    }
}
