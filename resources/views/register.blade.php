<!-- <!DOCTYPE html>
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
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="../assets/img/logo-rpl.ico" rel="icon">
    <title>Register</title>
</head>
<body>
   
    <div class="background">
        <div class="bar_1">
        </div>
        <div class="bar_2">
        </div>
        <div class="bar_3">
        </div>
        <div class="bar_4">
        </div>
    </div>
    <div class="row">
            <div class="login">
                <h2>DAFTAR</h2>
            </div>
            <div class="blogin">    
                <h5>Silahkan masukkan username, email, dan kata sandi untuk mendaftar ke dalam portal</h5>
            </div>
                <form action="/postregister" method="POST">
                @csrf
                    <label for="email">Email</label>
                    <input name="email" type="text" id="email" placeholder="Masukkan email">
                    <label for="email">Username</label>
                    <input name="username" type="text" id="email" placeholder="Masukkan username">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" placeholder="Masukkan password">
                    <input type="submit" value="Masuk Sekarang"> 
                    <div class="belum">
                        <h5>Sudah punya akun?</h5>
                        <a href="{{ url('login') }}" class="daftar"> Masuk disini</a>
                    </div>
                </form>
    </div>
    <div class="kanan">
        <img class="logo" src="assets/img/Logo rpl 1.png" alt="">
    </div>
</body>