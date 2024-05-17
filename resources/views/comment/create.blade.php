<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Make Comment</title>
</head>
<body>
    <div class="mt-4 ms-5 me-5">
    <form action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Comment</label>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="comment_content" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Komentar"></textarea>
    </div>

    <div class="col-auto">
    <input type="submit" class="btn btn-primary" value="Comment"/>
    </div>
    </form>
    </div>

</body>
</html>