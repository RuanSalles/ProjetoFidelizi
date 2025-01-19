<?php

namespace App\Http\Controllers;

use App\Http\Resources\RescueAwardCollection;
use App\Mail\RescueAwardMail;
use App\Models\Award;
use App\Models\Balance;
use App\Models\Customer;
use App\Models\RescueAward;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RescueAwardController extends Controller
{

    public function index()
    {
        return response()->json(new RescueAwardCollection(RescueAward::all()), 200);
    }
    public function store(Request $request): JsonResponse
    {

        try {
            $award = Award::find($request['award_id']);

            Customer::debitPoints($request['customer_id'], $award->points_value);

            $customer = Customer::find($request['customer_id']);

            $balance = Balance::create([
                'transaction_id' => '',
                'customer_id' => $request['customer_id'],
                'points' => $award->points_value,
                'action' => 'debit',
                'date_transaction' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $recueAward = RescueAward::create([
                'customer_id' => $request['customer_id'],
                'award_id' => $award->id,
                'debit_points' => $award->points_value,
                'date_rescue' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $dataMail = [
                'customer' => $customer,
                'recueAward' => $recueAward,
                'award' => $award,
            ];

            Mail::to($customer->email)->send(new RescueAwardMail($dataMail));

            return response()->json([
                'data' => [
                    'rescue_award' => $recueAward,
                    'balance' => $balance,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [
                    'error' => $e->getMessage(),
                ]
            ], 400);
        }
    }
}
