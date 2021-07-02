<?php

namespace App\Rules;

use App\Models\Station;
use Illuminate\Contracts\Validation\Rule;

class CheckStation implements Rule
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
    public $d;
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
       // $data=Station::get('sname');
       
        $data=session()->get('stationsname');
        $d=$value;
       // return gettype($data);
        return in_array($value,$data);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ('The'. $this->d .' Station Name is Incorrect');
    }
}
