<!DOCTYPE html>
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
    <form action="/profile/edit" method="POST">
        @csrf
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
</html>