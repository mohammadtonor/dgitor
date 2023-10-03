<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AjaxCheckMiddleware
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
        if ($request->ajax()) {
//        if ($request->header('X-Requested-With') == 'XMLHttpRequest') {
            // Code to handle AJAX requests
            return $next($request); // Continue to the next step for AJAX requests
        } else {
            // Code to handle non-AJAX requests (optional)
            return response()->json(['message' => 'This is not an AJAX request']);
            // OR return view('your_view');
            // OR abort(403, 'Access denied');  // or any other response you need
        }
    }
}
