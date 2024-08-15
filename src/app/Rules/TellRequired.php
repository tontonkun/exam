<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TellRequired implements Rule
{
    private $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public function passes($attribute, $value)
    {
        $errors = [];
        foreach ($this->fields as $field) {
            $validator = \Validator::make(
                [$field => request()->input($field)],
                [
                    $field => 'nullable|numeric|digits_between:1,5',
                ]
            );

            if ($validator->fails()) {
                $errors[] = $validator->errors()->first($field);
            }
        }

        return empty($errors) || count(array_unique($errors)) === 1;
    }

    public function message()
    {
        return '電話番号を入力してください';
    }
    }