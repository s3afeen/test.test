<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // التحقق إذا كان المستخدم مصادَقًا ويملك صلاحية المدير
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // إعادة توجيه المستخدمين العاديين إلى الصفحة الرئيسية أو صفحة أخرى
        return redirect()->route('landing')->with('error', 'You do not have access to the admin dashboard.');
    }
}
