<?php

namespace App\Payment;

use Illuminate\Http\Request;
use Auth;
use App\Models\Subscription;
use App\Model2\Sub;

require_once('../vendor/autoload.php');

class Stripe  extends Sub implements Gateway{
	
  
	public function charge($userdetail,$form){
      
      
    
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
		try{
            $customer = \Stripe\Customer::create(array(
                "address" => [
                    "line1" => "Virani Chowk",
                    "postal_code" => "390008",
                    "city" => "Vadodara",
                    "state" => "GJ",
                    "country" => "Nigeria",
                ],
                "email" => $userdetail['email'],
                "name" => $userdetail['name'],
                "source" => $form['stripeToken']
            ));
		}
		catch(\Stripe\Exception\CardException $e) {
			error_log("A payment error occurred: {$e->getError()->message}");
		  } catch (\Stripe\Exception\InvalidRequestException $e) {
			error_log("An invalid request occurred.");
		  } catch (Exception $e) {
			error_log("Another problem occurred, maybe unrelated to Stripe.");
		  }
		try{
			 \Stripe\Charge::create ([
                "amount" => $form['amount'],
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => "Test Project",
                
            ]);
		}
			catch(\Stripe\Exception\CardException $e) {
		error_log("A payment error occurred: {$e->getError()->message}");
	  } catch (\Stripe\Exception\InvalidRequestException $e) {
		error_log("An invalid request occurred.");
	  } catch (Exception $e) {
		error_log("Another problem occurred, maybe unrelated to Stripe.");
	  }
		
		$sub=new Sub();
		$sub->save_payment($form['amount']);
		return "Payment Successful";
				
    }
	
}

?>