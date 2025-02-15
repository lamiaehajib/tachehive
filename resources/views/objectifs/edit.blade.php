<x-app-layout>
    <style>
        /* Couleurs de fond et du texte */
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
    </style>

    @can("objectif-edit")
    <h1>modifier un Objectif</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
    <form action="{{ route('objectifs.update', $objectif->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="div-flex">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $objectif->date }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="formations" {{ $objectif->type == 'formations' ? 'selected' : '' }}>Formations</option>
                <option value="projets" {{ $objectif->type == 'projets' ? 'selected' : '' }}>Projets</option>
                <option value="vente" {{ $objectif->type == 'vente' ? 'selected' : '' }}>Vente</option>
            </select>
        </div>

        <div class="form-group">
            <label for="iduser">Utilisateur</label>
            <select name="iduser" id="iduser" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{$objectif->iduser }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        </div>
        
        <div class="div-flex">
        <div class="form-group">
            <label for="ca">Chiffre d'affaire</label>
            <input type="text" name="ca" id="ca" class="form-control" value="{{ $objectif->ca }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="mois" {{ $objectif->status == 'mois' ? 'selected' : '' }}>Mois</option>
                <option value="annee" {{ $objectif->status == 'annee' ? 'selected' : '' }}>Année</option>
            </select>
        </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $objectif->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="afaire">À faire</label>
            <textarea name="afaire" id="afaire" class="form-control" required>{{ $objectif->afaire }}</textarea>
        </div>

        

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
    </div>
    @endcan
</x-app-layout>
