<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Http\Requests\Cart\OrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function order(OrderRequest $request)
    {
    	$order = Order::create($request->all());

    	if($order) {
    		Cart::clear();
    	}

    	return response()->json([
    		'data' => $order
    	]);
    }
}
