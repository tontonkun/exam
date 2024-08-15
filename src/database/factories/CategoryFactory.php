<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
     protected $model = Category::class;

    // クラスプロパティを定義
    protected $contentOptions = [
        '商品のお届けについて',
        '商品の交換について',
        '商品トラブル',
        'ショップへのお問い合わせ',
    ];

    public function definition()
    {
        return [
            'content' => $this->faker->randomElement($this->contentOptions),
            // 他のカラムもここに定義する
        ];
    }
}
