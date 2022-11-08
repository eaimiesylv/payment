<?php

namespace App\Payment;


interface Gateway{

	
	//public function user();
	//public function charge();
	public function charge($user_detail,$order_detail);
}

?>