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
        $rules = [];

        if ($this->filled('domestic_phone_number')
        ) {
            $rules['international_dialling_code'] = 'required|numeric';
            $rules['domestic_phone_number'] = 'required|numeric';
        }

        if (($this->filled('street_address')) ||
            ($this->filled('city')) ||
            ($this->filled('region'))
        ) {
            $rules['street_address'] = 'required|min:8';
            $rules['city'] = 'required|min:4';
            $rules['region'] = 'required|mi:4';
            $rules['country_code'] = 'required|min:3';
        }

        return $rules;
    }
}
