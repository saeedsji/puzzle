<?php

namespace App\Models;

use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable = ['name', 'sort', 'parent_id', 'status', 'image'];
    
    public function scopeFilter($query)
    {
        $name = request('name');
        $status = request('status');
        $parent_id = !empty(request('parent_id')) ? request('parent_id') : 0;
        
        
        if (isset($name) && trim($name) != '')
        {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        
        if (isset($status) && trim($status) != '')
        {
            $query->where('status', $status);
        }
        if (isset($parent_id) && trim($parent_id) != '')
        {
            $query->where('parent_id', $parent_id);
        }
        
        return $query;
    }
    
    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('sort');
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    
    public function scopeActive($q)
    {
        return $q->where('status', CategoryStatus::active);
    }
    
    
    public function scopeSort($q)
    {
        return $q->orderBy('sort');
    }
    
    public function scopeRoot($q)
    {
        return $q->where('parent_id', 0);
    }
    
    
}
