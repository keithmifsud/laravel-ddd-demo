<?php

namespace KeithMifsud\Demo\Application\Http\Requests\Membership;

use Illuminate\Foundation\Http\FormRequest;

/**
 * An http request for registering a new member.
 *
 */
class RegisterMember extends FormRequest
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
            'first_name' => 'required|min:3',
            'last_name'  => 'required|min:3',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|confirmed|min:6'
        ];
    }
}
