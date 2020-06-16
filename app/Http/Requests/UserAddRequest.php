<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Model\User;

class UserAddRequest extends FormRequest
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
            'name'      => 'required|min:3|max:255',
            'email'     => 'required|email|unique:users',
            'role'      => 'required',
            'password'  => 'required|min:5|confirmed',
            'avatar'    => 'required'
        ];

        /*//jika roles = marketing, manager dibutuhkan
        if($this->role == User::MARKETING)
        {
               $rules['manager'] = 'required';
        }*/

        return $rules;
    }

}
