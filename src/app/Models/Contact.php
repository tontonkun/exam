<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tell1',
        'tell2',
        'tell3',
        'address',
        'building',
        'content',
        'detail'
    ];

    // Categoryとのリレーションを定義
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // キーワード検索のスコープ
    public function scopeKeywordSearch($query, $keyword)
    {
        return $query->when(!empty($keyword), function($q) use ($keyword) {
            $q->where(function($query) use ($keyword) {
                $query->where('first_name', 'like', '%' . $keyword . '%')
                      ->orWhere('last_name', 'like', '%' . $keyword . '%')
                      ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        });
    }

    // 性別検索のスコープ
    public function scopeGenderSearch($query, $gender)
    {
        return $query->when(!empty($gender), function($q) use ($gender) {
            $q->where('gender', $gender);
        });
    }

    // カテゴリーのコンテンツ検索のスコープ
    public function scopeCategoryContentSearch($query, $content)
    {
        return $query->when(!empty($content), function($q) use ($content) {
            $q->whereHas('category', function($q) use ($content) {
                $q->contentSearch($content); // Categoryモデルにこのメソッドが定義されていることを確認
            });
        });
    }

    // 日付検索のスコープ
    public function scopeDateSearch($query, $dateSelect)
    {
        return $query->when(!empty($dateSelect), function($q) use ($dateSelect) {
            $q->whereDate('created_at', $dateSelect);
        });
    }
}
