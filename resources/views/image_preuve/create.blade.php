{{-- resources/views/image_preuve/create.blade.php --}}
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
  margin-top: 20px !important;
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


    <div class="container">
        <h1 class="mb-4">Ajouter une nouvelle image preuve</h1>
        <div class="form-card">
        <form action="{{ route('image_preuve.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="div-flex">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            </div>
            <div class="div-flex">
                <div class="form-group">
                    <label for="iduser">Utilisateur</label>
                     @if(auth()->user()->hasRole('Admin'))
                      <select name="iduser" id="iduser" class="form-control" required>
                          @foreach($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endforeach
                      </select>
                     @else
                      <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                     @endif
              </div>

              <div class="form-group">
                <label for="media">Image ou Vidéo</label>
                <input type="file" id="media" name="media" class="form-control" required>
                <small class="form-text text-muted">Formats supportés: jpeg, png, jpg, gif, svg, mp4, mkv, avi, mov</small>
            </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            
           
            
            
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        </div>
    </div>
</x-app-layout>
