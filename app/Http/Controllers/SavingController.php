<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    public function index()
    {


        $id = Auth::User()->id;
        $savings = User::find($id)->savings;
        $loans = User::find($id)->loans;

        $saving_balance = User::find($id)->saving_balance;
        $loan_balance = User::find($id)->loan_balance;


        return view('dashboard', compact(['savings', 'saving_balance', 'loans', 'loan_balance']));
    }

    public function store(Request $request)
    {
        $save = new Saving;
        $trans_type = $request->transaction;
        $save->transaction = $trans_type;
        if ($trans_type == 'Deposit') {
            $save->Amount = $request->amount;
        } else {
            $save->Amount = $request->amount * -1;
        }
        $save->save();
        return redirect('dashboard')->with('status', 'Savings added successfully');
    }

    public function edit(Request $request, $id)
    {
        $saves = Saving::find($id);
        $trans_type = $request->transaction;
        $saves->transaction = $trans_type;
        if ($trans_type == 'Deposit') {
            $saves->Amount = $request->amount;
        } else {
            $saves->Amount = $request->amount * -1;
        }
        $saves->save();
        return redirect('dashboard')->with('status', 'Savings updated successfully');
    }

    public function trans(Request $request)
    {
        $trans = new Transaction;
        $trans->type = $request->type;
        $trans->save();
        return redirect('dashboard')->with('status', 'Transaction type added successfully');
    }

    public function savingsEdit($id)
    {
        $savings = Saving::find($id);
        $transactions = Transaction::all();
        return view('SavingsEdit', compact('savings', 'transactions'));
    }
}
