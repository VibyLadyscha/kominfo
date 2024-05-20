<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Comment</title>
</head>
<body>
    <div class="mt-4 ms-5 me-5">
    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Comment</label>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="comment_content" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Komentar">{{ $comment->comment_content }}</textarea>
    </div>

    <div class="col-auto">
    <input type="submit" class="btn btn-primary" value="Edit Comment"/>
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
    <title>Edit Comment</title>
    <link rel="stylesheet" href="{{ asset('assets/css/edit.css') }}">
    <link href="../assets/img/logo-rpl.ico" rel="icon">
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
    <img class="logo" src="{{ asset('assets/img/Logo rpl 1.png') }}" alt="">
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
        <a class="tulisan-back" href="{{ route('post.show', ['post' => $post->id]) }}">
            Back
        </a>
    </div>

    <div class="bungkus-h">
        <div class="headerr">
            <h4>Edit Komentar</h4>
        </div>
    </div>
    <div class="bungkus-profile">    
        <div class="profile">
        <form action="{{ route('comment.update', $comment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label mt-2">Comment</label>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="comment_content" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Komentar" style="width: 411%; margin-left: 20px; background-color: #FCF6E3; border: 2px solid #03485D;">{{ $comment->comment_content }}</textarea>
    </div>

    
        </div>
    </div>
    <div class="bungkus-b">
        <div class="save">
            <div class="col-auto">
            <input type="submit" class="btn btn-primary" value="Edit Comment"/>
        </div>
    </div>
    </form>

    <script src="{{ asset('assets/js/garis.js') }}"></script>

</body>
</html>
