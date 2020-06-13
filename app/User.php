<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function messages(){

        return $this->hasMany(Chat::class);
        
    }
      public function userGroup()
    {
        return $this->hasManyThrough('App\Group', 'App\UserGroup','groupID','id','id','userID');
    }    
    public function userFriends()
    {
        return $this->hasManyThrough('App\User', 'App\UserFriend','friendID','id','id','userID');
    }
}
