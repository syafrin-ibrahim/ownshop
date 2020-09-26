@extends('layouts.global')
@section('title')
    Edit Book
@endsection
@section('content')
     <div class="col-md-8">
        <form action="{{ route('book.update', $book->id) }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <label for="title">Title</label> <br>
            <input type="text" class="form-control {{ $errors->first('title') ? 'is-invalid' : ''}}" value="{{ old('title') ? old('title') : $book->title }}" name="title" placeholder="Book title">
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
            <br>
            <label for="cover">Ganti Cover</label><br>
            <img src="{{ asset(Storage::url($book->cover)) }}" alt="no image" width="200" height="150"><br><br>
            <input type="file" class="form-control {{ $errors->first('cover') ? 'is-invalid' : ''}}" name="cover" value="{{ $book->cover }}">
            <div class="invalid-feedback">
                {{ $errors->first('cover') }}
            </div>
            <small class="text-muted">
               kosongkan jika tidak ingin mengganti cover
           </small>

            <br>
            <label for="category">category</label>
            <select name="category_id" class="form-control {{ $errors->first('category_id') ? 'is-invalid' : ''}}">
                <option value="">Category Book</option>
                @foreach ($category as $item)
                    @if ($item->id == $book->category_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('category_id') }}
            </div>
            <br>
            <label for="description">Description</label><br>
            <textarea class="form-control {{ $errors->first('description') ? 'is-invalid' : ''}}" name="description" width="300" height="130" id="description" placeholder="Give a description about this book">
                {{ old('description') ? old('description') : $book->description }}
            </textarea>
            <div class="invalid-feedback">
                {{ $errors->first('description') }}
            </div>
            <br>
            <label for="stock">Stock</label><br>
            <input type="number" class="form-control {{ $errors->first('stock') ? 'is-invalid' : ''}}"
             value="{{ old('stock') ?  old('stock') : $book->stock }}" id="stock" name="stock" min=0 value=0>
            <div class="invalid-feedback">
                {{ $errors->first('stock') }}
            </div>
            <br>
            <label for="author">Author</label><br>
            <input type="text" class="form-control {{ $errors->first('author') ? 'is-invalid' : ''}}" name="author" id="author"
            placeholder="Book author" value="{{ old('author') ? old('author') : $book->author }}">
            <div class="invalid-feedback">
                {{ $errors->first('author') }}
            </div>
            <br>
            <label for="publisher">Publisher</label> <br>
            <input type="text" class="form-control {{ $errors->first('publisher') ? 'is-invalid' : ''}}" id="publisher"
            name="publisher" placeholder="Book publisher" value="{{ old('publisher') ? old('publisher') : $book->publisher }}">
            <div class="invalid-feedback">
                {{ $errors->first('publisher') }}
            </div>
            <br>
            <label for="Price">Price</label> <br>
            <input type="number" class="form-control {{ $errors->first('price') ? 'is-invalid' : ''}}" name="price" id="price" value="{{ old('price') ? old('price') : $book->publisher }}"
            >
            <div class="invalid-feedback">
                {{ $errors->first('price') }}
            </div>
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