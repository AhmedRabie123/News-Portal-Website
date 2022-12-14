<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Language;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;
    
    
    public function rSubCategory()
    {
        return $this->hasMany(SubCategory::class)->where('show_on_menu', 'Show')->orderBy('sub_category_order', 'asc');
    }

    public function rLanguage()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

}
