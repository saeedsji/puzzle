<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\api\BaseController;
use App\Http\Resources\v1\UserResource;
use App\lib\auth\LoginClass;
use App\lib\auth\VerifyClass;
use App\Models\User;
use App\Rules\PhoneExist;
use App\Rules\VerifyExist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/(09)[0-9]{9}/', 'numeric', 'digits:11'],
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        $loginCLass = new LoginClass();
        $res = $loginCLass->attemp($request['phone']);
        return $this->sendResponse($res);
    }
    
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/(09)[0-9]{9}/', 'numeric', 'digits:11', new VerifyExist()],
            'code' => ['required', 'numeric', 'digits:4'],
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        
        $verifyCLass = new VerifyClass();
        $res = $verifyCLass->attemp($request['phone'], $request['code']);
        
        return $this->sendResponse($res);
    }
    
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->sendSucess('خروج با موفقیت انجام شد');
        
    }
    
    public function passwordLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric', new PhoneExist()],
            'password' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this->sendError($validator->errors()->first());
        }
        $loginClass = new LoginClass();
        $passwordLogin = $loginClass->passwordLogin($request['phone'], $request['password']);
        if ($passwordLogin['success'])
        {
            $user = User::find($passwordLogin['user_id']);
            $token = $user->createToken($user->phone);
            return $this->sendSucess($passwordLogin['message'], [
                'user' => new UserResource($user),
                'token' => $token->plainTextToken
            ]);
        }
        else
        {
            return $this->sendError($passwordLogin['message']);
        }
    }
    
}
