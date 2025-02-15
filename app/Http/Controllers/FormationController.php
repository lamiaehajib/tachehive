<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User; // Pour récupérer les utilisateurs
use App\Notifications\FormationCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormationController extends Controller
{
    function __construct()                                 

    {
         $this->middleware('permission:formation-list|formation-create|formation-edit|formation-delete', ['only' => ['index','show']]);

         $this->middleware('permission:formation-create', ['only' => ['create','store']]);

         $this->middleware('permission:formation-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:formation-delete', ['only' => ['destroy']]);

         $this->middleware('permission:formation-show', ['only' => ['show']]);

    }
    // Afficher toutes les formations
    public function index()
{
    $user = auth()->user();
    $search = request()->get('search'); // Get the search query

    // Build the query
    $query = Formation::with('users');

    // If the user is an admin, show all formations, otherwise show the formations related to the user
    if ($user->hasRole('Admin') || $user->hasRole('admis3')) {
        // Add search condition if present
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%')
                  ->orWhere('nomformateur', 'like', '%' . $search . '%');
        }
        // Order by the most recent formation
        $formations = $query->orderBy('created_at', 'desc')->paginate(10);
    } else {
        // For non-admins, show only the formations that the user is part of
        $formations = Formation::with('users')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('status', 'like', '%' . $search . '%')
                      ->orWhere('nomformateur', 'like', '%' . $search . '%');
            })
            // Order by the most recent formation
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    return view('formations.index', compact('formations'));
}


   

    // Afficher le formulaire de création de formation
    public function create()
    {
        $users = User::all(); // Récupérer tous les utilisateurs pour les associer à la formation
        return view('formations.create', compact('users'));
    }

    // Enregistrer une nouvelle formation
    // Méthode pour créer une formation
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:en ligne,lieu',
            'nomformateur' => 'required|string|max:255',
            'iduser' => 'required|array',
            'iduser.*' => 'exists:users,id',
            'date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,mp4|max:4048',  // Taille maximale de 4048 Ko (4 Mo)
        'statut' => 'required|in:fini,encour,nouveu',
        'nombre_heures' => 'required|integer',
        'nombre_seances' => 'required|integer',
        'prix' => 'required|numeric',
        'duree' => 'required|integer',
        ]);
    
        $filePath = null;
    
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('formations', 'public');
        }
    
        $formation = Formation::create(array_merge(
            $request->except('iduser', 'file'),
            ['file_path' => $filePath]
        ));
    
        // Association des utilisateurs à la formation
        $formation->users()->attach($request->iduser);
    
        // Envoi de notifications aux utilisateurs
        $users = User::whereIn('id', $request->iduser)->get();
        foreach ($users as $user) {
            $user->notify(new FormationCreatedNotification($formation));
        }
    
        return redirect()->route('formations.index')->with('success', 'Formation créée avec succès.');
    }
    


// Méthode pour afficher une formation spécifique
public function show($id)
{
    $user = auth()->user();
    $formation = Formation::findOrFail($id);

    // Vérification d'accès
    if ($user->hasRole('Admin') || $formation->users->contains('id', $user->id)) {
        return view('formations.show', compact('formation'));
    }

    // Redirection en cas d'accès refusé
    return redirect()->route('formations.index')->with('error', 'Accès refusé.');
}

// Méthode pour afficher le formulaire d'édition
public function edit($id)
{
    $formation = Formation::findOrFail($id);
    $users = User::all(); // Récupérer tous les utilisateurs pour l'affichage dans la vue
    return view('formations.edit', compact('formation', 'users'));
}

// Méthode pour mettre à jour une formation existante
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:en ligne,lieu',
        'nomformateur' => 'required|string|max:255',
        'iduser' => 'required|array',
        'iduser.*' => 'exists:users,id',
        'date' => 'required|date',
        'file' => 'nullable|file|mimes:pdf,doc,docx,png,mp4|max:4048',  // Taille maximale de 4048 Ko (4 Mo)
        'statut' => 'required|in:fini,encour,nouveu',
        'nombre_heures' => 'required|integer',
        'nombre_seances' => 'required|integer',
        'prix' => 'required|numeric',
        'duree' => 'required|integer',
    ]);

    $formation = Formation::findOrFail($id);

    // Gestion de l'ancien fichier si un nouveau est chargé
    if ($request->hasFile('file')) {
        if ($formation->file_path) {
            Storage::delete('public/' . $formation->file_path); // Supprimer l'ancien fichier
        }
        $formation->file_path = $request->file('file')->store('formations', 'public');
    }

    // Mise à jour de la formation
    $formation->update($request->except('iduser', 'file'));

    // Synchronisation des utilisateurs associés
    $formation->users()->sync($request->iduser);

    return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès.');
}

    // Supprimer une formation
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        return redirect()->route('formations.index')->with('success', 'Formation supprimée avec succès.');
    }
}