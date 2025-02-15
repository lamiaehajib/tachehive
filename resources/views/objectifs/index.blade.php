<x-app-layout>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@can("objectif-list")
<div class="container my-4 p-4 border rounded" style="background-color: #f8f9fa;">
    <form action="{{ route('objectifs.index') }}" method="GET" class="search-form d-flex mb-4">
        <input type="text" name="search" class="form-control me-2" placeholder="Rechercher..." value="{{ request('search') }}">
        <button type="submit" class="btn text-white" style="background-color: #D32F2F;">
            <i class="fas fa-search"></i>
        </button>
    </form>
    
    @can("objectif-create")
        <div class="text-end mb-4">
            <a href="{{ route('objectifs.create') }}" class="btn text-white" style="background-color: #C2185B;">
                Créer un nouvel Objectif
            </a>
        </div>
    @endcan

    <h2 class="mb-4 text-center text-white p-2 rounded" style="background-color: #C2185B;">Liste des Objectifs</h2>

    <table class="table table-striped table-hover">
        <thead class="text-white" style="background-color: #D32F2F;">
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Description</th>
                <th>Chiffre d'affaire</th>
                <th>Utilisateur</th>
                <th>À faire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($objectifs as $objectif)
                <tr>
                    <td>{{ $objectif->date }}</td>
                    <td>{{ $objectif->type }}</td>
                    <td>{{ $objectif->description }}</td>
                    <td>{{ $objectif->ca }} - {{ $objectif->status }}</td>
                    <td>{{ $objectif->user->name }}</td>
                    <td>{{ $objectif->afaire }}</td>
                    <td>
                        @can("objectif-show")
                            <a href="{{ route('objectifs.show', $objectif->id) }}" class="btn btn-info btn-sm" title="Voir">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endcan
                        @can("objectif-edit")
                            <a href="{{ route('objectifs.edit', $objectif->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                        @can("objectif-delete")
                            <form action="{{ route('objectifs.destroy', $objectif->id) }}" method="POST" style="display: inline;" id="delete-form-{{$objectif->id}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $objectif->id }})" title="Supprimer">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="d-flex justify-content-center my-4">
        <nav aria-label="Page navigation">
            {{ $objectifs->links('pagination.custom') }}
        </nav>
    </div>
</div>


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
                        // Soumettre le formulaire si l'utilisateur confirme
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endcan
</x-app-layout>