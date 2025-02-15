<x-app-layout>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #ffb3b3, #ff9393);
            color: #333;
        }
    
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 20px auto;
        }
    
        form textarea, form input, form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    
        form button {
            background: linear-gradient(120deg, #C2185B, #D32F2F);
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    
        form button:hover {
            background-color: #C2185B;
        }
    
        h2 {
            text-align: center;
            color: #444;
        }
    
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
    
        table thead {
            background-color: #C2185B;
            color: white;
        }
    
        table thead th {
            padding: 15px;
            text-align: left;
        }
    
        table tbody tr {
            border-bottom: 1px solid #ddd;
        }
    
        table tbody td {
            padding: 15px;
        }
    
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
    
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
    
        .pagination a, .pagination span {
            margin: 0 5px;
            padding: 10px 15px;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
            color: #D32F2F;
            border-radius: 5px;
        }
    
        .pagination .active {
            background-color: #D32F2F;
            color: #fff;
        }
    
        .pagination a:hover {
            background-color: #C2185B;
            color: #fff;
        }
        .text-editor {
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
  position: relative;
}

.text-editor textarea {
  width: 100%;
  height: 200px;
  border: 2px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  font-size: 16px;
  line-height: 1.5;
  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
  resize: vertical;
  outline: none;
  transition: border-color 0.3s;
}

.text-editor textarea:focus {
  border-color: #007bff;
  box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
}

.toolbar {
  display: flex;
  justify-content: flex-start;
  gap: 10px;
  margin-top: 10px;
}

.toolbar button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
  transition: background-color 0.3s;
}

.toolbar button:hover {
  background-color: #0056b3;
}






    </style>
    
    @can("pointage-show")
<div>
<form action="{{ route('suivre_pointage.pointer') }}" method="POST">
@csrf
        @if ($currentPointage && !$currentPointage->heure_depart)
            <!-- إذا كانت هناك نقطة وصول ولم يتم تسجيل ساعة المغادرة بعد -->
            <div class="mb-3">
                <label for="description" class="form-label">Description de la journée</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="localisation" class="form-label">localisation</label>
                 <!-- Hidden field to store the location -->
            <input type="hidden" name="localisation" id="localisation" value="">

            </div>
        @endif

        @if ($currentPointage && !$currentPointage->heure_depart)
            <!-- زر تسجيل ساعة المغادرة -->
            <button type="submit" class="btn btn-danger"> Pointer Départ</button>
        @else
            <!-- زر تسجيل ساعة الوصول -->
            <button type="submit" class="btn btn-success">Pointer Arrivée</button>
        @endif
    </form>


</div>
@endcan

    @can("pointage-list")
    <div>
        
        <h2>Liste des Pointages</h2>
        <div>
            <form action="{{ route('suivre_pointage.index') }}" method="GET">
                <input type="text" name="search" placeholder="Rechercher par nom ou date" value="{{ request('search') }}">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nom de l'utilisateur</th>
                    <th>Date</th>
                    <th> Pointer Arrivée</th>
                    <th>Heure de départ</th>
                    <th>Description</th>
                    <th>Localisation</th> <!-- Display location -->
                </tr>
            </thead>
            <tbody>
                @foreach ($pointages as $pointage)
                    <tr>
                        <td>{{ $pointage->user->name }}</td>
                        <td>{{ $pointage->created_at->format('d-m-Y') }}</td>

                        <td 
    @if ($pointage->heure_arrivee && $pointage->heure_arrivee->format('H:i') < '17:30') 
        style="background-color: #f8d7da; color: #721c24;" 
        data-type="depart-tot" 
        data-pointe="true"
    @endif
>
    {{ $pointage->heure_arrivee ? $pointage->heure_arrivee->timezone('Africa/Casablanca')->format('H:i') : 'Non défini' }}
</td>
                        <td 
    @if ($pointage->heure_depart && $pointage->heure_depart->format('H:i') > '09:15') 
        style="background-color: #f8d7da; color: #721c24;" 
        data-type="retard" 
        data-pointe="true"
    @endif
>
    {{ $pointage->heure_depart ? $pointage->heure_depart->timezone('Africa/Casablanca')->format('H:i') : 'Non défini' }}
</td>

                   
                        <td>{{ $pointage->description ?? 'Aucune' }}</td>
                        {{-- <td>@php
                            $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::DECIMAL);
                            $localizedNumber = $formatter->format($pointage->localisation);

                        @endphp {{ $localizedNumber}}</td> <!-- Display the location here --> --}}
                        <td>{{ $pointage->localisation ?? 'Non défini' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
    document.getElementById('pointageForm').addEventListener('submit', function (e) {
    e.preventDefault();

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            document.getElementById('localisation').value = position.coords.latitude + ',' + position.coords.longitude;
            e.target.submit();
        }, function () {
            alert("تعذر الوصول إلى الموقع.");
            e.target.submit();
        });
    } else {
        alert("المتصفح لا يدعم تحديد الموقع.");
        e.target.submit();
    }
});


    </script>

    <script>
        document.getElementById('pointageForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission for now

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    // Get latitude and longitude
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Set the location in the hidden input
                    document.getElementById('localisation').value = latitude + ',' + longitude;

                    // Now submit the form
                    e.target.submit();
                }, function () {
                    alert("Location access denied or unavailable");
                    e.target.submit(); // Submit the form even if location is not available
                });
            } else {
                alert("Geolocation is not supported by this browser.");
                e.target.submit(); // Submit the form if geolocation is not supported
            }
        });
    </script>
   
    
    <script>
        document.getElementById('pointageForm').addEventListener('submit', function (e) {
            const button = this.querySelector('button');
            button.textContent = 'Veuillez patienter...';
            button.style.backgroundColor = '#ffc107'; // Change button color to indicate waiting
    
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
    
                    document.getElementById('localisation').value = latitude + ',' + longitude;
    
                    e.target.submit();
                }, function () {
                    alert("Accès à la localisation refusé ou indisponible.");
                    e.target.submit();
                });
            } else {
                alert("Géolocalisation non supportée par ce navigateur.");
                e.target.submit();
            }
        });
    
        // Add alternating row colors in the table
        const rows = document.querySelectorAll('table tbody tr');
        rows.forEach((row, index) => {
            if (index % 2 === 0) {
                row.style.backgroundColor = '#f9f9f9';
            }
        });


        
    </script>
   

    
     
    <div class="d-flex justify-content-center my-4">
        <nav aria-label="Page navigation">
            {{ $pointages->links('pagination.custom') }}
        </nav>
    </div>
    
     @endcan
</x-app-layout>
