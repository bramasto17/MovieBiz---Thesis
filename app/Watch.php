<?php

namespace App;

use Session;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    //
    public function movie()
    {
    	$movie = Session::has('history') ? Session::get('history') : null;
    	$key = array_search($this->movieId, array_column($movie, 'id'));
    	if ($key !== false) {
        	return $movie[$key];
		} else {
			return (object) tmdb()->getMovie($this->movieId)->get();
		}
    }
}
