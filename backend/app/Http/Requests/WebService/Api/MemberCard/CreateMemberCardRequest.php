<?php

namespace App\Http\Requests\WebService\Api\MemberCard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMemberCardRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('member_cards')->where(function ($query) {
                    return $query->where('status', 'un_claimed');
                }),
            ],
            'mobile_number' => ['required', 'regex:/^(\+20|0)?1[0125][0-9]{8}$/'],
        ];
    }
}
