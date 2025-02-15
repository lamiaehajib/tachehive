<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="/path/to/styles.css" rel="stylesheet">



    <style>
  
        body {
          font-family: Arial, sans-serif;
          margin: 0;
    /* padding: 0; */
         display: flex;
          justify-content: center;
        }

          h3 {
    color: #D32F2F;
    font-family: 'Roboto', sans-serif;
    font-weight: bold;
    margin-top: 20px;
    text-transform: uppercase;
    margin-left: 110px;
}

h2 {
    color: #D32F2F;
    font-size: 2rem;
    margin-bottom: 20px;
    text-transform: uppercase;

}
       
th {
    
    text-align: center !important;
    background-color: #C2185B !important;
    color:white !important;
    
}
td{
    text-align: center !important;
}
table{
    border-radius: 13px !important;
}



    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>