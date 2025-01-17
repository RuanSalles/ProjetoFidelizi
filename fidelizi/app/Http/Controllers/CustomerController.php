<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerCollection;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $customers = Customer::with('user')->get();

            if (!isset($customers)) {
                throw new \Exception("Não foram encontrados registros");
            }
            return new CustomerCollection($customers, 'Lista carregada com sucesso!', 200);
        } catch (\Exception $e) {
            return new CustomerCollection([], $e->getMessage(), '500');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            return response()->json(Customer::create($request->all()), 201);
        } catch (\Exception $e) {
            return new CustomerCollection([], $e->getMessage(), '500');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Customer::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
}
