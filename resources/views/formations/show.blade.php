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
    @can("formation-show")
    <div class="details-container">
        <h2>Formation : {{ $formation->name }}</h2>
    
        <!-- Vérification d'accès -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    
        <!-- Affichage des détails de la formation -->
        <div class="card mt-4">
            
            <div class="card-body">
                
                <p><strong>Status :</strong> {{ $formation->status }}</p>
                <p><strong>Formateur :</strong> {{ $formation->nomformateur }}</p>
                <p><strong>Date :</strong> {{ $formation->date }}</p>
                
                <!-- Affichage du fichier associé (si disponible) -->
                @if($formation->file_path)
                    <p><strong>Fichier :</strong> <a href="{{ Storage::url($formation->file_path) }}" target="_blank">Télécharger le fichier</a></p>
                @else
                    <p>Aucun fichier associé.</p>
                @endif
    
                <!-- Affichage des utilisateurs associés -->
                <h5>Utilisateurs associés :</h5>
                <ul>
                    @foreach($formation->users as $user)
                        <li>{{ $user->name }}</li>
                    @endforeach
                </ul>
    
                <div class="mt-4">
                    <a href="{{ route('formations.index') }}" class="btn btn-secondary">Retour à la liste des formations</a>
                </div>
            </div>
        </div>
    </div>
    @endcan
</x-app-layout>