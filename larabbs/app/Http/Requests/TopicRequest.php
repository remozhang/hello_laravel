<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        // 这里写法中 post，put，patch使用的是同样一套操作
        switch($this->method())
        {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                    'title' => 'required|min:2',
                    'body' => 'required|min:3',
                    'category_id' => 'required|numeric',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            // Validation messages
            'title.min' => '标题至少两个字符',
            'body.min' => '文章内容必须至少三个字符',
        ];
    }
}
