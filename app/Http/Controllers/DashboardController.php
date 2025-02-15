<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use App\Models\Tache;
use App\Models\Project;
use App\Models\Formation;
use App\Models\Objectif;
use App\Models\VenteObjectif;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the index page with the necessary data.
     *
     * @return \Illuminate\View\View
     */
    function __construct()
    {
        $this->middleware('check.clocked.in');
        $this->middleware('permission:project-list|tache-list|formation-list|formation-delete', ['only' => ['index']]);
    }

    public function index(Request $request)
{
    $user = auth()->user();
    $userCount = 0;

    // Get the search term
    $searchTerm = $request->get('search');

    if ($user->hasRole('Admin')) {
        $userCount = User::count();

        // Apply search filter for Admin
        $tasks = Tache::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('description', 'like', '%' . $searchTerm . '%');
        })
        ->orderByRaw("FIELD(status, 'en cours', 'nouveau', 'terminé')")
        ->paginate(5);

        $projects = Project::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('titre', 'like', '%' . $searchTerm . '%')
                         ->orWhere('nomclient', 'like', '%' . $searchTerm . '%');
        })
        ->orderByRaw("CASE WHEN created_at IS NULL THEN 1 ELSE 0 END, created_at DESC")
        ->paginate(5);
        $formations = Formation::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', '%' . $searchTerm . '%');
        })
        ->orderByRaw("CASE WHEN created_at IS NULL THEN 1 ELSE 0 END, created_at DESC")
        ->paginate(5);

        $venteObjectifs = VenteObjectif::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('description', 'like', '%' . $searchTerm . '%');
        })->paginate(5);

        $objectifs = Objectif::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('description', 'like', '%' . $searchTerm . '%');
        })->paginate(5);

        $dashboards = Dashboard::paginate(5);
    } else {
        // Non-Admin data filtering by user ID
        $tasks = Tache::where('iduser', $user->id)->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('description', 'like', '%' . $searchTerm . '%');
        })->orderByRaw("FIELD(status, 'en cours', 'nouveau', 'terminé')")
        ->paginate(5);


        $objectifs = Objectif::where('iduser', $user->id)->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('description', 'like', '%' . $searchTerm . '%');
        })->paginate(5);

        $projects = Project::with('users')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('titre', 'like', '%' . $searchTerm . '%')
                             ->orWhere('nomclient', 'like', '%' . $searchTerm . '%');
            })->orderByRaw("CASE WHEN created_at IS NULL THEN 1 ELSE 0 END, created_at DESC")
            ->paginate(5);
        $formations = Formation::with('users')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })->orderByRaw("CASE WHEN created_at IS NULL THEN 1 ELSE 0 END, created_at DESC")
            ->paginate(5);

        $venteObjectifs = VenteObjectif::where('iduser', $user->id)->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('description', 'like', '%' . $searchTerm . '%');
        })->paginate(5);

        $dashboards = Dashboard::with(['user', 'task', 'project', 'formation', 'venteObjectif', 'objectif'])
            ->where('iduser', $user->id)
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('task', 'like', '%' . $searchTerm . '%')
                             ->orWhere('project', 'like', '%' . $searchTerm . '%');
            })->paginate(5);
    }

    return view('dashboard.index', compact(
        'userCount', 'tasks', 'projects', 'formations', 'venteObjectifs', 'objectifs', 'dashboards'
    ));
}
}
