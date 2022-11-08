<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\Plans;
use App\Model2\Sub;
use App\Model2\Cards;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Plans $plans, Sub $sub,Cards $card)
    {
         $defaultcard= $card->all();
		 $amount=$sub->all();
         $plan=$plans->all();
         $result=array('default_card'=>$defaultcard,'sub_amount'=>$amount,'plan'=>$plan);
        
        return view('home',$result);
    }
    public function show(Request $request){
       
        //$result=array('type'=>$request->payment);
        
        return view('stripe')->with(array('type'=>$request->payment));;
    }

    
}
