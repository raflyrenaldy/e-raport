<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class MarketingAddAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'customer'  => 'required|numeric',
            'date'      => 'required|date_format:Y-m-d',
            'time'      => 'required|date_format:H:i:s',
            'location'  => 'required',
            'address'   => 'required'
        ];

        return $rules;
    }

}
