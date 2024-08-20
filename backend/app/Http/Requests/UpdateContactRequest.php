<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Set this to true if the user is authorized to make this request.
        return true;
    }

    public function rules(): array
    {
        $contactId = $this->route('contact')->id;

        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:10',
                Rule::unique('contacts')->ignore($contactId)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone field is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.max' => 'The phone number cannot exceed 10 characters.',
        ];
    }
}