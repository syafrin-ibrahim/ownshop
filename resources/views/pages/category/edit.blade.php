@extends('layouts.global')
@section('title')
Edit Category
@endsection

@section('content')
    <div class="col-md-8">
         <!-- @if (count($errors) > 0 )
             @foreach ($errors->all() as $error)
              {{ $error }} 
              @endforeach
         @endif  -->
        <form action="{{ route('category.update', $categ->id) }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           <label for="category">Category Name</label>
           <input type="text" name="name" class="form-control  {{ $errors->first('name') ? 'is-invalid' : '' }}" value="{{ old('name') ? old('name') : $categ->name }}">
           <div class="invalid-feedback">
                {{ $errors->first('name') }}
           </div>
           <br/>
           @if ($categ->image)
               <span>Image</span><br><br>
               <img src="{{ asset(Storage::url($categ->image)) }}" alt="" width="120" height="100">
               <br>
           @endif
           <label for="image">Image Category</label>
           <input type="file" name="image" class="form-control">
           <small class="text-muted">
               kosongkan jika tidak ingin mengganti image
           </small>
           <br/>
           <input type="submit" value="simpan" class="btn btn-sm btn-primary">
        </form>
    </div>
@endsection