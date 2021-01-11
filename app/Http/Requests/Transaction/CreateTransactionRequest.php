<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateTransactionRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $this->merge([
            'note' => Str::upper(Str::random(5)),
            'discount' => $this->discount ?? 0,
            'tax' => $this->tax ?? 0,
        ]);
    }

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
            'weight' => 'required|integer|min:1',
            'finish' => 'required|date|after:today',
            'discount' => 'integer|min:0|nullable',
            'tax' => 'integer|min:0|nullable',
            'total' => 'required|integer|min:0',
            'payment_status' => 'boolean|nullable',
            'working_status' => 'boolean|nullable',
            'customer_id' => 'required|exists:customers,id',
            'packet_id' => 'required|exists:packets,id',
        ];
    }
}
