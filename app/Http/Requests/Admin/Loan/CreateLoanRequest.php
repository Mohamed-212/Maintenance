<?php

namespace App\Http\Requests\Admin\Loan;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payments' => "required",
            'total' => "required|numeric|min:1.00",
            'loan_date' => 'required',
            'start_date' => 'required',
            'emp_id' => "required|exists:employees,id",
        ];
    }
}
