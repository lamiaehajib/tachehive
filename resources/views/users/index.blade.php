<x-app-layout>
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-4">
        <!-- Titre principal -->
        <div class="text-center mb-4">
            <h2 class="text-danger">Équipe</h2>
        </div>

        <!-- Barre de recherche -->
        <form method="GET" action="{{ route('users.index') }}" class="d-flex justify-content-center mb-4">
            <div class="input-group" style="max-width: 600px;">
                <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <!-- Bouton Créer un nouvel utilisateur -->
        <div class="text-center mb-4">
            <a class="btn btn-danger" href="{{ route('users.create') }}">Créer un nouvel utilisateur</a>
        </div>

        <!-- Table des utilisateurs -->
        <table class="table table-bordered">
            <thead class="table-danger">
                <tr>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Code</th>
                    <th>Poste</th>
                    <th>Adresse</th>
                    <th>Repos</th>
                    <th>Rôles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->tele }}</td>
                        <td>{{ $user->code }}</td>
                        <td>{{ $user->poste }}</td>
                        <td>{{ $user->adresse }}</td>
                        <td>{{ $user->repos }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <span class="badge bg-success">{{ $v }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center d-flex justify-content-center gap-2">
                            <a class="btn btn-info text-white btn-sm" href="{{ route('users.show',$user->id) }}" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-warning text-white btn-sm" href="{{ route('users.edit',$user->id) }}" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            @can('user-delete')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style'=>'display:inline', 'id' => 'delete-form-'.$user->id ]) !!}
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id }})" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $data->links('pagination.custom') }}
        </div>
    </div>

    <!-- SweetAlert pour les messages de succès et d'erreur -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>