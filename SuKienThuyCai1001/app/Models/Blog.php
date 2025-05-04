<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'image',
        'category_id',
        'slug'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
} 