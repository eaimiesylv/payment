<?php

namespace App\Payment;


class Stripe implements Gateway{

	
   
	public function charge(){
			
		return "Stripe";
		
	}
}

?>