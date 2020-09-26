@extends('layouts.global')
@section('title')
Create New User
@endsection

@section('content')
    <div class="col-md-8">
        
        <form action="{{ route('user.store') }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Name</label>
            <input class="form-control {{ $errors->first('name') ? 'is-invalid' : ''}}" value="{{ old('name') }}" placeholder="Full Name" type="text" name="name" id="name"/>
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>
            <label for="username">username</label>
            <input class="form-control {{ $errors->first('username') ? 'is-invalid' : ''}}" value="{{ old('username') }}" placeholder="username" type="text" name="username" id="username"/>
            <div class="invalid-feedback">
                {{ $errors->first('username') }}
            </div>
            <br>
            <label for="">Roles</label>
            <br>
            <input class="form-control {{ $errors->first('roles') ? 'is-invalid' : ''}}" type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
            <label for="ADMIN">Administrator</label>
            <input class="form-control {{ $errors->first('roles') ? 'is-invalid' : ''}}" type="checkbox" name="roles[]" id="STAFF" value="STAFF">
            <label for="STAFF">Staf</label>
            <input class="form-control {{ $errors->first('roles') ? 'is-invalid' : ''}}" type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
            <label for="CUSTOMER">Customer</label>
            <div class="invalid-feedback">
                {{ $errors->first('roles') }}
            </div>
            <br>

            <label for="phone">Phone Number</label>
            <br>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control {{ $errors->first('phone') ? 'is-invalid' : ''}}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
            <br>
            <label for="address">Addres</label>
            <div class="invalid-feedback">
                {{$errors->first('roles')}}
            </div>
            <br>
            <textarea name="address" id="address" cols="80" rows="10" class="form-control {{ $errors->first('address') ? 'is-invalid' : ''}}">
                {{ old('address') }}
            </textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
            <br>
            <label for="avatar">Avatar image</label>
            <br>
            <input id="avatar" name="avatar" type="file" class="form-control {{ $errors->first('avatar') ? 'is-invalid' : ''}}">
            <div class="invalid-feedback">
                {{ $errors->first('avatar') }}
            </div>
            <hr class="my-3">
            <label for="email">Email</label>
            <input class="form-control {{ $errors->first('email') ? 'is-invalid' : ''}}" placeholder="email" value="{{ old('email') }}" type="text" name="email" id="email"/>
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            <br>
            <label for="password">Password</label>
            <input class="form-control {{ $errors->first('password') ? 'is-invalid' : ''}}" placeholder="password" type="password" name="password" id="password"/>
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
            <br>
            <label for="password_confirmation">Password Confirmation</label>
            <input class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : ''}}" placeholder="password confirmation" type="password" name="password_confirmation"
            id="password_confirmation"/>
            <div class="invalid-feedback">
                {{ $errors->first('password_confirmation') }}
            </div>
            <br>
            <input class="btn btn-primary" type="submit" value="Save"/>

        </form>
    </div>
@endsection