<?php

namespace App\Rules;

use App\Models\Verify;
use Illuminate\Contracts\Validation\Rule;

class VerifyExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $verify = Verify::where('phone',$value)->first();
        return !empty($verify);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'کد یکبارمصرف برای شماره وارد شده وجود ندارد ';
    }
}
