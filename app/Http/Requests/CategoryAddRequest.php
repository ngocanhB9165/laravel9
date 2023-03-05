<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAddRequest extends FormRequest
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
            'name'=> 'bail|required|min:2|unique:categories',
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Tên danh mục không được để rỗng',
            'name.min' => 'Tên danh mục tối thiểu 2 ký tự',
            'name.unique' => $this->name.'đã tồn tại'
        ];
    }
}
