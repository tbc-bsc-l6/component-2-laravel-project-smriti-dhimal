<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login.');
        }

        switch (strtolower($role)) { 
            case 'admin':
                if (!$user->isAdmin()) {
                    abort(403, 'Access denied. Admin access is needed.');
                }
                break;

            case 'teacher':
                if (!$user->isTeacher()) {
                    abort(403, 'Access denied. Teacher access is needed.');
                }
                break;

            case 'student':
                if (!$user->isCurrentStudent()) { 
                    abort(403, 'Access denied. Student access is needed.');
                }
                break;

            case 'oldstudent':
                if (!$user->isOldStudent()) {
                    abort(403, 'Access denied. Old Student access is needed.');
                }
                break;

            case 'teacher_or_admin':
                if (!$user->isTeacher() && !$user->isAdmin()) { 
                    abort(403, 'Access denied. Teacher or Admin access is needed.');
                }
                break;

            case 'student_or_oldstudent':
                if (!$user->isCurrentStudent() && !$user->isOldStudent()) {
                    abort(403, 'Access denied. Student or Old Student access is needed.');
                }
                break;

            default:
                abort(403, 'Access denied. Unknown role.');
        }

        return $next($request);
    }
}
