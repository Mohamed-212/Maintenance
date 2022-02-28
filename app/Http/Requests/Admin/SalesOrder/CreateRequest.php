<?php

namespace App\Http\Requests\Admin\SalesOrder;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'customer_id' => "required_without:name|exists:customers,id",
            'item_id.0' => "required",
            'price' => "required",
            'paid' => "required",
            'payment_type' => "required",
            'expected_on' => "required",
        ];
    }
}
