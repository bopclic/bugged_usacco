<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Saving;
use App\Models\Loan;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin/login');
    }

    public function index()
    {
        $loans = Loan::all();
        $users = User::all();
        $loan_balance = User::sum('loan_balance');
        $saving_balance = User::sum('saving_balance');

        $users_no = $users->count();
        $open_loans = Loan::where('status', 'Borrow')->count();
        $def_loans = Loan::where('status', 'defaulted')->count();
        $struct_loans = Loan::where('status', 'restructured')->count();
        $paid_loans = Loan::where('status', 'paid')->count();
        $month_user = User::where('created_at', '>', new Carbon('last day of previous month'))->count();

        return view('admin/dashboard', compact('users', 'loans', 'users_no', 'saving_balance', 'loan_balance', 'open_loans', 'def_loans', 'struct_loans', 'paid_loans', 'month_user'));
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin login successful');
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login.form')->with('error', 'Admin logged out successfully');
    }

    public function savingsDeposit(Request $request)
    {
        $save = new Saving;
        $save->transaction = "Deposit";
        $save->amount = $request->amount;
        $user_email = $request->email;
        $deposit_id = User::where('email', $user_email)->first()->id;
        $save->user_id = $deposit_id;
        $save->save();



        $sum = Saving::where('user_id', $deposit_id)->sum('amount');




        User::where('id', $deposit_id)
            ->update([
                'saving_balance' => $sum,
                'last_transaction' => 'Deposit',
                'last_amount' => $request->amount
            ]);

        return redirect('admin/dashboard')->with('status', 'Savings added successfully');
    }

    public function loanCreate(Request $request)
    {
        $id = User::where('email', $request->email)->first()->id;
        $loan = new Loan;
        $loan->user_id = $id;
        $loan->principal = $request->principal;
        $loan->loan_fee = $request->loan_fee;

        $interest = ($request->interest / 100) * $request->principal * $request->maturity;

        $loan->interest = $interest;
        $loan->guarantee = $request->guarantor;

        // $maturity = Carbon::now()->addMonths($request->maturity);



        $maturity = Carbon::createFromFormat('m/d/Y', Carbon::parse($request->date)->format('m/d/Y'))->addMinutes($request->maturity);
        $loan->maturity_date = $maturity;
        $loan->status = "Disbursed";
        $loan->reason = $request->reason;
        $loan->received_amount = ($request->principal) - ($request->loan_fee);
        $loan->monthly_payment = $request->principal * ($request->interest / 100 * pow(1 + ($request->interest / 100), ($request->maturity / 12))) / (pow((1 + $request->interest / 100), ($request->maturity / 12) - 1));
        $loan->loan_balance = $request->principal + $interest;
        $loan->save();




        $principal = Loan::where('user_id', $id)->sum('principal');
        $loan_fee = Loan::where('user_id', $id)->sum('loan_fee');
        $interest = Loan::where('user_id', $id)->sum('interest');
        $loan_balance = $principal + $interest;

        User::where('id', $id)->update([
            'loan_balance' => $loan_balance
        ]);
        return redirect('admin/dashboard')->with('status', 'Loan created successfully');
    }
}
