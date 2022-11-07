<?php

namespace App\Model2;
Use App\Models\Plan;

class Plans{

	
   public function all(){
	   
	   return Plan::all();
   }
}

?>