<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        if(!isset($_COOKIE['cart_id'])) {
            setcookie('cart_id', uniqid());
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = \Cart::session($_COOKIE['cart_id'])->getContent();

        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('items', 'subtotal'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->amount,
            'quantity' => (int) $request->quantity,
            'attributes' => [
                'img' => $product->main_image,
                'content' => $product->content,
            ]
        ]);

        return response()->json(\Cart::getContent());
    }

    public function removeFromCart(Request $request)
    {
        $cart_id = $_COOKIE['cart_id'];

        \Cart::session($cart_id)->remove($request->id);

        return response()->json(\Cart::getContent());
    }

    public function updateCart(Request $request)
    {
        $cart_id = $_COOKIE['cart_id'];

        \Cart::session($cart_id)->remove($request->id);

        $product = Product::where('id', $request->id)->first();
        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->amount,
            'quantity' => (int) $request->quantity,
            'attributes' => [
                'img' => $product->main_image,
                'content' => $product->content,
            ]
        ]);

        return response()->json(\Cart::getContent());
    }
}
