<!-- resources/views/reclamations/index.blade.php -->

<x-app-layout>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        h2 {
            color: #D32F2F;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .form-control {
            width: 400px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px 0 0 20px;
            font-size: 16px;
            outline: none;
        }

        .form-control:focus {
            border-color: #D32F2F;
        }

        .btn {
            background-color: #C2185B;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 0 20px 20px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #D32F2F;
        }

        .btn-primary {
            margin-bottom: 15px;
            background-color: #D32F2F;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #C2185B;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #FFF;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #C2185B;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px;
            border: 1px solid #EEE;
        }

        tr:nth-child(even) {
            background-color: #FFEFF3;
        }

        tr:hover {
            background-color: #FFCDD2;
            transition: background-color 0.3s ease-in-out;
        }

        .alert-success {
            background-color: #388E3C;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .pagination a {
            color: #D32F2F;
            text-decoration: none;
            padding: 8px 12px;
            border: 1px solid #D32F2F;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #D32F2F;
            color: white;
        }
        .btn-info {
            background-color: #1976D2;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .btn-warning {
            background-color: #FF9800;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .btn-danger {
            background-color: #D32F2F;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .btn-danger:hover {
            background-color: #C2185B;
        }
        td.td-action {
    display: flex;
    gap: 10px;
}

    </style>

    @can("reclamation-list")
        <!-- Search Form -->
        <form method="GET" action="{{ route('reclamations.index') }}" class="search-form">
            <input type="text" name="search" class="form-control" placeholder="Rechercher une réclamation..." value="{{ request('search') }}">
            <button type="submit" class="btn"><i class="fas fa-search"></i></button>
        </form>

        <!-- Create Button -->
        @can("reclamation-create")
            <a href="{{ route('reclamations.create') }}" class="btn btn-primary">Créer une Réclamation</a>
        @endcan

        <h2>Liste des Réclamations</h2>

        <!-- Success Message -->
       

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nom de l'utilisateur</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reclamations as $reclamation)
                    <tr>
                        <td>{{ $reclamation->user->name }}</td>
                        <td>{{ $reclamation->titre }}</td>
                        <td>{{ $reclamation->date }}</td>
                        <td>{{ $reclamation->description }}</td>
                        <td class="td-action">
                            @can("reclamation-show")
                            <a href="{{ route('reclamations.show', $reclamation->id) }}" class="btn btn-info" title="Voir"><i class="fa fa-eye"></i>
                            @endcan
                            @can("reclamation-edit")
                            <a href="{{ route('reclamations.edit', $reclamation->id) }}"class="btn btn-warning" title="Modifier"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can("reclamation-delete")
                            <form action="{{ route('reclamations.destroy', $reclamation->id) }}" method="POST" style="display: inline;" id="delete-form-{{ $reclamation->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $reclamation->id }})" title="Supprimer">
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
                {{ $reclamations->links('pagination.custom') }}
            </nav>
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
