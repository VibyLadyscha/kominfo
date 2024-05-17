<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="mt-4 ms-5 me-5">
    <form action="/postlogin" method="POST">
        @csrf
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Username</label>
        <input name="username" type="text" class="form-control" id="formGroupExampleInput" placeholder="Input Username">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Password</label>
        <input name="password" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Input Password">
    </div>

    <div class="col-auto">
    <input type="submit" class="btn btn-primary" value="Login"/>
    <button type="button" class="btn btn-primary ms-3" onclick="window.location='{{ url('register') }}'">Register</button>
    </div>
    
    </form>
</div>

</body>
</html>