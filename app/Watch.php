<?php

namespace App;

use Session;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    //
    public function movie()
    {
        $movie = [];
        $key = false;

    	if(Session::has('history')) {
           $movie =  Session::get('history');
    	   $key = array_search($this->movieId, array_column($movie, 'id'));
        }

    	if ($key !== false) {
        	return $movie[$key];
		} else {
			return (object) tmdb()->getMovie($this->movieId)->get();
		}
    }
}
