<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Concern\Mediable;
use App\Concern\Taggable;

class Post extends Model
{
    use Mediable, Taggable, Sluggable;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'content',
        'is_featured',
        'is_published'
    ];

    /**
     * The attributes that are appended
     * 
     * @var array
     */
    protected $appends = [
        'image_url',
        'image_preview_url',
        'published_date'
    ];

    /**
     * Get post's image url
     * 
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->getOriginalUrl();
    }

    /**
     * Get post's image preview url
     * 
     * @return string
     */
    public function getImagePreviewUrlAttribute()
    {
        return $this->getPreviewUrl();
    }

    /**
     * Published date accessor
     */
    public function getPublishedDateAttribute()
    {
        return ($this->created_at ? $this->created_at->format('l \\- F jS\\, Y') : '');
    }

    /**
     * Return post's author
     * 
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Save resource data to storage
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function handleSave($request)
    {
        $this->update($request->all());

        if($request->image) {
            $this->handleUpdateMedia($request->image, 'post_thumbnail', "images/posts", $this->title);
        }

        $this->save();
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
