<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;    // ← allow everyone to submit
    }

    public function rules(): array
    {
        return [
            'name'    => ['required','string','max:255'],
            'email'   => ['required','email','max:255'],
            'subject' => ['required','string','max:255'],
            'message' => ['required','string','min:10'],
        ];
    }
}
