<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartCollection = Cart::getContent();

        return view('cart.index')->with([
        	'cartCollection' => $cartCollection
        ]);
    }

    public function add(Request$request){
        Cart::add(array(
            'id' => $request->id,
            'name' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ));

        return redirect()->route('cart.index')->with('success_msg', 'Добавлено в корзину!');
    }

    public function remove(Request $request)
    {
        Cart::remove($request->id);

        return redirect()->route('cart.index')->with('success_msg', 'Товар удален из корзины!');
    }

    public function update(Request $request)
    {
        Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));

        return redirect()->route('cart.index')->with('success_msg', 'Корзина обновлена!');
    }

    public function clear(){
        Cart::clear();

        return redirect()->route('cart.index')->with('success_msg', 'Корзина очищена!');
    }
}
