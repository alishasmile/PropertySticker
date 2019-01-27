<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datum extends Model
{
	public function notes(){
    	return $this->hasmany('\App\Note');
    }
}
