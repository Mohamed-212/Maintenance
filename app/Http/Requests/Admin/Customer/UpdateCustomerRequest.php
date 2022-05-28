<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'company' => "required",
            'position' => "required",
            'vendor_code' => "required",
            'landline' => ['required', 'size:10', 'regex:/(02)[0-9]{8}/',  Rule::unique('customers')->ignore($this->route('customer'))],
            'fax' => ['required', 'size:10', 'regex:/(02)[0-9]{8}/',  Rule::unique('customers')->ignore($this->route('customer'))],
            'email' => ['nullable', 'email', Rule::unique('customers')->ignore($this->route('customer'))],
            'city_id' => "nullable|exists:cities,id",
            'area_id' => "nullable|exists:areas,id",
        ];
    }
}
