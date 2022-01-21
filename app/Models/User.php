<?php

namespace App\Models;

use App\Enums\UserType;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Zoha\Metable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Metable, HasRoles;
    
    protected $fillable = [
        'phone',
        'name',
        'email',
        'password',
        'type',
        'status',
        'ip',
        'lastLogin',
    ];
    
    
    protected $hidden = [
        'password',
    ];
    
    public function scopeFilter($query)
    {
        $name = request('name');
        $phone = request('phone');
        $email = request('email');
        $type = request('type');
        $status = request('status');
        $from = request('from');
        $to = request('to');
        
        
        if (isset($name) && trim($name) != '')
        {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        
        if (isset($phone) && trim($phone) != '')
        {
            $query->where('phone', 'LIKE', '%' . $phone . '%');
        }
        
        if (isset($email) && trim($email) != '')
        {
            $query->where('email', 'LIKE', '%' . $email . '%');
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
    
    public function isAdmin()
    {
        return $this->type == UserType::admin ? true : false;
    }
    
}
