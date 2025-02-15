<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
        <style>
          
    
            /* ------------------------- TITRES ET HEADER ------------------------- */
            .header {
                background: #cedce7;
        background: -webkit-linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
        background: -o-linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
        background: linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
        background: linear-gradient(178deg, #C2185B,  #D32F2F, #D32F2F, #C2185B); /* Rouge vif */
                color: white;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                width: 100% !important;
                
            }
    
            .header h1 {
                width: 100%;
                font-family: 'Arial', sans-serif;
                font-size: 1.8em;
                font-weight: bold;
                color: linear-gradient(178deg, #ef2f96, #ad2fed, #ad2fed, #d53070) !important;
                text-transform: uppercase;
            }
    
            .header .date-jour {
                font-family: 'Roboto', sans-serif;
                font-size: 1.2em;
                color: #FFEBEE; /* Rouge pâle */
            }
    
            h3 {
                color: #D32F2F; /* Rouge vif */
                font-family: 'Roboto', sans-serif;
                font-weight: bold;
                margin-top: 20px;
            }
    
            .h-user {
                font-size: 1.5em;
                color: #130f0f;
                background-color: #f9ecef;
                padding: 10px 20px;
                border-radius: 8px;
                text-align: center;
                margin: 20px 0;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
    
            .strong-user {
                color: #871818;
                font-weight: bold;
            }
    
            /* ------------------------- TABLES ------------------------- */
           
            /* ------------------------- BOUTONS ------------------------- */
            .btn-secondary {
                background-color: #C2185B;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                font-size: 1em;
                cursor: pointer;
                transition: background-color 0.3s ease-in-out;
            }
    
            .btn-secondary:hover {
                background-color: #D32F2F;
            }
    
            /* ------------------------- FORMULAIRE ------------------------- */
            /* Style de la boîte de recherche */
            .search-box {
                
        display: flex;
        align-items: center;
        
        
        justify-content: center
    }
    
    .input-recherche {
        width: 400px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 20px 0 0 20px;
        outline: none;
        transition: border-color 0.3s;
        border: none;
        border-radius: 20px 0 0 20px;
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s;
    }
    
    .input-recherche:focus {
        border-color: #b3424b;
    }
    
    .btn-search {
        background-color: #51040487;
            color: #D32F2F;
            border: none;
            padding: 10px 15px;
            border-radius: 0 20px 20px 0;
            cursor: pointer;
            height: 38px; 
            transition: background-color 0.3s ease;
    }
    /* background-color: black;
        border: none;
        color: white;
        padding: 10px 15px;
        border-radius: 0 20px 20px 0;
        cursor: pointer;
        transition: background-color 0.3s ease;
        height: 38px;
        width: 42px; */
    
    
    .btn-search:hover {
        background-color: #b3425c;
        width: 70px;
    }
    
    .btn-search i {
        font-size: 19px;
        color: #ffffff;
        transition: transform 0.3s ease, color 0.3s ease;
    }
    
    /* Effet de hover avec rotation et agrandissement */
    .btn-search:hover i {
        transform: scale(1.2) rotate(20deg); /* Agrandir et faire pivoter légèrement */
        color: #ffe8e8; /* Couleur de l'icône légèrement différente */
    }
    #table-tache{
    margin-top: 21px !important;
    }
    .tache-h{
        
        margin-top: 76px !important;
        
    }
    .pagination {
        display: flex;
        gap: 8px;
    }
    
    .pagination .page-item .page-link {
        color: #c34a64; /* Base color */
        background-color: #f8f9fa; /* Background color */
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #c34a64; /* Active background color */
        color: white; /* Active text color */
        border: 1px solid #c34a64;
    }
    
    .pagination .page-item .page-link:hover {
        background-color: #b3425c; /* Hover background color */
        color: white; /* Hover text color */
        border-color: #b3425c;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #c34a64; /* Base color */
        background-color: #f8f9fa; /* Background color */
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 8px 12px;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        border-radius: 50%; /* Rounded corners for first and last page buttons */
    }
    
    .pagination .page-item .page-link {
        box-shadow: none; /* Ensure no box shadow */
    }
    
    .pagination .page-item.disabled {
        display: none !important; /* Hide disabled items (dots) */
    }
    
    
    
    
    
    
    
    
    
    .testml {
    display: flex;
    justify-content: center;
    width: 90%;
    margin-left: 135px;
}
    
        
        </style>
    
            
          
     
            <div class="header">
               
                <h1 class="font-semibold">
                    <?php
                        $hour = \Carbon\Carbon::now()->format('H');
                        $greeting = ($hour >= 6 && $hour < 19) ? 'Bonjour' : 'Bonsoir';
                    ?>
                    {{ $greeting }}, {{ Auth::user()->name }}
                </h2>
                
                @php
                \Carbon\Carbon::setLocale('fr');
                @endphp
                <h3 class="date-jour">{{ \Carbon\Carbon::now()->translatedFormat('l, d/m/Y') }}</h3>
                <div class="d-flex justify-content-center mb-4">
                    <form action="{{ route('dashboard') }}" method="GET">
                        <div class="input-group search-box">
                            <input class="input-recherche" type="text" name="search" placeholder="Rechercher..." value="{{ request()->get('search') }}">
                            <button class="btn-search" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
    
            @can("user-list")
            <h3 class="h-user"><strong class="strong-user">Effectif de l’équipe UITS.:</strong> {{ $userCount }}</h3>
            @endcan
            <!-- Tasks Table -->
            
            @can("tache-list")
        <h3 >Liste des Tâches</h3>
        <div class="testml">
        <table id="table-tache" class="table table-bordered">
            <thead class="bg-danger text-white">
                <tr>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Duree</th>
                    <th>Date debut</th>
                    <th>Assigné(e)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $tache)
                    <tr>
                        <td>{{ $tache->description }}</td>
                        <td>{{ $tache->status }}</td>
                        <td>{{ $tache->duree }} {{ $tache->date }}</td>
                        <td>{{ $tache->datedebut }}</td>
                        <td>{{ $tache->user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="d-flex justify-content-center my-4">
            <nav aria-label="Page navigation">
                {{ $tasks->links('pagination.custom') }}
            </nav>
        </div>
    @endcan
    
    @can("project-list")
        <h3 >Liste des Projects</h3>
        <div class="testml">
        <table class="table table-bordered">
            <thead class="bg-danger text-white">
                <tr>
                    <th>Titre</th>
                    <th>Nom du Client</th>
                    <th>Ville</th>
                    <th>Besoins</th>
                    <th>Assignées</th>
                    <th>Date de Création</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->titre }}</td>
                        <td>{{ $project->nomclient }}</td>
                        <td>{{ $project->ville }}</td>
                        <td>{{ $project->bessoins }}</td>
                        <td>
                            @foreach($project->users as $user)
                                {{ $user->name }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </td>
                        <td>{{ $project->date_project }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="d-flex justify-content-center my-4">
            <nav aria-label="Page navigation">
                {{ $projects->links('pagination.custom') }}
            </nav>
        </div>
    @endcan
    
    @can("formation-list")
        <h3 >Liste des Formations</h3>
        <div class="testml">
        <table class="table table-bordered">
            <thead class="bg-danger text-white">
                <tr>
                    <th>Nom</th>
                    <th>Status</th>
                    <th>Nom Formateur</th>
                    <th>Date</th>
                    <th>Durée</th>
                    <th>Assignées</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formations as $formation)
                    <tr>
                        <td>{{ $formation->name }}</td>
                        <td>{{ $formation->status }}</td>
                        <td>{{ $formation->nomformateur }}</td>
                        <td>{{ $formation->date }}</td>
                        <td>
                            @if($formation->file_path)
                                <a href="{{ Storage::url($formation->file_path) }}" title="Télécharger" target="_blank">
                                    <i class="fa fa-download"></i>
                                </a>
                            @else
                                Pas de fichier
                            @endif
                        </td>
                        <td>
                            @foreach($formation->users as $user)
                                {{ $user->name }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="d-flex justify-content-center my-4">
            <nav aria-label="Page navigation">
                {{ $formations->links('pagination.custom') }}
            </nav>
        </div>
    @endcan
    
   
    
    
    </x-app-layout>