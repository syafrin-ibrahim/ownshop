@extends('layouts.global')
@section('title')
    Edit user
@endsection
@section('content')
     <div class="col-md-8">
         @if (count($errors) > 0 )
             @foreach ($errors->all() as $error)
              {{ $error }} 
              @endforeach
         @endif 
        <form action="{{ route('user.update', $user->id) }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Name</label>
            <input class="form-control" placeholder="Full Name" type="text" name="name" id="name" value="{{ $user->name }}"/>
            <br>
            <label for="username">username</label>
            <input class="form-control" placeholder="username" type="text" name="username" id="username" value="{{ $user->username }}"/>
            <br>
            <label for="">Roles</label>
            <br>
            <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN" {{ in_array("ADMIN", json_decode($user->roles)) ? 'checked' : ''}}>
            <label for="ADMIN">Administrator</label>
            <input type="checkbox" name="roles[]" id="STAFF" value="STAFF" {{ in_array("STAFF", json_decode($user->roles)) ? 'checked' : ''}}>
            <label for="STAFF">Staf</label>
            <input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER" {{ in_array("CUSTOMER", json_decode($user->roles)) ? 'checked' : ''}}>
            <label for="CUSTOMER">Customer</label>
            <br>

            <label for="">Status</label>
            <br>
            <input type="radio" name="status" id="status" value="ACTIVE" {{ $user->status == 'ACTIVE' ? 'checked' : '' }}>
            <label for="aktive">aktif</label>
            <input type="radio" name="status" id="status" value="INACTIVE" {{ $user->status == 'INACTIVE' ? 'checked' : '' }}>
            <label for="aktive">inaktif</label>
            <br>
            <label for="phone">Phone Number</label>
            <br>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
            <br>
            <label for="address">Addres</label>
            <br>
            <textarea name="address" id="address" cols="80" rows="10" class="form-control">
                {{ $user->address }}
            </textarea>
            <br>
            <label for="avatar">Avatar image</label>
            <br>
                @if ($user->avatar)
                    <img src="{{ asset('storage/'.$user->avatar) }}" alt="" width="100" height="70">
                @endif
            <br>
            <br>
            <input id="avatar" name="avatar" type="file" class="form-control" >
            <small class="text-muted">kosongkan jika tidak mengganti gambar</small>
            <hr class="my-3">
            <label for="email">Email</label>
            <input class="form-control" placeholder="user@mail.com" type="text" name="email" id="email" value="{{ $user->email }}"/>
            <br>
            <input class="btn btn-primary" type="submit" value="Save"/>

        </form>
    </div>
@endsection