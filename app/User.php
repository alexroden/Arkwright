<?php

namespace App;

use App\Concerns\HasToken;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string token
 * @property string first_name
 * @property string last_name
 * @property string email
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasToken;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
        'first_name',
        'last_name',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'token'      => 'string',
        'first_name' => 'string',
        'last_name'  => 'string',
        'email'      => 'string',
    ];
}
