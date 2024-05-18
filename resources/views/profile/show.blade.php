<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body>

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif

<button type="button" class="btn btn-primary ms-5 mt-4" onclick="window.location='{{ url('dashboard') }}'">Back</button>

    <div class="mt-4 ms-5 me-5">

    <div class="d-flex justify-content-center">
        @if($user->profile_picture)
        <img src="{{ asset($user->profile_picture) }}" class="img-thumbnail  rounded-circle" alt="Profile Picture" width="200" height="200">
        @else
        <img src="{{ asset('public/uploads/posts/profile.jpeg') }}" class="img-thumbnail  rounded-circle" alt="Profile Picture" width="200" height="200">
        @endif
    </div>

    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-check d-flex justify-content-center">
        <input class="form-check-input" type="checkbox" value="1" id="remove_image" name="remove_image">
        <label class="form-check-label" for="remove_image">
            Hapus Foto
        </label>
    </div>

    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Foto</label>
        <input name="profile_picture" type="file" class="form-control">
    </div>

    <div class="mb-3>
        <label for="formGroupExampleInput" class="form-label">Username</label>
        <input name="username" type="text" class="form-control" id="formGroupExampleInput" placeholder="Ubah Username" value="{{ $user->username }}">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Email</label>
        <input name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="Email" value="{{ $user->email }}" readonly>
        <small class="form-text text-danger">Email tidak dapat diedit.</small>
    </div>


    <div class="d-flex justify-content-center gap-3">
        <div class="col-auto">
            <input type="submit" class="btn btn-primary" value="Edit Profile"/>
        </div>
    </form>

    <form action="{{ route('profile.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
    </form>
</div>

    </div>

</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <img class="logo" src="../assets/img/Logo rpl 1.png" alt="">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

@php
  use Illuminate\Support\Str;
@endphp

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="back">
            <i class="bi bi-arrow-left-short"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#03485D" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
            </svg>
        <a class="tulisan-back" href="{{ url('dashboard') }}">
            Back
        </a>
    </div>

    <div class="bungkus-h">
        <div class="headerr">
            <h4>Profil Saya</h4>
        </div>
    </div>
    <div class="bungkus-profile">    
        <div class="profile">
            <div class="wkiri">
                <div class="pp">
                    @if($user->profile_picture)
                        <img src="{{ asset($user->profile_picture) }}" class="img-thumbnail  rounded-circle" alt="Profile Picture" width="200" height="200">
                    @else
                        <img src="{{ asset('public/uploads/posts/profile.jpeg') }}" class="img-thumbnail  rounded-circle" alt="Profile Picture" width="200" height="200">
                    @endif
                </div>
                <div class="hapus">
                <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" value="1" id="remove_image" name="remove_image">
                        <label class="form-check-label" for="remove_image"> Hapus Foto</label>
                    </div>
                </div>
            </div>
            <div class="form_post">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Username</label>
                <input name="username" type="text" class="form-control" id="formGroupExampleInput" placeholder="Ubah Username" value="{{ $user->username }}">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Email</label>
                <input name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="Email" value="{{ $user->email }}" readonly>
                <small class="form-text text-danger">Email tidak dapat diedit.</small>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Foto</label>
                <input name="profile_picture" type="file" class="form-control">
            </div>
        </div>
        </div>
    </div>
    <div class="bungkus-b">
        <div class="save">
            <div class="col-auto">
            <input type="submit" class="btn btn-primary" value="Edit Profile"/>
        </div>
    </div>
    </form>
        <div class="edit">
            <input type="submit" value="Hapus Akun" action="" method="">  
        </div>    
    </div>
</body>
</html>
