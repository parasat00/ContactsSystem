<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserOwnsContact
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $contact = $request->route('contact');

        if($contact && $contact->user_id === Auth::id()) {
            return $next($request);
        }
        return response()->json([
            'success' => false,
            'message' => 'You do not have permission to perform this action.'
        ], 403);
    }
}
