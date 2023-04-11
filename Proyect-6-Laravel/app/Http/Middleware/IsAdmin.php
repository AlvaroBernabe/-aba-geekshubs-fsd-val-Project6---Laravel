<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
        public function handle(Request $request, Closure $next)
        {
            Log::info("Middleware");
            $userId = auth()->user()->id;
            $user = User::find($userId);
            $role = $user->role_id;
            if ($role != 1) {
                return response()->json([
                    'success' => false,
                    'message' => "Unauthorized"
                ]);
            }
        return $next($request);
    }
}
