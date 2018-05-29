<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attribute that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
        'commentable_id',
        'commentable_type'
    ];

    /**
     * Return comment's users table relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
