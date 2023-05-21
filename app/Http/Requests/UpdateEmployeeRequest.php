<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dateOfBirth' => Employee::VALIDATION_RULE_DATE_OF_BIRTH,
            'jobTitle' => Employee::VALIDATION_RULE_JOB_TITLE,
            'salary' => Employee::VALIDATION_RULE_SALARY,
            'Iban' => Employee::VALIDATION_RULE_IBAN,
            'email' => Employee::VALIDATION_RULE_EMAIL,
        ];
    }
}
