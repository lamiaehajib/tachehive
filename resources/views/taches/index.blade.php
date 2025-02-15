<x-app-layout>
    <style>
        .text-center{
            display: flex;
            gap: 20px;
            justify-content: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
        @can("tache-list")
        <div class="container py-5">
            <!-- Formulaire de recherche -->
            <form action="{{ route('taches.index') }}" method="GET" class="search-form d-flex mb-4">
                <input type="text" name="search" class="form-control me-2" placeholder="Rechercher par description ou statut" value="{{ request('search') }}">
                <button type="submit" class="btn text-white" style="background-color: #C2185B;"><i class="fas fa-search"></i></button>
            </form>
    
            <!-- Bouton de création -->
            @can("tache-create")
            <a href="{{ route('taches.create') }}" class="btn text-white mb-3" style="background-color: #D32F2F;">Créer une nouvelle tâche</a>
            @endcan
    
            <!-- Titre de la page -->
            <h2 class="mb-4" style="color: #D32F2F;">Liste des Tâches</h2>
    
            <!-- Tableau des tâches -->
            <table class="table table-bordered shadow">
                <thead class="text-white" style="background-color: #C2185B;">
                    <tr>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Durée</th>
                        <th>Date Début</th>
                        <th>Assigné(e) à</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taches as $tache)
                    <tr>
                        <td>{{ $tache->description }}</td>
                        <td>{{ $tache->status }}</td>
                        <td>{{ $tache->duree }}</td>
                        <td>{{ $tache->datedebut }}</td>
                        <td>{{ $tache->user->name }}</td>
                        <td class="text-center">
                            @can("tache-show")
                            <a href="{{ route('taches.show', $tache->id) }}" class="btn btn-sm text-white me-1" style="background-color: #C2185B;" title="Voir">
                                <i class="fa fa-eye"></i>
                            </a>
                            @endcan
                            @can("tache-edit")
                            <a href="{{ route('taches.edit', $tache->id) }}" class="btn btn-sm text-white me-1" style="background-color: #FFC107;" title="Modifier">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endcan
                            @can("tache-delete")
                            <form action="{{ route('taches.destroy', $tache->id) }}" method="POST" class="d-inline" id="delete-form-{{ $tache->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm text-white" style="background-color: #D32F2F;" onclick="confirmDelete({{ $tache->id }})" title="Supprimer">
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
                    {{ $taches->links('pagination.custom') }}
                </nav>
            </div>
        </div>
    
        <!-- Scripts -->
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
    
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#D32F2F',
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