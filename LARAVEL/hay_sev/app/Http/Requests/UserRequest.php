<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'password'=>'required|string',
        ];
        if (filled(request()->route('id'))) {
            $rules['email'] = 'required|unique:user,email,' . request()->route('id') . ',id,deleted_at,NULL';
        } else { 
            $rules['email'] = 'required|unique:user,email,NULL,id,deleted_at,NULL';
        }
        return $rules;
    }
}
