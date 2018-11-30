<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    public function following()
	{
	    return $this->hasOne('App\User', 'id', 'followingId');
	}

	public function follower()
	{
	    return $this->hasOne('App\User', 'id', 'userId');
	}
}
