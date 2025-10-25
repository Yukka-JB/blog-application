<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * Allow mass assignment for these fields.
     * Keep both 'content' (new) and 'comment' (legacy) in the fillable list
     * so existing code or migrations don't break.
     */
    protected $fillable = [
        'post_id',
        'user_id',
        'author_name',
        'content',
        'comment',
    ];

    /**
     * Mutator: when code sets $comment->content = 'text' or uses ['content' => ...]
     * write into the underlying 'comment' column (legacy DB).
     */
    public function setContentAttribute($value)
    {
        $this->attributes['comment'] = $value;
    }

    /**
     * Accessor: when code reads $comment->content return the legacy 'comment' column.
     */
    public function getContentAttribute()
    {
        return $this->attributes['comment'] ?? null;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}