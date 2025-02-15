<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\SuivrePointage;
use Carbon\Carbon;

class CheckUserClockIn
{
    public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté et a pointé son arrivée
        $user = Auth::user();

        // Si l'utilisateur est un Admin, il n'a pas besoin de pointer
        if ($user->hasRole('Admin')) {
            return $next($request); // Les admins peuvent passer directement
        } else {
            // Si l'utilisateur n'est pas un Admin, vérifier s'il a pointé
            $pointage = SuivrePointage::where('iduser', $user->id)
                ->whereNull('heure_depart') // Vérifier s'il n'a pas encore pointé
                ->latest()
                ->first();

            // Si l'utilisateur n'a pas encore pointé, rediriger vers la page de pointage
            if ($pointage) {
                return redirect()->route('suivre_pointage.index'); // Redirige vers la page de pointage
            }

            return $next($request); // Sinon, continuer l'exécution
        }
    }
}
