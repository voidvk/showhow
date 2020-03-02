<?php

namespace App\Admin\Http\Requests;

use App\Admin\Http\Request;
use App\Models\Author as Model;
use Illuminate\Validation\Rule;

class Author extends Request
{
    public $name_array = 'authors';
    /**
     * @param Model $model
     *
     * @return array
     */
    public function rules(Model $model): array
    {
        $result = [
            'name'           => 'required|string|max:255',
            'locale'         => 'required',
            'visible_locale' => [
                'required',
                Rule::in(array_keys(Model::listVisibleLocale()))
            ],
            'body'           => 'nullable|string',
            'short_body'     => 'nullable|string',
            'img'            => 'nullable|image',
            'partner_id'     => 'nullable|model_exists:' . \App\Models\Partner::class
        ];
        return $model->mutatorRules($result);
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'locale'         => 'Основной язык',
            'visible_locale' => 'В каких языковых версиях видим',
            'name'           => 'ФИО',
            'short_body'     => 'Краткая информация',
            'body'           => 'Биография',
            'img'            => 'Фото',
            'partner_id'     => 'Партнёр',
        ];
    }
}
