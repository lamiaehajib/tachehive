<?php

namespace App\Http\Controllers;

use App\Models\Objectif;
use App\Models\User;
use App\Notifications\ObjectifCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjectifController extends Controller
{
    /**
     * Display a listing of the objectifs.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()                                 

    {
         $this->middleware('permission:objectif-list|objectif-create|objectif-edit|objectif-delete', ['only' => ['index','show']]);

         $this->middleware('permission:objectif-create', ['only' => ['create','store']]);

         $this->middleware('permission:objectif-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:objectif-delete', ['only' => ['destroy']]);

         $this->middleware('permission:objectif-show', ['only' => ['show']]);
    }
    public function index(Request $request)
{
    $user = auth()->user();
    
    $query = Objectif::with('user');

    // Check if there's a search query
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function($query) use ($search) {
            $query->where('type', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
        });
    }

    // If the user is an admin, get all objectifs
    if ($user->hasRole('Admin')) {
        $objectifs = $query->paginate(10);
    } else {
        // Otherwise, get only the objectifs associated with the logged-in user
        $objectifs = $query->where('iduser', $user->id)->paginate(10);
    }

    return view('objectifs.index', compact('objectifs'));
}


    /**
     * Show the form for creating a new objectif.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(); 
        return view('objectifs.create', compact('users'));
    }

    /**
     * Store a newly created objectif in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:formations,projets,vente',
            'description' => 'required|string',
            'ca' => 'required|string',
            'status' => 'required|in:mois,annee',
            'afaire' => 'required|string',
            'iduser' => 'required|exists:users,id',
        ]);
    
        $objectif = new Objectif();
        $objectif->date = $request->date;
        $objectif->type = $request->type;
        $objectif->description = $request->description;
        $objectif->ca = $request->ca;
        $objectif->status = $request->status;
        $objectif->afaire = $request->afaire;
        $objectif->iduser = $request->iduser;
        $objectif->save();
    
        // Récupérer l'utilisateur assigné
        $user = User::find($request->iduser);
    
        // Envoyer la notification
        $user->notify(new ObjectifCreatedNotification($objectif));
    
        return redirect()->route('objectifs.index')->with('success', 'Objectif créé avec succès.');
    }
    /**
     * Display the specified objectif.
     *
     * @param  \App\Models\Objectif  $objectif
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user = auth()->user();
    $objectif = Objectif::findOrFail($id);

    // Vérifiez si l'utilisateur a accès à cette tâche
    if ($user->hasRole('Admin') || $objectif->iduser == $user->id) {
        return view('objectifs.show', compact('objectif'));
    }

    // Rediriger si l'utilisateur n'a pas accès
    return redirect()->route('taches.index')->with('error', 'Accès refusé.');
    }

    /**
     * Show the form for editing the specified objectif.
     *
     * @param  \App\Models\Objectif  $objectif
     * @return \Illuminate\Http\Response
     */
    public function edit(Objectif $objectif)
    {
        $users = User::all();
        return view('objectifs.edit', compact('objectif', 'users'));
    }

    /**
     * Update the specified objectif in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objectif  $objectif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objectif $objectif)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:formations,projets,vente',
            'description' => 'required|string',
            'ca' => 'required|string',
            'status' => 'required|in:mois,annee',
            'afaire' => 'required|string',
            'iduser' => 'required|exists:users,id',
        ]);

        $objectif->update([
            'date' => $request->date,
            'type' => $request->type,
            'description' => $request->description,
            'ca' => $request->ca,
            'status' => $request->status,
            'afaire' => $request->afaire,
            'iduser' => $request->iduser,
        ]);

        return redirect()->route('objectifs.index')->with('success', 'Objectif mis à jour avec succès.');
    }

    /**
     * Remove the specified objectif from storage.
     *
     * @param  \App\Models\Objectif  $objectif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objectif $objectif)
    {
        $objectif->delete();
        return redirect()->route('objectifs.index')->with('success', 'Objectif supprimé avec succès.');
    }
}
