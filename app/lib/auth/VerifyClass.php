<?php

namespace App\lib\auth;


use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use App\Models\Verify;
use Carbon\Carbon;

class VerifyClass
{
    public function attemp($phone, $code)
    {
        $verifyValidation = $this->verifyValidation($phone, $code);
        if ($verifyValidation['success'])
        {
            $user = $this->upsertUser($phone);
            $token = $user->createToken($user->phone);
            $loginClass = new LoginClass();
            $code = rand(1111, 9999);
            $loginClass->upsertVerifyCode($phone, $code);
            return [
                'success' => true,
                'message' => 'ورود و تایید با موفقیت انجام شد',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token->plainTextToken
                ]
            ];
        }
        else
        {
            return $verifyValidation;
        }
    }
    
    public function verifyValidation($phone, $code)
    {
        if (!$this->checkVerifyCode($phone, $code))
            return ['success' => false, 'message' => 'کد یکبار مصرف اشتباه است'];
        
        if (!$this->checkUserStatus($phone))
            return ['success' => false, 'message' => 'حساب کاربری شما غیر فعال است لطفا با پشتیبانی تماس بگیرید'];
        
        return ['success' => true, 'message' => 'کاربر مجاز به ورود و ثبت نام است'];
    }
    
    public function checkVerifyCode($phone, $code)
    {
        $verify = Verify::where('phone', $phone)->first();
        return decrypt($verify->code) == $code ? true : false;
    }
    
    public function checkUserStatus($phone)
    {
        $user = User::where('phone', $phone)->first();
        if (!empty($user))
        {
            return $user->status == UserStatus::active ? true : false;
        }
        else
        {
            return true;
        }
    }
    
    public function upsertUser($phone)
    {
        return User::updateOrCreate(
            ['phone' => $phone, 'type' => UserType::normal, 'status' => UserStatus::active,],
            ['ip' => request()->ip(), 'lastLogin' => Carbon::now()]
        );
    }
}
