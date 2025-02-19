<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard')->with('success', 'Login successful! Welcome back.');
        }
    
        return redirect()->route('admin.login')->with('error', 'Invalid credentials. Please try again.');
    }

    public function dashboard()
    {
        $total_customers = Customer::count();
        $total_transactions = Transaction::count();
        $total_amount = Transaction::sum('amount');
        $average_amount = number_format(($total_amount / $total_transactions), 2);
        return view('index', compact('total_customers', 'average_amount'));
    }

    public function customers()
    {
        $customers = Customer::all();
        return view('customers', compact('customers'));
    }

    public function addCustomer()
    {
        return view('add-customer');
    }

    public function saveCustomer(Request $request)
    {
        $messages = [
            'name.required' => 'Please enter the customer name.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered. Try another one.',
            'phone.required' => 'Phone number is required.',
            'phone.digits' => 'Phone number must be exactly 10 digits long.',
            'phone.unique' => 'This phone number is already in use.',
            'password.required' => 'Password is required for account creation.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain at least one uppercase letter.',
            'status.required' => 'Please select the customer status.'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|digits:10|unique:customers',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/'
            ],
            'status' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed. Please check the form.');
        }

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'status' => $request->status
        ]);

        return redirect()->route('admin.customers')->with('success', 'Customer added successfully!');
    }

    public function viewTransaction($id)
    {
        $id = decrypt($id);
        $user_transactions = Transaction::where('customer_id', $id)->get();
        return view('transactions', compact('user_transactions'));
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.loginPage')->with('success', 'Logout successful!');
    }
}
