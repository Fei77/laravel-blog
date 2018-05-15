<?php

namespace App\Concern;

use App\Media;
use Helpers;
use File;

trait Mediable
{
    /**
     * Check if resource has media
     * 
     * @return boolean
     */
    public function hasMedia(): bool
    {
        return $this->media->isNotEmpty();
    }

    /**
     * Get all of the resource's media
     * 
     * @return \Illuminate\Database\Eloquent\MorphMany
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /**
     * Return model's media
     * 
     * @param string $key
     * @return \App\Media $media
     */
    public function getMedia($key)
    {
        $media = $this->media();

        if($key !== '') $media->where('key', $key);

        return $media->first();
    }

    /**
     * Get media url
     * 
     * @param string $key
     * @return string
     */
    public function getOriginalUrl($key = '')
    {
        if(!$this->hasMedia()) return '';

        $media = $this->getMedia($key);

        if(empty($media)) return;

        return asset($media->original_filename ? $media->original_filename : '');
    }

    /**
     * Get media preview url
     * 
     * @param string $key
     * @return string
     */
    public function getPreviewUrl($key = '')
    {
        if(!$this->hasMedia()) return '';

        $media = $this->getMedia($key);

        if(empty($media)) return;

        return asset($media->preview_filename ? $media->preview_filename : '');
    }

    /**
     * Store image to storage
     * 
     * @param image
     */
    public function handleUpdateMedia($image, $key, $folder, $prefix = '')
    {
        $image = Helpers::image($image)->folder($folder)->prefix(str_slug($prefix))->encode('jpg', 90)->saveWithThumbnail(null, 400);

        $media = $this->media()->where('key', $key)->get();

        foreach($media as $medium) {
            $medium->delete();
        }
        
        $this->media()->create([
            'original_filename' => $image['originalName'],
            'preview_filename' => $image['thumbnailName'],
            'mime_type' => 'jpg',
            'key' => $key,
            'media_alt' => $prefix
        ]);
    }

}