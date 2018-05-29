<?php

namespace App\Concern;

use App\Comment;

trait Commentable
{
    /**
     * Check if resource has comment
     * 
     * @return boolean
     */
    public function hasComment(): bool
    {
        return $this->comment->isNotEmpty();
    }

    /**
     * Return resource's comments table relations
     * 
     * @return \Illuminate\Database\Eloquent\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}