<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/trash1.css">
    <link href="../assets/img/logo-rpl.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Post History</title>
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
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ url('dashboard') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori
          </a>
          <ul class="dropdown-menu">
            @foreach ($categories as $category)
            <li><a class="dropdown-item" href="{{ route('category', ['category' => $category->id]) }}">{{ $category->category_detail }}</a></li>
            @endforeach
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ url('posthistory') }}">Post History</a>
        </li>
      </ul>
      <div class="dropdown">
          <button class="btn btn-outline-primary dropdown-toggle ms-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->username }}
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">Profile</a></li>
            <li>
              <form id="logout-form" action="/logout" method="POST" style="display: none;"> 
                @csrf
              </form>
              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </li>
          </ul>
        </div>
    </div>
  </div>y
</nav>

<div class="back">
            <i class="bi bi-arrow-left-short"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#03485D" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
            </svg>
        <a class="tulisan-back" href="{{ url('dashboard') }}">
            Back
        </a>
</div>

<div class="content">
      @if($posts->isEmpty())
      <div class="text-center mt-3">
        <h4><strong class="text" style="color: #03485D">Anda tidak memiliki riwayat postingan.</strong></h4>
      </div>
      @else
        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col" style="text-align: center">No</th>
                <th scope="col" style="text-align: center">Judul Artikel</th>
                <th scope="col" style="text-align: center">Action</th>
              </tr>
            </thead>
            <tbody>
    @foreach($posts as $post)
    <tr>
      <th scope="row" style="width: 5%; text-align: center;">{{ $loop->iteration }}</th>
      <td style="width: 80%">{{ $post->post_title }}</td>
      <td style="text-align: center">
      <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="btn btn-warning btn-sm">
          <i class="bi bi-pencil-square"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
              </svg>
        </a>
        <form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">
            <i class="bi bi-trash"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1h3.5V5H6a.5.5 0 0 1-.5-.5z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h1.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
              </svg>
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
        </table>
    </div>

<h5 style="margin-left: 60px">Total: {{ count($posts) }} </h5> <br>
@endif
<a href="{{ route('post.trash') }}" class="btn btn-primary" style="margin-left: 60px; background-color: #03485D;">Trash</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="../assets/js/garis.js"></script>

</body>
</html>