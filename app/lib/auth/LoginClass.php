<?php

namespace App\lib\auth;


use App\Enums\UserStatus;
use App\Models\User;
use App\Models\Verify;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginClass extends OtpClass
{
    public function attemp($phone)
    {
        $code = rand(1111, 9999);
        $this->upsertVerifyCode($phone, $code);
        $sendOtpSms = $this->sendOtpSms($phone, $code);
        return $sendOtpSms ? [
            'success' => true,
            'message' => 'کد یکبار مصرف با موفقیت ارسال شد',
            'data' => ['isNewUser' => $this->isNewUser($phone)]]
            : [
                'success' => false,
                'message' => 'مشکلی در ارسال پیامک به وجود آمد لطفا مجددا تلاش کنید',
                'code' => Response::HTTP_SERVICE_UNAVAILABLE,
            ];
    }
    
    public function upsertVerifyCode($phone, $code)
    {
        Verify::updateOrCreate(
            ['phone' => $phone],
            ['code' => encrypt($code)]
        );
    }
    
    public function isNewUser($phone)
    {
        $user = User::where('phone', $phone)->first();
        return !empty($user->id) ? false : true;
    }
    
    public function passwordLogin($phone, $password)
    {
        $user = User::where('phone', $phone)->first();
        return $this->passwordLoginValidation($user, $password);
        
    }
    
    public function passwordLoginValidation($user, $password)
    {
        if (empty($user->password))
            return ['success' => false, 'message' => 'حساب کاربری شما امکان ورود با رمر عبور را ندارد'];
        
        if ($user->status != UserStatus::active)
            return ['success' => false, 'message' => 'حساب کاربری شما غیر فعال است لطفا با پشتیبانی تماس بگیرید'];
        
        if (Hash::check($password, $user->password))
        {
            return ['success' => true, 'message' => 'ورود موفق', 'user_id' => $user->id];
        }
        else
        {
            return ['success' => false, 'message' => 'اطلاعات ورود صحیح نیست'];
        }
    }
    
}
