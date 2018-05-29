<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * Return a unique personnal access token.
     *
     * @var string
     */
    public static function generateApiToken(): string
    {
        do {
            $api_token = str_random(60);
        } while (User::where('api_token', $api_token)->exists());

        return $api_token;
    }


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Listen to creating user event
         * and automatically create a unique api_token
         * 
         * @param \App\User $user
         * @return void
         */
        User::creating(function($user) {
            $user->api_token = $user->generateApiToken();
        });
    }
}
