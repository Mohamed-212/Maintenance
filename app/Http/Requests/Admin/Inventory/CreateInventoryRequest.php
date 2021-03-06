<?php

namespace App\Http\Requests\Admin\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class CreateInventoryRequest extends FormRequest
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
            'tel_no' => "required|size:10|regex:/0[0-9]{9}/|unique:inventories",
            'address' => "required",
            'emp_id' => "required|exists:employees,id",
            'name'=>"required",
        ];
    }
}
