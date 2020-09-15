@extends('layouts.global')
@section('title')
Create New User
@endsection

@section('content')
    <div class="col-md-8">
         @if (count($errors) > 0 )
             @foreach ($errors->all() as $error)
              {{ $error }} 
              @endforeach
         @endif 
        <form action="{{ route('user.store') }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Name</label>
            <input class="form-control" placeholder="Full Name" type="text" name="name" id="name"/>
            <br>
            <label for="username">username</label>
            <input class="form-control" placeholder="username" type="text" name="username" id="username"/>
            <br>
            <label for="">Roles</label>
            <br>
            <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
            <label for="ADMIN">Administrator</label>
            <input type="checkbox" name="roles[]" id="STAFF" value="STAFF">
            <label for="STAFF">Staf</label>
            <input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
            <label for="CUSTOMER">Customer</label>
            <br>

            <label for="phone">Phone Number</label>
            <br>
            <input type="text" name="phone" id="phone" class="form-control">
            <br>
            <label for="address">Addres</label>
            <br>
            <textarea name="address" id="address" cols="80" rows="10" class="form-control"></textarea>
            <br>
            <label for="avatar">Avatar image</label>
            <br>
            <input id="avatar" name="avatar" type="file" class="form-control">
            <hr class="my-3">
            <label for="email">Email</label>
            <input class="form-control" placeholder="user@mail.com" type="text" name="email" id="email"/>
            <br>
            <label for="password">Password</label>
            <input class="form-control" placeholder="password" type="password" name="password" id="password"/>
            <br>
            <label for="password_confirmation">Password Confirmation</label>
            <input class="form-control" placeholder="password confirmation" type="password" name="password_confirmation"
            id="password_confirmation"/>
            <br>
            <input class="btn btn-primary" type="submit" value="Save"/>

        </form>
    </div>
@endsection