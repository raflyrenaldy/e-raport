<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Model\Appointment;

class MarketingUpdAppointmentRequest extends FormRequest
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
            'status'            => 'required|numeric',
            'description'       => 'required',
        ];

        if($this->status == Appointment::FIXED_NASABAH || $this->status == Appointment::ACTIVE_NASABAH) {
            $rules['margin']        = 'required';
            $rules['ktp']           = 'required';
            $rules['npwp']          = 'required';
            $rules['address']       = 'required';
            $rules['profession']    = 'required';
            $rules['no_rek']        = 'required';
        }

        return $rules;
    }

}
