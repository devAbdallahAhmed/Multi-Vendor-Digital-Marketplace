<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payWithPaypal(){
    $totalAmount = getCartTotal();
    
    }

  public function  paypalSuccess(){

  }

    public function  paypalError() {}
}
