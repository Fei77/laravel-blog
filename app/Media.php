<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The attributes that are mass assignable
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
     * Add event listener
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
