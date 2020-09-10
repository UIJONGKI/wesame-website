<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
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
        $mimes = implode(',', config('project.mimes'));
        return [
            'category' => ['required'],
            'name' => ['required'],
            'email' => 'required|email|max:255',
            'subject' => ['required'],
            'context' => ['required', 'min:10'],
            'files' => ['array'],

        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute은(는) 필수 입력 항목입니다.',
            'email' => '이메일 형식이 아닙니다.',
            'min' => ':attribute은(는) 최소 :min글자 이상이 필요합니다.',
            'max' => ':attribute은(는) 최대 :max 크기 입니다.',


        ];
    }

    public function attributes()
    {
        return [
            'category' => '종류',
            'context' => '내용',
            'files' => '이미지',
            'name' => '이름',
            'subject' => '제목',
            'email' => '이메일',
        ];
    }
}
