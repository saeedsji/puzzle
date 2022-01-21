<?php

namespace App\Rules;

use App\Models\Region;
use Illuminate\Contracts\Validation\Rule;

class RegionExist implements Rule
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
        $region = Region::find($value);
        return !empty($region);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'منظقه وارد شده وجود ندارد';
    }
}
