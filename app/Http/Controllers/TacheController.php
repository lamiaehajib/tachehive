<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\User; // Import du modèle User
use App\Notifications\TacheCreatedNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

class TacheController extends Controller
{
    function __construct()

    {
         $this->middleware('permission:tache-list|tache-create|tache-edit|tache-delete', ['only' => ['index','show']]);

         $this->middleware('permission:tache-create', ['only' => ['create','store']]);

         $this->middleware('permission:tache-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:tache-delete', ['only' => ['destroy']]);

         $this->middleware('permission:tache-show', ['only' => ['show']]);
    }
    public function index()
    {
        $user = auth()->user();
        $search = request('search'); // Get the search query
    
        // Build the query
        $query = Tache::with('user');
    
        // Check if there is a search query
        if ($search) {
            $query->where('description', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereDate('date', 'like', "%{$search}%");
        }
    
        // Order by status: 'en cours', 'nouveau', 'termine'
        $query->orderByRaw("FIELD(status, 'en cours', 'nouveau', 'termine')");
    
        // If the user is an admin, fetch all tasks, otherwise fetch only the user's tasks
        if ($user->hasRole('Admin') || $user->hasRole('admis2') || $user->hasRole('admis3')) {
            $taches = $query->paginate(10);
        } else {
            $taches = $query->where('iduser', $user->id)->paginate(10);
        }
    
        return view('taches.index', compact('taches'));
    }

    
    public function create()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('taches.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'duree' => 'required|string|max:255',
            'datedebut' => 'required|date',
            'status' => 'required|in:nouveau,en cours,termine',
            'date' => 'required|in:jour,semaine,mois',
            'iduser' => 'required|exists:users,id',
        ]);
    
        $tache = Tache::create($request->all());
    
        // Récupérer l'utilisateur assigné à la tâche
        $user = User::findOrFail($request->iduser);
    
        // Envoyer la notification
        $user->notify(new TacheCreatedNotification($tache));
    
        return redirect()->route('taches.index')->with('success', 'Tâche créée avec succès.');
    }
    

    public function show($id)
{
   
    $user = auth()->user();
    $tache = Tache::findOrFail($id);

    // Vérifiez si l'utilisateur a accès à cette tâche
    if ($user->hasRole('Admin') || $tache->iduser == $user->id) {
        return view('taches.show', compact('tache'));
    }

    // Rediriger si l'utilisateur n'a pas accès
    return redirect()->route('taches.index')->with('error', 'Accès refusé.');
}


    public function edit($id)
    {
        $tache = Tache::findOrFail($id);
        $users = User::all(); // Passer aussi les utilisateurs à la vue d'édition
        return view('taches.edit', compact('tache', 'users'));
    }

    public function update(Request $request, $id)
{
    $user = auth()->user();
    $tache = Tache::findOrFail($id);

    if ($user->hasRole('Admin')|| $user->hasRole('ADMIN2') || $user->hasRole('ADMIN1')) {
        // Admin can modify everything
        $request->validate([
            'description' => 'required|string|max:255',
            'duree' => 'required|string|max:255',
            'datedebut' => 'required|date',
            'status' => 'required|in:nouveau,en cours,termine',
            'date' => 'required|in:jour,semaine,mois',
            'iduser' => 'required|exists:users,id',
        ]);
        $tache->update($request->all());
    } elseif ($user->hasRole('UITS')) {
        // UITS can only modify the status
        $request->validate([
            'status' => 'required|in:nouveau,en cours,termine',
        ]);
        $tache->update(['status' => $request->status]);
    } else {
        return redirect()->route('taches.index')->with('error', 'Accès refusé.');
    }

    return redirect()->route('taches.index')->with('success', 'Tâche mise à jour avec succès.');
}

    public function destroy($id)
    {
        $tache = Tache::findOrFail($id);
        $tache->delete();
        return redirect()->route('taches.index')->with('success', 'Tâche supprimée avec succès.');
    }
}
