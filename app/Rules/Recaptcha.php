<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{
    /**
     * @var \ReCaptcha\ReCaptcha
     */
    private $recaptcha;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->recaptcha = new \ReCaptcha\ReCaptcha(
            config('services.recaptcha.secret')
        );
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
        if (app()->runningUnitTests()) {
            return true;
        }

        $resp = $this->recaptcha->verify($value);

        return $resp->isSuccess();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.recaptcha');
    }
}
