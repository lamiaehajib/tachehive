<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()

    {

         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);

         $this->middleware('permission:user-create', ['only' => ['create','store']]);

         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        // Récupérer le mot-clé de recherche
        $search = $request->input('search');
    
        // Construire la requête avec recherche
        $query = User::orderBy('id', 'DESC');
        
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%') // Exemple : recherche par nom
                  ->orWhere('email', 'like', '%' . $search . '%') // Recherche par email
                  ->orWhere('code', 'like', '%' . $search . '%'); // Recherche par ID
            });
        }
    
        // Paginer les résultats
        $data = $query->paginate(10);
    
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $roles = Role::pluck('name','name')->all();

        return view('users.create',compact('roles'));

    }

    

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

     public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'roles' => 'required',
        'tele' => 'required|string',
        'code' => 'required|integer',
        'poste' => 'required|string',
        'adresse' => 'required|string',
        'repos' => 'required|string',
    ]);

    $input = $request->all();
    $password = '123456'; // Mot de passe par défaut
    $input['password'] = Hash::make($password);

    $user = User::create($input);
    $user->assignRole($request->input('roles'));

    // URL de ton site
    $siteUrl = 'http://rh.uits.local:8000/';

    // Envoyer la notification
    $user->notify(new \App\Notifications\UserCreatedNotification($user->email, $password, $siteUrl));

    return redirect()->route('users.index')
                     ->with('success', 'Utilisateur créé avec succès et e-mail envoyé.');
}

     

    

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $user = User::find($id);

        return view('users.show',compact('user'));

    }

    

    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $user = User::find($id);

        $roles = Role::pluck('name','name')->all();

        $userRole = $user->roles->pluck('name','name')->all();

    

        return view('users.edit',compact('user','roles','userRole'));

    }

    

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

     public function update(Request $request, $id)
     {
         $this->validate($request, [
             'name' => 'required',
             'email' => 'required|email|unique:users,email,'.$id,
             'password' => 'same:confirm-password',
             'roles' => 'required',
             'tele' => 'required|string',
             'code' => 'required|integer',
             'poste' => 'required|string',
             'adresse' => 'required|string',
             'repos' => 'required|string',
         ]);
     
         $input = $request->all();
     
         if (!empty($input['password'])) {
             $input['password'] = Hash::make($input['password']);
         } else {
             $input = Arr::except($input, ['password']);
         }
     
         $user = User::find($id);
         $user->update($input);
     
         DB::table('model_has_roles')->where('model_id', $id)->delete();
         $user->assignRole($request->input('roles'));
     
         return redirect()->route('users.index')
                          ->with('success', 'Utilisateur mis à jour avec succès.');
     }
     

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        User::find($id)->delete();

        return redirect()->route('users.index')

                        ->with('success','Utilisateur supprimé avec succès.');

    }
}
