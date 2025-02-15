<x-app-layout>
    <style>
        /* Body and General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f8fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Header Section */
h2 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.pull-right .btn {
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    background-color: #007bff;
    color: white;
    transition: background-color 0.3s ease;
}

.pull-right .btn:hover {
    background-color: #0056b3;
}

/* Form Styles */
.form-group {
    margin-bottom: 20px;
}

.form-group strong {
    display: block;
    font-size: 14px;
    margin-bottom: 8px;
    color: #555;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    outline: none;
}

/* Permissions Section */
label {
    display: block;
    font-size: 14px;
    margin-bottom: 10px;
    color: #333;
    cursor: pointer;
}

label:hover {
    color: #007bff;
}

/* Error Messages */
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.alert-danger ul {
    margin: 0;
    padding-left: 20px;
}

.alert-danger li {
    font-size: 14px;
}

/* Buttons */
button[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: white;
    background-color: #28a745;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #218838;
}

/* Footer Note */
.text-primary {
    margin-top: 20px;
    font-size: 14px;
    color: #007bff;
    text-align: center;
}

    </style>
    <div class="row">

        <div class="col-lg-12 margin-tb">
    
            <div class="pull-left">
    
                <h2>Create New Role</h2>
    
            </div>
    
            <div class="pull-right">
    
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
    
            </div>
    
        </div>
    
    </div>
    
    
    
    @if (count($errors) > 0)
    
        <div class="alert alert-danger">
    
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
    
            <ul>
    
            @foreach ($errors->all() as $error)
    
                <li>{{ $error }}</li>
    
            @endforeach
    
            </ul>
    
        </div>
    
    @endif
    
    
    
    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
    
    <div class="row">
    
        <div class="col-xs-12 col-sm-12 col-md-12">
    
            <div class="form-group">
    
                <strong>Name:</strong>
    
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
    
            </div>
    
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-12">
    
            <div class="form-group">
    
                <strong>Permission:</strong>
    
                <br/>
    
                @foreach($permission as $value)
    
                    <label>{{ Form::checkbox('permission[]', $value->name, false, array('class' => 'name')) }}
    
                    {{ $value->name }}</label>
    
                <br/>
    
                @endforeach
    
            </div>
    
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
    
            <button type="submit" class="btn btn-primary">Submit</button>
    
        </div>
    
    </div>
    
    {!! Form::close() !!}
    
    
    
   
</x-app-layout>