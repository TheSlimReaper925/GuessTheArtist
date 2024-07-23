<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class QuizSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the session ID is present
        if (!Session::has('quiz_session_id')) {
            // Generate a new session ID
            $sessionId = uniqid();
            Session::put('quiz_session_id', $sessionId);

            // Redirect to the homepage
            return redirect('/');
        }

        return $next($request);
    }
}
