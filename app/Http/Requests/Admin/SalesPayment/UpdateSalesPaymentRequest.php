<?php

namespace App\Http\Requests\Admin\SalesPayment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalesPaymentRequest extends FormRequest
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
            'paid' => "required",
            'so_id' => "required|exists:sales_orders,id",
            'payment_type' => "required",
        ];
    }
}
