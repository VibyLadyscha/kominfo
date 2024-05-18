<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login</title>
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
                <h2>MASUK</h2>
            </div>
            <div class="blogin">    
                <h5>Silahkan masukkan username dan kata sandi anda yang terdaftar untuk masuk ke dalam portal</h5>
            </div>
                <form action="/postlogin" method="POST">
                @csrf
                    <label for="email">Username</label>
                    <input name="username" type="text" id="email" placeholder="Masukkan username">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" placeholder="Masukkan password">
                    <input type="submit" value="Masuk Sekarang"> 
                    <div class="belum">
                        <h5>Belum punya akun?</h5>
                        <a href="{{ url('register') }}" class="daftar"> Daftar disini</a>
                    </div>
                </form>
    </div>
    <div class="kanan">
        <img class="logo" src="assets/img/Logo rpl 1.png" alt="">
    </div>
</body>