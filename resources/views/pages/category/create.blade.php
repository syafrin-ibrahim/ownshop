@extends('layouts.global')
@section('title')
Create New Category
@endsection

@section('content')
    <div class="col-md-8">
         @if (count($errors) > 0 )
             @foreach ($errors->all() as $error)
              {{ $error }} 
              @endforeach
         @endif 
        <form action="{{ route('category.store') }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
           <label for="category">Category Name</label>
           <input type="text" name="name" class="form-control">
           <br/>
           <label for="image">Category Name</label>
           <input type="file" name="image" class="form-control">
           <br/>
           <input type="submit" value="simpan" class="btn btn-sm btn-primary">
        </form>
    </div>
@endsection