<?php

namespace App\Http\Requests;

use App\Gallery_Attachment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;

class GalleriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $dontFlash = [
        'files',
    ];
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
            'title' => ['required'],
            'content' => ['required', 'min:10'],
            'gtags' => ['required', 'array'],
            'files' => ['array', 'min:3'],
            'files.*' => ["mimes:{$mimes}", 'max:50000'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute은(는) 필수 입력 항목입니다.',
            'min' => ':attribute은(는) 최소 :min 이상이 필요합니다.',
            
        ];
    }

    public function attributes()
    {
        return [
            'title' => '제목',
            'content' => '본문',
            'files' => '이미지',
            'tags' => '카테고리',

        ];
    }

    public function getPayload()
    {
        return array_merge($this->all(), [
            'notification' => $this->has('notification'),
        ]);
    }

    public function getAttachments()
    {
        return Gallery_Attachment::whereIn(
            'id',
            $this->input('attachments', [])
        )->get();
    }
}
