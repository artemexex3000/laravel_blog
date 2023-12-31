<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static findOrFail($id)
 */
class Post extends Model
{
    use HasFactory;

    protected $with = ['category', 'author'];

    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'title',
        'excerpt',
        'body',
    ];

    protected $guarded = [
        'id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => $query
            ->where(fn($query) => $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%'))
        );

        $query->when($filters['category'] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query
                ->where('slug', $category))
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
