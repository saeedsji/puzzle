<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public  function  general()
    {
        return view('admin.setting.general');
    }
    public  function  generalStore(Request $request)
    {
        option([
            'phone1' => !empty($request['phone1']) ? $request['phone1'] : '',
            'phone2' => !empty($request['phone2']) ? $request['phone2'] : '',
            'whatsapp' => !empty($request['whatsapp']) ? $request['whatsapp'] : '',
            'instagram' => !empty($request['instagram']) ? $request['instagram'] : '',
            'telegram' => !empty($request['telegram']) ? $request['telegram'] : '',
            'email' => !empty($request['email']) ? $request['email'] : '',
            'aboutus' => !empty($request['aboutus']) ? $request['aboutus'] : '',
            'warning' => !empty($request['warning']) ? $request['warning'] : '',
            'rules' => !empty($request['rules']) ? $request['rules'] : '',
            'privacy' => !empty($request['privacy']) ? $request['privacy'] : '',
            'patchNote' => !empty($request['patchNote']) ? $request['patchNote'] : '',
        ]);
    
        toast('به روز رسانی اطلاعت با موفقیت انجام شد', 'success')->timerProgressBar();
        return back();
    }
}
