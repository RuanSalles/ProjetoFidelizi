<?php

namespace App\Http\Controllers;

use App\Mail\TransactionMail;
use App\Models\Balance;
use App\Models\Customer;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function store(Request $request)
    {

        $points = Transaction::calculatePoints($request['amount']);

        $transaction = Transaction::create([
            'customer_id' => $request['customer_id'],
            'generated_points' => $points,
            'amount' => $request['amount'],
        ]);

        $balance = Balance::create([
            'transaction_id' => $transaction->id,
            'customer_id' => $request['customer_id'],
            'points' => $points,
            'action' => 'credit',
            'date_transaction' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Customer::addPoints($request['customer_id'], $points);

        $customer = Customer::find($request['customer_id']);

        $dataMail = [
            'customer' => $customer,
            'transaction' => $transaction,
        ];

        Mail::to($customer->email)->send(new TransactionMail($dataMail));

        $response = [
            'data' => [
                'transaction' => $transaction,
                'balance' => $balance,
                'customer' => $customer,
            ],
        ];

        return response()->json($response, 200);
    }
}
