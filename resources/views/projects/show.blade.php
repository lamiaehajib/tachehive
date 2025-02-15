<!-- resources/views/projects/show.blade.php -->
<x-app-layout>
    <style>
        body {
           font-family: Arial, sans-serif;
           background-color: #f9f9f9;
           margin: 0;
           padding: 20px;
       }

       h1 {
           color: #D32F2F;
           font-size: 2.5em;
           margin-bottom: 20px;
           text-align: center;
           border-bottom: 3px solid #C2185B;
           display: inline-block;
           padding-bottom: 10px;
       }

       .details-container {
           background-color: #fff;
           padding: 20px;
           border-radius: 10px;
           box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
           max-width: 600px;
           margin: 0 auto;
       }

       .details-container p {
           font-size: 1.1em;
           color: #555;
           margin: 10px 0;
       }

       .details-container p strong {
           color: #D32F2F;
       }

       .btn-secondary {
           display: inline-block;
           margin-top: 20px;
           padding: 10px 20px;
           background-color: #C2185B;
           color: #fff;
           text-decoration: none;
           border-radius: 5px;
           font-weight: bold;
           transition: background-color 0.3s ease;
           text-align: center;
       }

       .btn-secondary:hover {
           background-color: #D32F2F;
       }
   </style>
    @can("project-show")
    <div class="details-container">
        <h1>Détails du Projet</h1>
    
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Titre : {{ $project->titre }}</h5>
                <p><strong>Nom du Client :</strong> {{ $project->nomclient }}</p>
                <p><strong>Ville :</strong> {{ $project->ville }}</p>
                <p><strong>Besoins :</strong> {{ $project->bessoins }}</p>
                <h2>Utilisateurs Associés</h2>
                   <ul>
                   @foreach($project->users as $user)
                         <li>{{ $user->name }}</li>
                     @endforeach
                    </ul>
    
                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Modifier</a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce projet ?')">Supprimer</button>
                </form>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
    @endcan
</x-app-layout>
