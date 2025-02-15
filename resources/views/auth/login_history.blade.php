<x-app-layout>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h3 {
            font-size: 24px;
            color: #333;
            margin: 20px 0;
            text-align: center;
        }

        table {
            
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 20px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #d82e34;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }

        td span {
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .green {
            color: green;
        }

        .red {
            color: red;
        }
        h3 {
    font-size: 28px;
    color: #f04242;
    font-weight: bold;
    text-align: center;
   
    letter-spacing: 2px;
    margin-bottom: 20px;
}


form {
    
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 200px;
            max-height: 212px;
            margin-top: 21px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="date"]:focus {
            border-color: #5d9cec;
            outline: none;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #f43c3c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #aa3b46;
        }
        .div-flex{
            display: flex;
            gap: 30px;
        }

    </style>

    <h3>Historique des connexions</h3>
    <div class="div-flex">
    <form method="GET" action="{{ route('login.history') }}">
        <div>
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" id="username" value="{{ request('username') }}">
        </div>
        <div>
            <label for="date">Date :</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}">
        </div>
        <button type="submit">Rechercher</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Jour</th>
                <th>Utilisateur</th>
                <th>Heure de Connexion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                @php
                    $dayOfWeek = \Carbon\Carbon::parse($log->logged_in_at)->locale('fr')->dayName;
                @endphp
                <tr>
                    <td>{{ ucfirst($dayOfWeek) }} ({{ \Carbon\Carbon::parse($log->logged_in_at)->format('d/m/Y') }})</td>
                    <td>{{ $log->user->name }}</td>
                    <td>
                        <span class="green">Connecté à {{ \Carbon\Carbon::parse($log->logged_in_at)->timezone('Africa/Casablanca')->format('H:i') }}</span>
                    </td>
                </tr>
            @endforeach
    
            @if ($logs->isEmpty())
                <tr>
                    <td colspan="3">Aucun résultat trouvé</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div class="d-flex justify-content-center my-4">
        <nav aria-label="Page navigation">
            {{ $logs->links('pagination.custom') }}
        </nav>
    </div>
    
</x-app-layout>
