<x-app-layout>
    @can("tache-show")
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
    <div class="details-container">

        <h1>Détails de la Tâche</h1>
    
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Description : {{ $tache->description }}</h5>
               
                <p class="card-text"><strong>Date début :</strong> {{ $tache->datedebut }}</p>
                <p class="card-text"><strong>Status :</strong> {{ $tache->status }}</p>
                <p class="card-text"><strong>Période :</strong> {{ $tache->duree }}  {{ $tache->date }}</p>
                
                {{-- Vérifie si l'utilisateur est disponible --}}
                
                
                
                <a href="{{ route('taches.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
    @endcan
</x-app-layout>
