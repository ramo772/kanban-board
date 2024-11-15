<?php

namespace App\Http\Requests\WebService\Api\MemberCard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusMemberCardRequest extends FormRequest
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
            'order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:Un Claimed,First Contact,Preparing Work Offer,Send To Therapist'],
        ];
    }
}
