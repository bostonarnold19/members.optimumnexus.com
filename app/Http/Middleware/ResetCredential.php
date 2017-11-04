<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class ResetCredential
{
    protected $auth;

    public function __construct()
    {
        $this->auth = auth()->user();
    }

    public function handle($request, Closure $next)
    {
        if ($this->auth && empty($this->auth->first_name)) {
            return redirect()->route('get.user.reset-credentials');
        } elseif (Auth::guest()) {
            return redirect()->route('login');
        } else {
            return $next($request);
        }
    }
}
