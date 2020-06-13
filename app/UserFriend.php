<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    protected $table = 'user_friend';
    protected $guarded = [];
    public $timestamps = false;
}
