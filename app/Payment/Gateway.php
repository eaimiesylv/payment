<?php

namespace App\Payment;


class Gateway{

	
    public function __construct(){
		
				
    }
	public function charge($amount){
			
		return [
			'amount'=>$amount,
			'confirmation'=>'',
		]
		
	}
}

?>