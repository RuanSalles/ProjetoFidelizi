<?php

namespace App\Http\Controllers;

use App\Http\Resources\BalanceCollection;
use App\Models\Balance;
use App\Models\Customer;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index()
    {
        return response()->json(new BalanceCollection(Balance::all()), 200);
    }

    public function balanceListForCustomer($id)
    {
        return response()->json([
            'data' => Balance::ListForCustomer($id),
        ]);
    }

    public function reportBalance(Request $request, $id)
    {
        $report = Customer::find($id)->transactions()
            ->when(isset($request->start), function ($query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->start);
            })
            ->when(isset($request->end), function ($query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->end);
            })
            ->get(['id', 'amount', 'generated_points']);
        return response()->json([
            'data' => [
                'amount' => $report->sum('amount'),
                'generated_points' => $report->sum('generated_points'),
            ],
            'count' => count($report),
        ], 200);
    }
}
