@extends('layouts.global')
@section('title')
    Create Book
@endsection
@section('content')
     <div class="col-md-8">
         <!-- @if (count($errors) > 0 )
             @foreach ($errors->all() as $error)
              {{ $error }} 
              @endforeach
         @endif  -->
        <form action="{{ route('book.store') }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
           <label for="title">Title</label> <br>
            <input type="text" class="form-control {{ $errors->first('title') ? 'is-invalid' : ''}}" value="{{ old('title') }}" name="title" placeholder="Book title">
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
            <br>
            <label for="cover">Cover</label>
            <input type="file" class="form-control {{ $errors->first('cover') ? 'is-invalid' : ''}}" name="cover">
            <div class="invalid-feedback">
                {{ $errors->first('cover') }}
            </div>
            <br>
            <label for="category">category</label>
            <select name="category_id" class="form-control {{ $errors->first('category_id') ? 'is-invalid' : ''}}">
                <option value="">Category Book</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('category_id') }}
            </div>
            <br>
            <label for="description">Description</label><br>
            <textarea class="form-control {{ $errors->first('description') ? 'is-invalid' : ''}}" name="description" width="300" height="130" id="description" placeholder="Give a description about this book">
                {{ old('description') }}
            </textarea>
            <div class="invalid-feedback">
                {{ $errors->first('description') }}
            </div>
            <br>
            <label for="stock">Stock</label><br>
            <input type="number" class="form-control {{ $errors->first('stock') ? 'is-invalid' : ''}}" value="{{ old('stock') }}" id="stock" name="stock"
            min=0 value=0>
            <div class="invalid-feedback">
                {{ $errors->first('stock') }}
            </div>
            <br>
            <label for="author">Author</label><br>
            <input type="text" class="form-control {{ $errors->first('author') ? 'is-invalid' : ''}}" name="author" id="author"
            placeholder="Book author" value="{{ old('author') }}">
            <div class="invalid-feedback">
                {{ $errors->first('author') }}
            </div>
            <br>
            <label for="publisher">Publisher</label> <br>
            <input type="text" class="form-control {{ $errors->first('publisher') ? 'is-invalid' : ''}}" id="publisher"
            name="publisher" placeholder="Book publisher" value="{{ old('publisher') }}">
            <div class="invalid-feedback">
                {{ $errors->first('publisher') }}
            </div>
            <br>
            <label for="Price">Price</label> <br>
            <input type="number" class="form-control {{ $errors->first('price') ? 'is-invalid' : ''}}" name="price" id="price" value="{{ old('price') }}"
            placeholder="Book price">
            <div class="invalid-feedback">
                {{ $errors->first('price') }}
            </div>
            <br>
            <button
            class="btn btn-primary"
            name="save_action"
            value="PUBLISH">Publish</button>
            <button
            class="btn btn-secondary"
            name="save_action"
            value="DRAFT">Save as draft</button>

        </form>
    </div>
@endsection