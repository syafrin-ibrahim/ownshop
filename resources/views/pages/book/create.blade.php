@extends('layouts.global')
@section('title')
    Create Book
@endsection
@section('content')
     <div class="col-md-8">
         @if (count($errors) > 0 )
             @foreach ($errors->all() as $error)
              {{ $error }} 
              @endforeach
         @endif 
        <form action="{{ route('book.store') }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
           <label for="title">Title</label> <br>
            <input type="text" class="form-control" name="title" placeholder="Book title">
            <br>
            <label for="cover">Cover</label>
            <input type="file" class="form-control" name="cover">
            <br>
            <label for="category">category</label>
            <select name="category_id" class="form-control">
                <option value="">Category Book</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <br>
            <label for="description">Description</label><br>
            <textarea name="description" width="300" height="130" id="description" placeholder="Give a description about this book"></textarea>
            <br>
            <label for="stock">Stock</label><br>
            <input type="number" class="form-control" id="stock" name="stock"
            min=0 value=0>
            <br>
            <label for="author">Author</label><br>
            <input type="text" class="form-control" name="author" id="author"
            placeholder="Book author">
            <br>
            <label for="publisher">Publisher</label> <br>
            <input type="text" class="form-control" id="publisher"
            name="publisher" placeholder="Book publisher">
            <br>
            <label for="Price">Price</label> <br>
            <input type="number" class="form-control" name="price" id="price"
            placeholder="Book price">
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