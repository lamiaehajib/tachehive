<x-app-layout>
    <style>
        .text-center{
            display: flex;
            gap: 20px;
            justify-content: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
        @can("formation-list")
        <div class="container my-4 p-4 rounded shadow" style="background-color: #f8f9fa;">
            <form method="GET" action="{{ route('formations.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher une formation" value="{{ request()->get('search') }}">
                    <button type="submit" class="btn text-white" style="background-color: #C2185B;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
    
            <div class="mb-4 text-end">
                @can("formation-create")
                <a href="{{ route('formations.create') }}" class="btn text-white" style="background-color: #D32F2F;">
                    <i class="fas fa-plus"></i> Créer une Nouvelle Formation
                </a>
                @endcan
            </div>
    
            <h2 class="mb-4" style="color: #C2185B;">Liste des Formations</h2>
            
            <table class="table table-bordered">
                <thead style="background-color: #D32F2F; color: white;">
                    <tr>
                        <th>Nom</th>
                        <th>Status</th>
                        <th>Nom Formateur</th>
                        <th>Date</th>
                        <th>Emploi du Temps</th>
                        <th>Utilisateur</th>
                        <th>Actions</th>
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
                            <a href="{{ Storage::url($formation->file_path) }}" title="Télécharger" target="_blank" class="text-decoration-none" style="color: #C2185B;">
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
                        <td class="text-center">
                            @can("formation-show")
                            <a href="{{ route('formations.show', $formation->id) }}" class="btn btn-info btn-sm" title="Voir">
                                <i class="fa fa-eye"></i>
                            </a>
                            @endcan
                            @can("formation-edit")
                            <a href="{{ route('formations.edit', $formation->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endcan
                            @can("formation-delete")
                            <button type="button" class="btn btn-danger btn-sm" title="Supprimer" onclick="confirmDelete({{ $formation->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $formation->id }}" action="{{ route('formations.destroy', $formation->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
            <div class="d-flex justify-content-center my-4">
                <nav>
                    {{ $formations->links('pagination.custom') }}
                </nav>
            </div>
        </div>
    
        <!-- SweetAlert scripts -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#D32F2F',
                });
                @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#D32F2F',
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
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
        @endcan
    </x-app-layout>