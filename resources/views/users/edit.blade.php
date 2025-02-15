<x-app-layout>
    <style>
        /* Style général de la page */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #cedce7;
            background: linear-gradient(45deg, #cedce7 0%, #596a72 100%);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 39px;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            background: #cedce7;
    background: -webkit-linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: -o-linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: linear-gradient(178deg, #ff8080, #fdfcfc, #ff0e0e, #d53070);
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
       

        h2 {
            color: #D32F2F;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .pull-right a {
            background-color: #C34A64;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .pull-right a:hover {
            background-color: #D32F2F;
        }

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
            background-color: #fff;
        }

        .form-control:focus {
            border-color: #D32F2F;
            outline: none;
            box-shadow: 0 0 5px rgba(211, 47, 47, 0.5);
        }

        .btn-primary {
            background-color: #D32F2F;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #C34A64;
        }

        /* Pour mobile */
        @media (max-width: 768px) {
            h2 {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .div-flex {
                flex-direction: column;
            }
        }

        .div-flex {
            display: flex;
            gap: 30px;
            justify-content: space-between;
        }

        .div-flex .col-md-12 {
            flex: 1;
        }

        /* Style for the container */


/* Style for the form-group */


/* Style for the label */
.form-label {
    font-size: 16px;
    color: #333;
}

/* Style for the icon */
.icon-container {
    position: absolute;
    top: 12px;
    left: 12px;
    color: #D32F2F;
}

/* Style for the select dropdown */
.custom-select {
    width: 100%;
    padding: 10px 15px;
    padding-left: 35px; /* Space for the icon */
    border: 1px solid #D32F2F;
    border-radius: 4px;
    font-size: 16px;
    color: #555;
    background-color: #d63030;
    transition: border-color 0.3s ease;
}

/* Hover and focus effects */
.custom-select:hover, .custom-select:focus {
    border-color: #c34a64;
    box-shadow: 0 0 5px rgba(195, 74, 100, 0.5);
}

/* Style for the selected option text */
.custom-select option {
    color: #be2b2b;
}

    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier User</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('users.index') }}">Retour</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a eu quelques problèmes avec votre saisie.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
        
        <div class="row">
            <div class="div-flex">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Nom Complet:</strong>
                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Phone:</strong>
                        {!! Form::text('tele', null, ['placeholder' => 'Phone', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            
            <div class="div-flex">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Code:</strong>
                        {!! Form::number('code', null, ['placeholder' => 'Code', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Post:</strong>
                        {!! Form::text('poste', null, ['placeholder' => 'Post', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Address:</strong>
                        {!! Form::text('adresse', null, ['placeholder' => 'Address', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="div-flex">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Jour de repos:</strong>
                        {!! Form::text('repos', null, ['placeholder' => 'Day Off', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="cci">
                    <div class="form-group">
                        <strong>Role:</strong>
                        {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                    timer: 3000
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                    timer: 3000
                });
            @endif
        });
    </script>
    
</x-app-layout>
