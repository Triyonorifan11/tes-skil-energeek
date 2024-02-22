<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorecandidatesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return Auth::check(); //for authorize by session on token
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'job_id' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:candidates,email|string',
            'year' => 'required|string',
            'skill' => 'required|array',
            'skill.*' => 'exists:skill_sets,id',
        ];
    }
}
