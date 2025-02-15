<!-- resources/views/objectifs/show.blade.php -->

<x-app-layout>
    <style>
        /* Global Style */
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

    @can("objectif-show")
    <div class="details-container">
        <h1>Détails de l'Objectif</h1>
        <p><strong>Date:</strong> {{ $objectif->date }}</p>
        <p><strong>Type:</strong> {{ $objectif->type }}</p>
        <p><strong>Description:</strong> {{ $objectif->description }}</p>
        <p><strong>Chiffre d'affaire:</strong> {{ $objectif->ca }} a {{ $objectif->status }}</p>
        
        <p><strong>À faire:</strong> {{ $objectif->afaire }}</p>
        <p><strong>Utilisateur:</strong> {{ $objectif->user->name }}</p>

        <a href="{{ route('objectifs.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
    @endcan
</x-app-layout>
