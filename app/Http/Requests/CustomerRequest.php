<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $method = $this->route()->getActionMethod();
        switch($method){
            case 'update':
                return [
                    'name' => 'required',
                ];
            case 'store':
                return[
                    'name' => 'required',
                    'email' => 'required|email|unique:customers',
                    'mobile' => 'required|numeric|unique:customers|min:10',
                ];
        }
    }
}
