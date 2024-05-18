<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/trash1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Post</title>
</head>
<body>
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
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kategori
            </a>
            <ul class="dropdown-menu">
              @foreach ($categories as $category)
              <li><a class="dropdown-item" href="{{ route('category', ['category' => $category->id]) }}">{{ $category->category_detail }}</a></li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ url('posthistory') }}">Post History</a>
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
    </div>
  </nav>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    <div class="col">
        <div class="card mb-3 ms-3 mt-3" style="width: 50rem;">
        @isset($post->post_image)
        <img src="{{ asset($post->post_image) }}" class="card-img-top" alt="{{ $post->post_title }}" style="width: 50rem;">
        @endisset
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">{{ $post->category->category_detail }}</h6>
                <h5 class="card-title">{{ $post->post_title }}</h5>
                <p class="card-text">{{ $post->post_content }}</p>
                <p class="card-text"><small class="text-body-secondary">Last updated {{ $post->updated_at->diffForHumans() }}</small></p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card mb-3 ms-3 mt-3" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">Comments</h5>
                @foreach ($comments as $comment)
                <h6 class="card-subtitle mb-2 text-body-secondary">
                  @if ($comment->user->profile_picture)
                <img src="{{ asset($comment->user->profile_picture) }}" alt="User Profile Picture" style="width: 40px; height: 40px; border-radius: 50%;">
                @else
                <img src="{{ asset('public/uploads/posts/profile.jpeg') }}" alt="User Profile Picture" style="width: 40px; height: 40px; border-radius: 50%;">
                @endif
                  {{ $comment->user->username }}</h6>
                @if (Auth::id() == $comment->user_id)
                <div class="dropdown" style="float: right;">
                      <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('comment.edit', ['comment' => $comment->id]) }}">Edit</a></li>
                        <li>
                            <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="dropdown-item">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endif                
                
                <p class="card-text">{{ $comment->comment_content }}</p>
                @endforeach
            </div>
            <a href="{{ route('comment.create', ['post' => $post->id]) }}" class="btn btn-primary" style="background-color: #03485D">Create Comment</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>