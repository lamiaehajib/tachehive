<x-app-layout>
    <style>
            body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .form-card {
            background: #cedce7;
    background: -webkit-linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: -o-linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: linear-gradient(178deg, #ff8080, #fdfcfc, #ff0e0e, #d53070);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #C2185B;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-size: 1rem;
            font-weight: 500;
            color: #444;
        }

        .form-control {
            background-color: #fafafa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 20px;
        }

        .form-control:focus {
            border-color: #D32F2F;
            box-shadow: 0 0 5px rgba(211, 47, 47, 0.5);
        }

        .btn-primary {
            background-color: #D32F2F;
            border: none;
            color: #fff;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #C2185B;
        }

        .alert-danger {
            background-color: #F8D7DA;
            color: #721C24;
            border: 1px solid #F5C6CB;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-danger ul {
            list-style-type: none;
            padding: 0;
        }

        .alert-danger li {
            margin-bottom: 5px;
        }
        .div-flex {
  display: flex;
  gap: 45px;
        }
        #clas-da{
            margin-top: 20px;
        }
    </style>
   @can("tache-edit")
   <div class="container">
       <h1>Modifier la Tâche</h1>
       <div class="form-card">
           <form action="{{ route('taches.update', $tache->id) }}" method="POST">
               @csrf
               @method('PUT')
   
               @if(auth()->user()->hasRole('Admin'))
                   <div class="div-flex">
                       <div class="form-group">
                           <label>Date début</label>
                           <input type="date" name="datedebut" class="form-control" value="{{ $tache->datedebut }}" required>
                       </div>
   
                       <div class="form-group">
                           <label for="iduser">Utilisateur</label>
                           <select name="iduser" id="iduser" class="form-control" required>
                               @foreach($users as $user)
                                   <option value="{{ $user->id }}" {{ $tache->iduser == $user->id ? 'selected' : '' }}>
                                       {{ $user->name }}
                                   </option>
                               @endforeach
                           </select>
                       </div>
                   </div>
   
                   <div class="form-group">
                       <label>Description</label>
                       <textarea name="description" class="form-control" required>{{ $tache->description }}</textarea>
                   </div>
   
                   <div class="form-group">
                       <label>Durée</label>
                       <input type="text" name="duree" class="form-control" value="{{ $tache->duree }}" required>
                   </div>
   
                   <div class="form-group">
                       <label>Date</label>
                       <select name="date" class="form-control" required>
                           <option value="jour" {{ $tache->date == 'jour' ? 'selected' : '' }}>Jour</option>
                           <option value="semaine" {{ $tache->date == 'semaine' ? 'selected' : '' }}>Semaine</option>
                           <option value="mois" {{ $tache->date == 'mois' ? 'selected' : '' }}>Mois</option>
                       </select>
                   </div>
               @endif
   
               <div class="form-group">
                   <label>Status</label>
                   <select name="status" class="form-control" required>
                       <option value="nouveau" {{ $tache->status == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                       <option value="en cours" {{ $tache->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                       <option value="termine" {{ $tache->status == 'termine' ? 'selected' : '' }}>Terminé</option>
                   </select>
               </div>
   
               <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
           </form>
       </div>
   </div>
   @endcan
</x-app-layout>
