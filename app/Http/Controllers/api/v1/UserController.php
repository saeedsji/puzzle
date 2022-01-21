<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\api\BaseController;
use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends BaseController
{
    
    public function user()
    {
        return $this->sendSucess('', new UserResource(auth()->user()));
    }
    
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->sendSucess('خروج با موفقیت انجام شد');
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => ['email', Rule::unique('users')->ignore(auth()->user()->id)],
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        
        auth()->user()->update([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);
        
        return $this->sendSucess('بروزرسانی با موفقیت انجام شد', [
            'user' => new UserResource(auth()->user())
        ]);
        
    }
    
    public function setPassword(Request $request)
    {
        $user = auth()->user();
        $hasPassword = !empty($user->password) ? true : false;
        $currentPasswordValidation = $hasPassword ? 'required' : 'nullable';
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:4|max:16',
            'confirm' => 'required|required_with:password|same:password',
            'currentPassword' => $currentPasswordValidation
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        if ($hasPassword)
        {
            if (!Hash::check($request['currentPassword'], $user->password))
            {
                return $this->sendError('رمز عبور فعلی صحیح نیست');
            }
            if ($request['password'] == $request['currentPassword'])
            {
                return $this->sendError('رمز عبور جدید با رمز عبور فعلی یکسان است');
            }
        }
        $user->update([
            'password' => Hash::make($request['password'])
        ]);
        $message = $hasPassword ? 'رمز عبور با موفقیت بروزرسانی شد' : 'رمز عبور با موفقیت ثبت شد';
        return $this->sendSucess($message);
    }
    
}
