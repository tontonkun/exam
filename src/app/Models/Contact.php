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

   public function category()
   {
       return $this->belongsTo(Category::class, 'category_id');
   }

    public function scopeKeywordSearch($query, $keyword)
    {
    if (!empty($keyword)) {
        $query->where(function($q) use ($keyword) {
            $q->where('first_name', 'like', '%' . $keyword . '%')
            ->orWhere('last_name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)) {
            $query->where('gender', $gender);
        }
    }

    public function scopeCategoryContentSearch($query, $content)
    {
        if (!empty($content)) {
            $query->whereHas('category', function($q) use ($content) {
                $q->contentSearch($content);
            });
        }
    }
    
    public function scopeDateSearch($query, $dateSelect)
{
    if (!empty($dateSelect)) {
        $query->whereDate('created_at', $dateSelect);
    }
}
    }


