<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'post_id',
        'user_id',
        'name',
        'email',
        'body',
        'stat',
        'parent_id'
    ];

    /**
     * Get the post that the comment belongs to.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user who authored the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent comment, if this comment is a reply.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Get the replies for the comment.
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}