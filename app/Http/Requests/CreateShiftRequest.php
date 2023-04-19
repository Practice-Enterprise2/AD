<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShiftRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'planned_start_time' => 'required|date_format:Y-m-d H:i:s',
            'planned_end_time' => 'required|date_format:Y-m-d H:i:s',
            'actual_start_time' => 'nullable|date_format:Y-m-d H:i:s',
            'actual_end_time' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }

    
}
