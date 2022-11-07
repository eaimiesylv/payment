<?php

namespace App\Model2;
Use App\Models\DefaultCard;
use Auth;

class Cards{

	
   public function all(){
	   
	   
	    $id=Auth::user()->id;
	    $row=DefaultCard::where('user_id',$id)->get();
		if(count($row)==0){
		  $default="stripe";
		  return $default;
		}
		return $row->default_card;
   }
}

?>