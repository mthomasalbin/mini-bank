<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:customers',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "error_code" => 1,
                "data" => $validator->messages(),
                "show_toast" => true,
                "message" => 'Error'
            ]);
        }

        if (Auth::guard('customer')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $customer = Auth::guard('customer')->user();
            $customer->tokens()->delete();
            $token = $customer->createToken('authToken')->plainTextToken;

            $customer_details = array(
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'balance' => "₹" . $customer->balance
            );

            $data = array(
                'token' => $token,
                'customer_details' => $customer_details,
            );
    
            return response()->json([
                'error_code' => 0,
                'data' => $data,
                'message' => 'Login successful'
            ]);
        }
    
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function profile(Request $request)
    {
        $customer = Auth::guard('sanctum')->user();

        $customer_details = array(
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'balance' => "₹" . $customer->balance
        );

        return response()->json([
            'error_code' => 0,
            'data' => $customer_details,
            'message' => 'Profile fetched successfully'
        ]);
    }

    public function credit(Request $request)
    {
        $customer = Auth::guard('sanctum')->user();

        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rules = [
            'amount' => 'required|numeric|min:0'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "error_code" => 1,
                "data" => $validator->messages(),
                "show_toast" => true,
                "message" => 'Error'
            ]);
        }

        $customer->balance += $request->amount;
        $customer->save();

        Transaction::create([
            'customer_id' => $customer->id,
            'transaction_type' => 'credit',
            'amount' => $request->amount,
            'ip' => '192.168.1.'.rand(1, 254)
        ]);

        $customer_details = array(
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'credited_amount' => "₹ " . $request->amount,
            'balance' => "₹ " . $customer->balance
        );

        return response()->json([
            'error_code' => 0,
            'customer_details' => $customer_details,
            'message' => 'Amount credited successfully'
        ]);
    }

    public function debit(Request $request)
    {
        $customer = Auth::guard('sanctum')->user();

        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rules = [
            'amount' => 'required|numeric|min:0'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "error_code" => 1,
                "data" => $validator->messages(),
                "show_toast" => true,
                "message" => 'Error'
            ]);
        }

        $todayTransactions = Transaction::where('customer_id', $customer->id)
                                         ->whereDate('created_at', today())
                                         ->where('transaction_type', 'debit')
                                         ->count();

        if ($todayTransactions >= 5) {
            return response()->json([
                'error_code' => 1,
                'message' => 'You have reached the transaction limit for today. Please try again tomorrow.'
            ], 200);
        }

        if ($customer->balance < $request->amount) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Insufficient Balance'
            ], 200);
        }

        $customer->balance -= $request->amount;
        $customer->save();

        Transaction::create([
            'customer_id' => $customer->id,
            'transaction_type' => 'debit',
            'amount' => $request->amount,
            'ip' => '192.168.1.'.rand(1, 254)
        ]);

        $customer_details = array(
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'debited_amount' => "₹ " . $request->amount,
            'balance' => "₹ " . $customer->balance
        );

        return response()->json([
            'error_code' => 0,
            'customer_details' => $customer_details,
            'message' => 'Amount debited successfully'
        ]);
    }

    public function customers(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $customers = Customer::with(['transactions' => function ($query) {
            $query->orderBy('id', 'desc')->take(5);
        }])->paginate($perPage, ['*'], 'page', $page);

        $data = $customers->map(function ($customer) {
            return [
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'balance' => "₹" . $customer->balance,
                'transactions' => $customer->transactions->map(function ($transaction) {
                    return [
                        'transaction_type' => $transaction->transaction_type,
                        'amount' => "₹" . $transaction->amount
                    ];
                })
            ];
        });

        return response()->json([
            'error_code' => 0,
            'data' => $data,
            'pagination' => [
                'total' => $customers->total(),
                'per_page' => $customers->perPage(),
                'current_page' => $customers->currentPage(),
                'last_page' => $customers->lastPage(),
            ],
            'message' => 'Customers fetched successfully'
        ]);
    }

}
