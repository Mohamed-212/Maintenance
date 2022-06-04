<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'name' => "required",
            'company' => "required",
            'position' => "required",
            'vendor_code' => "required",
            'landline' => "required|size:10|regex:/(02)[0-9]{8}/|unique:customers",
            'fax' => "required|size:10|regex:/(02)[0-9]{8}/|unique:customers",
            'email' => ['nullable', 'email', 'unique:customers'],
            'city_id' => "nullable|exists:cities,id",
            'area_id' => "nullable|exists:areas,id",

        ];
    }
}
