<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\api\BaseController;
use App\Http\Resources\v1\SliderCollection;
use App\Models\Slider;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function sliders()
    {
        $sliders = Slider::filter()->sort()->get();
        return $this->sendSucess('بازگشت موفق اسلایدر ها', new SliderCollection($sliders));
    }
    
    public function general()
    {
        $data = [
            'phone1' => option('phone1'),
            'phone2' => option('phone2'),
            'whatsapp' => option('whatsapp'),
            'telegram' => option('telegram'),
            'email' => option('email'),
            'aboutus' => option('aboutus'),
        ];
        return $this->sendSucess('', $data);
    }
    
    public function patchNote()
    {
        return $this->sendSucess('', option('patchNote'));
    }
    
    public function rules()
    {
        return $this->sendSucess('', option('rules'));
    }
    
    public function privacy()
    {
        return $this->sendSucess('', option('privacy'));
    }
    
    public function warning()
    {
        return $this->sendSucess('', option('warning'));
    }
}
