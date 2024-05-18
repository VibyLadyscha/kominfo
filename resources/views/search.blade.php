<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Search {{ $query }}</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary" class="navbar bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}">Home</a>
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
        <a href="{{ route('post.create') }}" class="btn btn-outline-primary" type="submit">Add Post</a>
      </ul>
      <form class="d-flex form-inline" role="search" action="{{ route('dashboard.search') }}" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle ms-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          {{ Auth::user()->username }}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">Profile</a></li>
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

@php
  use Illuminate\Support\Str;
@endphp

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@foreach ($posts as $post)
<div class="card mb-3 mx-auto mt-3" style="width: 50rem;">
@isset($post->post_image)
<img src="{{ asset($post->post_image) }}" class="card-img-top" alt="{{ $post->post_title }}" style="width: 50rem;">
@endisset
  <div class="card-body">
    <h6 class="card-subtitle mb-2 text-muted">{{ $post->category->category_detail }}</h6>
    <h5 class="card-title">{{ $post->post_title }}</h5>
    <p class="card-text">{{ Str::words($post->post_content, 50, '...') }}</p>
    <a href="{{ 'post/'.$post->id }}" class="btn btn-primary">Read More</a>
    <p class="card-text"><small class="text-body-secondary">Last updated {{ $post->updated_at->diffForHumans() }}</small></p>
  </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>