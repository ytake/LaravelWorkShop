<?php
namespace App\Http\Requests;

/**
 * Class HomeRequest
 * @package App\Http\Requests
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class HomeRequest extends Request
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
            'name' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => ':attributeを入力してください'
        ];
    }

}
