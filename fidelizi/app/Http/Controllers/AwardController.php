<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class AwardController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $awards = Award::all();

        return response()->json($awards, 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $award = Award::find($id);

        return response()->json($award, 200);
    }
}
