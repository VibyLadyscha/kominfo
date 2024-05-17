<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Post</title>
</head>
<body>
    <div class="mt-4 ms-5 me-5">
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Judul</label>
        <input name="post_title" type="text" class="form-control" id="formGroupExampleInput" value="{{ $post->post_title }}" placeholder="Masukkan Judul">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Kategori</label>
        <select name="category_id"class="form-select" aria-label="Default select example">
            <option value="{{ $post->category_id }}" selected> {{ $post->category->category_detail }} </option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->category_detail }} </option>
                @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Konten</label>
        <textarea name="post_content" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Konten">{{ $post->post_content }}</textarea>
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Foto</label> <br>
        @if($post->post_image)
        <img id="output" src="{{ asset($post->post_image) }}" width="200">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="remove_image" name="remove_image">
            <label class="form-check-label" for="remove_image">
                Hapus Foto
            </label>
        </div>
        @endif
        <input name="post_image" type="file" class="form-control">
    </div>

    <div class="col-auto">
    <input type="submit" class="btn btn-primary" value="Edit Post"/>
    </div>
    </form>
    </div>

</body>
</html>