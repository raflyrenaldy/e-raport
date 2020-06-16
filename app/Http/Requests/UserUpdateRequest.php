<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Model\User;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'nullable|min:5|confirmed'
        ];

//        $rules['role'] = 'required';
//
//        //jika roles = marketing, manager dibutuhkan
//        if($this->role == User::MARKETING)
//        {
//               $rules['manager'] = 'required';
//        }

        return $rules;
    }
}
