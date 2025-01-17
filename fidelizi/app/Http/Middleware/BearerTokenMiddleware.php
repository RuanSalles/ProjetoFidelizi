<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\DB;

class BearerTokenMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $requiredPermission = null)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Token ausente ou inválido'], 401);
        }

        $tokenValue = substr($authHeader, 7);
        $token = DB::table('tokens')->where('token', $tokenValue)->first();

        if (!$token) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        if ($requiredPermission && !in_array($requiredPermission, $token->permissions)) {
            return response()->json(['error' => 'Permissão negada'], 403);
        }

        return $next($request);
    }
}
