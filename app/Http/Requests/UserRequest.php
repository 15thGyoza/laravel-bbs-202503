<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRequest
 *
 * Handles validation for user profile updates.
 *
 * @property $avatar
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|between:3,25|regex:/^[\x{4e00}-\x{9fff}\x{3400}-\x{4dbf}\x{3040}-\x{309f}\x{30a0}-\x{30ff}\x{31f0}-\x{31ff}\x{3005}a-zA-Z0-9_-]+$/u|unique:users,name,' . auth()->user()->id,
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'introduction' => 'max:80',
            'avatar' => 'mimes:png,jpg,gif,jpeg|dimensions:min_width=208,min_height=208',
        ];
    }
}
