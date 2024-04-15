<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login_identifier' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCredentials()
    {
        // The form field for providing email/phone or password
        // has name of "login_identifier", however, in order to support
        // logging users in with both (email and phone)
        // we have to check if the user has entered one or another
        $loginIdentifier = $this->get('login_identifier');
        if ($this->isEmail($loginIdentifier)) {
            return [
                'email' => $loginIdentifier,
                'password' => $this->get('password')
            ];
        } elseif ($this->isPhoneNumber($loginIdentifier)) {
            return [
                'phone' => $loginIdentifier,
                'password' => $this->get('password')
            ];
        }

        return $this->only('login_identifier', 'password');
    }

    /**
     * Validate if the provided parameter is a valid email.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isEmail($param)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return !$factory->make(
            ['login_identifier' => $param],
            ['login_identifier' => 'email']
        )->fails();
    }

    /**
     * Validate if the provided parameter is a valid phone number.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isPhoneNumber($param)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return !$factory->make(
            ['login_identifier' => $param],
            ['login_identifier' => 'numeric'] // You might need a more specific rule for phone numbers
        )->fails();
    }
}
