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
#div-f{
    display: flex;
    justify-content: center;
}
    </style>
    @can("formation-edit")
    <div class="container">
        <h1>Modifier la formation : {{ $formation->name }}</h1>
    
        <!-- Affichage des messages de succès ou d'erreur -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
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
        <form action="{{ route('formations.update', $formation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="div-flex">
            <div class="form-group">
                <label for="name">Nom de la formation</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $formation->name) }}" required>
            </div>
    
            <div class="form-group">
                <label for="status">type</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="en ligne" {{ old('status', $formation->status) == 'en ligne' ? 'selected' : '' }}>En ligne</option>
                    <option value="lieu" {{ old('status', $formation->status) == 'lieu' ? 'selected' : '' }}>Lieu</option>
                </select>
            </div>
    
            <div class="form-group">
                <label for="nomformateur">Nom du formateur</label>
                <input type="text" class="form-control" id="nomformateur" name="nomformateur" value="{{ old('nomformateur', $formation->nomformateur) }}" required>
            </div>
            </div>
            <div class="div-flex">
           
            <div class="form-group">
                <label for="duree">Durée (en jours)</label>
                <input type="number" class="form-control" id="duree" name="duree" value="{{ old('duree', $formation->duree) }}" required>
            </div>
            <div class="form-group">
                <label for="statut">Statuts</label>
                <select class="form-control" id="statut" name="statut" required>
                    <option value="nouveu" {{ old('statut', $formation->statut) == 'nouveu' ? 'selected' : '' }}>Nouveau</option>
                    <option value="encour" {{ old('statut', $formation->statut) == 'encour' ? 'selected' : '' }}>En cours</option>
                    <option value="fini" {{ old('statut', $formation->statut) == 'fini' ? 'selected' : '' }}>Fini</option>
                    
                    
                </select>
            </div>
    
            <div class="form-group">
                <label for="date">Date de la formation</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $formation->date) }}" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" class="form-control" id="prix" name="prix" step="0.01" value="{{ old('prix', $formation->prix) }}" required>
            </div>
            </div>
            <div class="div-flex" id="div-f">
                <div class="div-flex">
                    <div class="form-group">
                        <label for="nombre_heures">Nombre d'heures</label>
                        <input type="number" class="form-control" id="nombre_heures" name="nombre_heures" value="{{ old('nombre_heures', $formation->nombre_heures) }}" required>
                    </div>
            
                    <div class="form-group">
                        <label for="nombre_seances">Nombre de séances</label>
                        <input type="number" class="form-control" id="nombre_seances" name="nombre_seances" value="{{ old('nombre_seances', $formation->nombre_seances) }}" required>
                    </div>
                    
            </div>
            </div>
            
            <div class="div-flex">
                <div class="form-group">
                    <label for="iduser">Utilisateurs associés</label>
                    <select name="iduser[]" class="form-control select2" multiple required> 
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" 
                                {{ in_array($user->id, $formation->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>   
                </div>
            <div class="form-group">
                <label for="file">Fichier d'emploi du temps (PDF, DOC, DOCX)</label>
                <input type="file" class="form-control" id="file" name="file">
                @if($formation->file_path)
                    <p>Fichier actuel : <a href="{{ asset('storage/' . $formation->file_path) }}" target="_blank">Voir le fichier</a></p>
                @endif
            </div>
            </div>
    
            <button type="submit" class="btn btn-primary">Mettre à jour la formation</button>
        </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Sélectionnez des utilisateurs",
                allowClear: true
            });
        });
    </script>
     @endcan
</x-app-layout>