<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('administrator')->check()) {
            // return redirect()->route('admin.login')->with('msg', 'Bạn không có quyền truy cập vào trang này');
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
