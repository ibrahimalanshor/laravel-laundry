<?php

namespace App\Http\Requests\Packet;

use Illuminate\Foundation\Http\FormRequest;

class CreatePacketRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $this->merge([
            'price' => intval(str_replace(',', '', $this->price))
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
            'name' => 'required|string|unique:packets',
            'price' => 'required|integer|min:0',
            'time' => 'required|integer|min:0',
            'detail' => 'required|string'
        ];
    }
}
