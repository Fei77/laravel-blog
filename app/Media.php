<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'preview_filename',
        'original_filename',
        'mime_type',
        'mediable_id',
        'mediable_type',
        'order',
        'key',
        'alt_text',
        'title'
    ];

    /**
     * The attributes that are appended
     * 
     * @var array
     */
    protected $appends = [
        'preview_url',
        'original_url'
    ];

    /**
     * The accessor for preview_url attribute
     * 
     * @return string
     */
    public function getPreviewUrlAttribute()
    {
        $this->preview_filename ? asset($this->preview_filename) : '//via.placeholder.com/800x400'
    }

    /**
     * The accessor for original_url attribute
     * 
     * @return string
     */
    public function getOriginalUrlAttribute()
    {
        $this->original_filename ? asset($this->original_filename) : '//via.placeholder.com/800x400'
    }

    /**
     * The "booting" method of the model.
     * 
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        /**
         * Listen to the Media deleted event. Delete media files 
         * from storage when a media is deleted
         * 
         * @param \App\Media $media
         * @return void
         */
        Media::deleted(function($media) {
            $file = public_path() . $media->original_filename;

            if(File::isFile($file)) {
                File::delete($file);
            }

            $file = public_path() . $media->preview_filename;

            if(File::isFile($file)) {
                File::delete($file);
            }
        });
    }
}
