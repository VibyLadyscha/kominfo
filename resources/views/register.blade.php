<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
<div class="mt-4 ms-5 me-5">
    <form action="/postregister" method="POST">
    @csrf
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Email</label>
        <input name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="Input Email">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Username</label>
        <input name="username" type="text" class="form-control" id="formGroupExampleInput" placeholder="Input Username">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Password</label>
        <input name="password" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Input Password">
    </div>

    <div class="col-auto">
    <input type="submit" class="btn btn-primary" value="Register"/>
    </div>
    </form>
</div>

</body>
</html>