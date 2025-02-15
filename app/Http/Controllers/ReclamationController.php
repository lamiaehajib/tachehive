<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use App\Models\User;
use App\Notifications\ReclamationCreatedNotification;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    /**
     * Affiche la liste des réclamations.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()                                 

    {
         $this->middleware('permission:reclamation-list|reclamation-create|reclamation-edit|reclamation-delete', ['only' => ['index','show']]);

         $this->middleware('permission:reclamation-create', ['only' => ['create','store']]);

         $this->middleware('permission:reclamation-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:reclamation-delete', ['only' => ['destroy']]);

         $this->middleware('permission:reclamation-show', ['only' => ['show']]);
    }
    public function index()
{
    $user = auth()->user();
    $search = request('search');

    // If the user is an admin, retrieve all reclamations or search them
    if ($user->hasRole('Admin')) {
        if ($search) {
            $reclamations = Reclamation::with('user')
                ->where('titre', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->paginate(10);
        } else {
            $reclamations = Reclamation::with('user')->paginate(10);
        }
    } else {
        // Otherwise, retrieve only the reclamations of the authenticated user or search them
        if ($search) {
            $reclamations = Reclamation::with('user')
                ->where('iduser', $user->id)
                ->where(function($query) use ($search) {
                    $query->where('titre', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                })
                ->paginate(5);
        } else {
            $reclamations = Reclamation::with('user')
                ->where('iduser', $user->id)
                ->paginate(10);
        }
    }

    return view('reclamations.index', compact('reclamations'));
}

    /**
     * Affiche le formulaire de création d'une réclamation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('reclamations.create', compact('users'));
    }

    /**
     * Enregistre une nouvelle réclamation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'date' => 'required|date',
        'description' => 'required|string',
    ]);

    // Créer une nouvelle réclamation
    $reclamation = new Reclamation();
    $reclamation->titre = $request->titre;
    $reclamation->date = $request->date;
    $reclamation->description = $request->description;
    $reclamation->iduser = auth()->user()->id;
    $reclamation->save();

    // Envoyer un email à tous les administrateurs
    $admins = User::role('Admin')->get(); // Sélectionne les utilisateurs ayant le rôle "Admin"
    foreach ($admins as $admin) {
        $admin->notify(new ReclamationCreatedNotification($reclamation));
        
    }

    return redirect()->route('reclamations.index')->with('success', 'Réclamation créée avec succès. Les administrateurs ont été notifiés.');
}
    /**
     * Affiche une réclamation spécifique.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $reclamation = reclamation::findOrFail($id);
    
        // Vérifiez si l'utilisateur a accès à cette tâche
        if ($user->hasRole('Admin') || $reclamation->iduser == $user->id) {
            return view('reclamations.show', compact('reclamation'));
        }
    
        // Rediriger si l'utilisateur n'a pas accès
        return redirect()->route('reclamations.index')->with('error', 'Accès refusé.');
    }

    /**
     * Affiche le formulaire d'édition d'une réclamation.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reclamation $reclamation)
    {
        $users = User::all();
        return view('reclamations.edit', compact('reclamation', 'users'));
    }

    /**
     * Met à jour une réclamation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reclamation $reclamation)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'iduser' => 'required|exists:users,id',
        ]);

        $reclamation->update($request->all());

        return redirect()->route('reclamations.index')->with('success', 'Réclamation mise à jour avec succès.');
    }

    /**
     * Supprime une réclamation.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reclamation $reclamation)
    {
        $reclamation->delete();
        return redirect()->route('reclamations.index')->with('success', 'Réclamation supprimée avec succès.');
    }
}
