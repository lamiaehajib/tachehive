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
.select2{
    width: 200px;
}
    </style>
    @can("project-edit")


    <div class="container">
        <h1>Modifier le Projet:{{ $project->name }}</h1>
        <div class="form-card">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="div-flex">
            <div class="form-group">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control" value="{{ $project->titre }}" required>
            </div>

            <div class="form-group">
                <label>Nom du Client</label>
                <input type="text" name="nomclient" class="form-control" value="{{ $project->nomclient }}" required>
            </div>

            <div class="form-group">
                <label>Ville</label>
                <input type="text" name="ville" class="form-control" value="{{ $project->ville }}" required>
            </div>
            </div>
           
            <div class="div-flex">
            <div class="form-group">
                <label>Utilisateur</label><br>
                <select name="iduser[]" class="form-control select2" multiple required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ in_array($user->id, $project->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Date du Projet</label>
                <input type="date" name="date_project" class="form-control" value="{{ $project->date_project }}" required>
            </div>
            </div>

            <div class="form-group">
                <label>Besoins</label>
                <textarea name="bessoins" class="form-control" required>{{ $project->bessoins }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
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
