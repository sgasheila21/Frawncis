<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactionShow (){
        $total_price = 0;
        $transactions = Transaction::all();
        return view('transaction',compact(['transactions','total_price']));
    }

    public function updatePickupStatus (Request $request) {
        $trans = Transaction::whereIn('id', $request->transItems)->get();
        foreach($trans as $tran){
            $tran->pickup_status = 1;
            $tran->admin_id = auth()->user()->id;
            $tran->save();
        }
        return redirect('/transactions');
    }
}
