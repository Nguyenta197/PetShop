<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.string' => 'Tên sản phẩm phải là chuỗi',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.bigInteger' => 'Giá sản phẩm phải là số nguyên',
            'quantity.required' => 'Số lượng sản phẩm không được để trống',
            'quantity.integer' => 'Số lượng sản phẩm phải là số nguyên',
            'description.required' => 'Mô tả sản phẩm không được để trống',
            'description.string' => 'Mô tả sản phẩm phải là chuỗi',
            'status.required' => 'Trạng thái sản phẩm không được để trống',
            'status.boolean' => 'Trạng thái sản phẩm phải là boolean',

        ];
    }
}
