<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeRootCategory()
    {
        return $this->where('parent_id', 0);
    }

    public function allLevelChildrenWithSubChild()
    {
        return $this->hasMany(Category::class, 'parent_id')->select('*')->with('allLevelChildrenWithSubChild');
    }   
}
