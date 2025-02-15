<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
        
    
    @can("project-list")
    <div class="container">
        <!-- Search Form -->
        <form method="GET" action="{{ route('projects.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un projet" value="{{ request()->search }}">
                <button type="submit" class="btn btn-danger"><i class="fas fa-search"></i></button>
            </div>
        </form>
    
        <!-- Create Button -->
        <div class="button-container mb-3">
            @can("project-create")
            <a href="{{ route('projects.create') }}" class="btn btn-custom">Créer un Nouveau Projet</a>
            @endcan
        </div>
    
        <h2 class="text-danger">Liste des Projets</h2>
    
        <!-- Projects Table -->
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Titre</th>
                    <th>Nom du Client</th>
                    <th>Ville</th>
                    <th>Besoins</th>
                    <th>Utilisateur</th>
                    <th>Date de Création</th>
                    <th>Actions</th>
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
                    <td class="td-action">
                        @can("project-show")
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm" title="Voir">
                            <i class="fa fa-eye"></i>
                        </a>
                        @endcan
    
                        @can("project-edit")
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                            <i class="fa fa-edit"></i>
                        </a>
                        @endcan
    
                        @can("project-delete")
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;" id="delete-form-{{$project->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $project->id }})" title="Supprimer">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
        <!-- Pagination -->
        <div class="d-flex justify-content-center my-4">
            <nav aria-label="Page navigation">
                {{ $projects->links('pagination.custom') }}
            </nav>
        </div>
    </div>
    
    <style>
        .btn-custom {
            background-color: #C2185B; /* Couleur personnalisée */
            color: white; /* Couleur du texte */
        }
    
        .btn-custom:hover {
            background-color: #D32F2F; /* Couleur au survol */
            color: white; /* Couleur du texte au survol */
        }
    
        .thead-dark th {
            background-color: #C2185B; /* Couleur d'arrière-plan de l'en-tête */
            color: white; /* Couleur du texte de l'en-tête */
        }
    
        h2.text-danger {
            color: #C2185B; /* Couleur du titre */
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                });
            @elseif (session('error'))
     Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                });
            @endif
        });
    </script>
    
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    @endcan
    </x-app-layout>