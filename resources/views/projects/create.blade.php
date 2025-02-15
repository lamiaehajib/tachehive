<x-app-layout>
    <style>
       
       h1 {
            color: #c34a64;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }
       

        .form-group label {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .form-control {
            border: 2px solid #c34a64;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #D32F2F;
            box-shadow: 0 0 5px rgba(211, 47, 47, 0.5);
        }

        .form-control::placeholder {
            color: #888;
        }

        .btn-primary {
            background-color: #c34a64;
            border-color: #c34a64;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #D32F2F;
            border-color: #D32F2F;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-danger ul {
            list-style-type: none;
            padding: 0;
        }

        .alert-danger li {
            margin: 5px 0;
        }

        select.form-control {
            height: 40px;
        }

        textarea.form-control {
            height: 150px;
            resize: vertical;
        }
        .div-flex{
            display: flex;
            gap: 67px;
        }
        #status{
            position: absolute;
    width: auto;
    margin-top: -14px !important;
}
  

  
/* Global Style */
body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
}

/* Card Container */
.form-card {
  max-width: 600px;
  margin: 50px auto;
  background: #cedce7;
    background: -webkit-linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: -o-linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: linear-gradient(45deg,  #cedce7 0%,#596a72 100%);
    background: linear-gradient(178deg, #ff8080, #fdfcfc, #ff0e0e, #d53070);
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 20px;
  overflow: hidden;
  position: relative;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.form-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

/* Form Group */
.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
  color: #333;
}

input,
textarea,
select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 16px;
  box-sizing: border-box;
}

textarea {
  resize: vertical;
}

/* Button */
.btn-primary {
  background-color: #e63946;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #d62839;
}

/* Flex Container */
.div-flex {
  display: flex;
  gap: 15px;
  justify-content: center;
}

/* Animation */
.animated-form {
  animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
  form{
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
#stat{

}
    </style>
     @can("project-create")
   
        <h1>Créer un Nouveau Projet</h1>
        <div class="form-card">
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="div-flex">
            <div class="form-group">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control" required>
            </div>

            
            <div class="form-group">
                <label>Nom du Client</label>
                <input type="text" name="nomclient" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Ville</label>
                <input type="text" name="ville" class="form-control" required>
            </div>
            </div>
            <div class="div-flex" id="cad-flex">
            

            <div class="form-group">
                <label>Utilisateur</label>
                <select name="iduser[]" class="form-control select2" multiple="multiple" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
             <div class="form-group" >
                <label >Date du Projet</label><br>
                <input type="date" name="date_project" id="status"   class="form-control" required>
             </div>

            
            </div>

            <div class="form-group">
                <label>Besoins</label>
                <textarea name="bessoins" class="form-control" required></textarea>
            </div>

           

            

            <button type="submit" class="btn btn-primary mt-3">Créer le Projet</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Sélectionnez des utilisateurs",
                allowClear: true
            });
        });
    </script>
     @endcan
</x-app-layout>
