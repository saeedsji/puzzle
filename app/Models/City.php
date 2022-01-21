<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name','sort'];
    public function scopeSort($q)
    {
        return $q->orderBy('sort');
    }
}
