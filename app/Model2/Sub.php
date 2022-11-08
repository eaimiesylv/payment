<?php

namespace App\Model2;
use App\Models\Subscription;
use Auth;

class Sub{

	 public $id;
	public function __construct(){
		 $this->id=Auth::user()->id;
	}
   public function all(){
	  
	   return Subscription::where('user_id',$this->id)->sum('amount');
   }
   
   public function save_payment($amount){
	   
		 Subscription::create([
            'user_id'=>$this->id,
            'plan_id'=>1,
            'amount'=>$amount,
           ]);
   }
}

?>