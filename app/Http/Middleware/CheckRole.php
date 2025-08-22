<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles  // Liste des rôles séparés par des virgules
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::utilisateur();
        $rolesArray = explode(',', $roles);

        if (!in_array($user->role->nom, $rolesArray)) {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}
