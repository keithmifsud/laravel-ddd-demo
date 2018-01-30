<?php

namespace KeithMifsud\Demo\Application\Http\Requests\Membership;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Http request for updating a member's profile.
 */
class UpdateProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Members can only update their own profiles.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::user()->user_identifier ==
            $this->request->get('user_identifier')
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->rules;

        if (($this->request->has('international_dialling_code')) ||
            ($this->request->has('domestic_phone_number'))
        ) {
            $rules['international_dialling_code'] = 'required|numeric';
        }

        if (($this->request->has('street_address')) ||
            ($this->request->has('city')) ||
            ($this->request->has('region')) ||
            ($this->request->has('country_code'))
        ) {
            $rules['street_address'] = 'required|min:8';
            $rules['city'] = 'required|min:4';
            $rules['region'] = 'required|mi:4';
            $rules['country_code'] = 'required|min:3';
        }

        return $rules;
    }
}
