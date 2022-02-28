<?php

namespace App\Http\Requests\Admin\PurchaseOrder;

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
            'supplier_id' => "required|exists:suppliers,id",
            'inventory_id' => "required|exists:inventories,id",
            'expected_on' => "required",
            'paid' => "required",
            'cost.0' => "required",
            'item_id.0' => "required",
            'quantity.0' => "required",
            'payment_type' => "required",
        ];
    }
}
