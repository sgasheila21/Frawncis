<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Location;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartShow(){
        $carts = Cart::where('member_id',auth()->user()->id)->get();
        $locations = Location::all();
        return view('cart', compact(['carts','locations']));
    }

    public function quantityUpdate(Request $request, $id){
        $cart = Cart::find($id);
        if($request->has('decrementBtn') || $request->has('incrementBtn')){
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        else if($request->has('trashBtn')){
            $cart->delete();
        }

        return redirect()->back();
    }

    public function checkoutCart(Request $request){
        $carts = Cart::where('member_id',auth()->user()->id)->get();
        
        $validateData = $request->validate([
            'ddlLocation' => 'required',
        ],
        [
            'ddlLocation.required' => 'Please choose the location!',
        ]);

        foreach($carts as $cart){
            $inserted = Transaction::create([
                'member_id' => auth()->user()->id,
                'location_id' => $request->ddlLocation,
                'product_id' => $cart->products->id,
                'quantity' => $cart->quantity,
                'transaction_date' => Carbon::now(),
                'pickup_status' => 0
            ]);

            $deleted = $cart->delete();
        }
        if($inserted && $deleted){
            return redirect('/products')->with('success', 'Checkout Successfully!');
        }
        else{
            return redirect('/products')->with('failure', 'Failed to Checkout!');
        }
    }
}
