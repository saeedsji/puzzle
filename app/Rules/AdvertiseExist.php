<?php

namespace App\Rules;

use App\Models\Advertise;
use Illuminate\Contracts\Validation\Rule;

class AdvertiseExist implements Rule
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
        $advertise = Advertise::find($value);
        return !empty($advertise);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'آگهی وجود ندارد';
    }
}
