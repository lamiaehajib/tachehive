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
    </style>
     @can("formation-create")
     <h1>Créer une Nouvelle Formation</h1>
     <div class="form-card">
        
    
       
      <form action="{{ route('formations.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="div-flex">
              <!-- Nom de la formation -->
              <div class="form-group">
                  <label for="name">Nom de la formation</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
      
              <!-- Statut -->
              <div class="form-group">
                  <label for="statut">Status</label>
                  <select name="statut" id="statut" class="form-control @error('statut') is-invalid @enderror" required>
                      <option value="nouveu" {{ old('statut') == 'nouveu' ? 'selected' : '' }}>Nouveau</option>
                      <option value="encour" {{ old('statut') == 'encour' ? 'selected' : '' }}>En cours</option>
                      <option value="fini" {{ old('statut') == 'fini' ? 'selected' : '' }}>Fini</option>
  
                      
                  </select>
                  @error('statut')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
      
              <!-- Nom du formateur -->
              <div class="form-group">
                  <label for="nomformateur">Nom du formateur</label>
                  <input type="text" name="nomformateur" id="nomformateur" class="form-control @error('nomformateur') is-invalid @enderror" value="{{ old('nomformateur') }}" required>
                  @error('nomformateur')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
          <div class="div-flex">
              <!-- Nombre d'heures -->
              <div class="form-group">
                  <label for="nombre_heures">Nombre d'heures</label>
                  <input type="number" name="nombre_heures" id="nombre_heures" class="form-control @error('nombre_heures') is-invalid @enderror" value="{{ old('nombre_heures') }}" required>
                  @error('nombre_heures')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
      
              <!-- Nombre de séances -->
              <div class="form-group">
                  <label for="nombre_seances">Nombre de séances</label>
                  <input type="number" name="nombre_seances" id="nombre_seances" class="form-control @error('nombre_seances') is-invalid @enderror" value="{{ old('nombre_seances') }}" required>
                  @error('nombre_seances')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="status">Type</label>
                  <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                      <option value="en ligne" {{ old('status') == 'en ligne' ? 'selected' : '' }}>En ligne</option>
                      <option value="lieu" {{ old('status') == 'lieu' ? 'selected' : '' }}>Lieu</option>
                  </select>
                  @error('status')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
      
          <div class="div-flex">
              <!-- Prix -->
              <div class="form-group">
                  <label for="prix">Prix</label>
                  <input type="number" step="0.01" name="prix" id="prix" class="form-control @error('prix') is-invalid @enderror" value="{{ old('prix') }}" required>
                  @error('prix')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
      
              <!-- Durée -->
              <div class="form-group">
                  <label for="duree">Durée</label>
                  <input type="number" name="duree" id="duree" class="form-control @error('duree') is-invalid @enderror" value="{{ old('duree') }}" required>
                  @error('duree')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
      
          <!-- Utilisateurs associés -->
          <div class="form-group">
              <label for="iduser">Utilisateurs associés</label>
              <select name="iduser[]" id="iduser" class="form-control @error('iduser') is-invalid @enderror" multiple required>
                  @foreach($users as $user)
                      <option value="{{ $user->id }}" {{ in_array($user->id, old('iduser', [])) ? 'selected' : '' }}>{{ $user->name }}</option>
                  @endforeach
              </select>
              @error('iduser')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      
          <!-- Date de la formation -->
          <div class="form-group">
              <label for="date">Date de la formation</label>
              <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
              @error('date')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      
          <!-- Fichier de formation -->
          <div class="form-group">
              <label for="file">Fichier d'emploi du temps (optionnel)</label>
              <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf, .doc, .docx, .png, .mp4">
              @error('file')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      
          <!-- Bouton de soumission -->
          <button type="submit" class="btn btn-primary">Créer la formation</button>
      </form>
      
    </div>
    <script>
        // $(document).ready(function() {
        //     $('.select2').select2({
        //         placeholder: "Sélectionnez des utilisateurs",
        //         allowClear: true
        //     });
        // });
  
        $(document).ready(function() {
          // Initialiser Select2 pour l'élément select
          $('#iduser').select2({
              placeholder: 'Sélectionner des utilisateurs',
              width: '100%', // Adapte la largeur
              allowClear: true // Permet de réinitialiser la sélection
          });
      });
    </script>
     @endcan
  </x-app-layout>