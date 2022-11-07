<?php

namespace App\Model2;
use App\Models\Subscription;
use Auth;

class Sub{

	
   public function all(){
	   $id=Auth::user()->id;
	   return Subscription::where('user_id',$id)->sum('amount');
   }
}

?>