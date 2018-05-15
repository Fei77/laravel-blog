<?php

namespace App\Concern;

use App\Tag;

trait Taggable
{
    /**
     * Check if resource has media
     * 
     * @return boolean
     */
    public function hasTag(): bool
    {
        return $this->tags->isNotEmpty();
    }

    /**
     * Get recource's tags
     * 
     * @return \Illuminate\Database\Eloquest\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * This scope filters results by checking the tags fields.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $slug
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function scopeWhereTag($query, $slug)
    {
        return $query->whereHas('tags', function ($query) use ($slug) {
            $query->where('tags.slug', $slug);
        });
    }
}