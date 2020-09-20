@extends('layouts.global')
@section('title')
    Edit Book
@endsection
@section('content')
     <div class="col-md-8">
         @if (count($errors) > 0 )
             @foreach ($errors->all() as $error)
              {{ $error }} 
              @endforeach
         @endif 
        <form action="{{ route('book.update', $book->id) }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
           <label for="title">Title</label> <br>
            <input type="text" class="form-control" name="title" value="{{ $book->title }}">
            <br>
            <label for="cover">Ganti Cover</label><br>
            <img src="{{ asset(Storage::url($book->cover)) }}" alt="no image" width="200" height="150"><br><br>
            <input type="file" class="form-control" name="cover" value="{{ $book->cover }}">
            <small class="text-muted">
               kosongkan jika tidak ingin mengganti cover
           </small>
            <br>
            <label for="category">category</label>
            <select name="category_id" class="form-control">
                <option value="">Category Book</option>
                @foreach ($category as $item)
                    @if ($item->id == $book->category_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
            <br>
            <label for="description">Description</label><br>
            <textarea name="description" width="300" height="130" id="description">{{ $book->description }}</textarea>
            <br>
            <label for="stock">Stock</label><br>
            <input type="number" class="form-control" id="stock" name="stock"
            min=0 value="{{ $book->stock }}">
            <br>
            <label for="author">Author</label><br>
            <input type="text" class="form-control" name="author" id="author"
            value="{{ $book->author }}">
            <br>
            <label for="publisher">Publisher</label> <br>
            <input type="text" class="form-control" id="publisher"
            name="publisher" value="{{ $book->publisher }}">
            <br>
            <label for="Price">Price</label> <br>
            <input type="number" class="form-control" name="price" id="price"
            value="{{ $book->price }}">
            <br>
            <label for="">Status</label>
            <br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status1" value="PUBLISH" {{ $book->status == 'PUBLISH' ? 'checked' : ''}}>
                <label class="form-check-label" for="status1">publish</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status2" value="DRAFT" {{ $book->status == 'DRAFT' ? 'checked' : '' }}>
                <label class="form-check-label" for="status2">draft</label>

            </div>
            <br>
            <button
            class="btn btn-primary"
            name="save_action"
            value="PUBLISH">Publish</button>
            
        </form>
    </div>
@endsection