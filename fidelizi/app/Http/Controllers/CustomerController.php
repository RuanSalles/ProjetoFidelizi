<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $customers = Customer::when(isset($request->active) && $request->active == 1, function ($query) {
                return $query->where('active', true);
            })->simplePaginate(10);

            if (!isset($customers)) {
                throw new \Exception("Não foram encontrados registros");
            }
            return new CustomerCollection($customers);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage(), 'code' => $e->getCode()]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
            return response()->json(Customer::create($request->validated()), 201);
        } catch (\Exception $e) {
            return new CustomerCollection([], $e->getMessage(), '500');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Customer::find($id), 200);
    }

    public function getPoints($id)
    {
        return response()->json(Customer::getPoints($id)->get(), 200);
    }

    public function addPoints(Request $request, string $id)
    {
        $customer = Customer::find($id);
        $points = $customer->points += $request->get('points');
        $customer->update(['points' => $points]);

        return response()->json($customer);
    }

    public function debitPoints(Request $request, string $id)
    {
        try {
            $customer = Customer::find($id);
            $currentPoints = $customer->points;

            if($currentPoints < $request->get('points')){
                throw new \Exception("Você não tem pontos suficientes", '500');
            }

            $points = $customer->points -= $request->get('points');
            $customer->update(['points' => $points]);

            return response()->json($customer);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'code' => $e->getCode()], 500);
        }

    }
    public function activateCustomer($id)
    {
        $customer = Customer::find($id);
        $customer->update(['active' => true]);
        return response()->json($customer, '200');
    }

    public function deactivateCustomer($id)
    {
        $customer = Customer::find($id);
        $customer->update(['active' => false]);
        return response()->json($customer, '200');
    }
}
