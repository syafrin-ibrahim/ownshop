@extends('layouts.global')
@section('title')
    Edit user
@endsection
@section('content')
     <div class="col-md-8">
      
        <form action="{{ route('user.update', $user->id) }}" class="bg-white shadow-sm p-3" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Name</label>
            <input class="form-control {{ $errors->first('name') ? 'is-invalid' : ''}}" placeholder="Full Name" type="text" name="name" id="name" value="{{ $user->name }}"/>
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>
            <label for="username">username</label>
            <input class="form-control {{ $errors->first('username') ? 'is-invalid' : ''}}" placeholder="username" type="text" name="username" id="username" value="{{ $user->username }}"/>
            <div class="invalid-feedback">
                {{ $errors->first('username')}}
            </div>
            <br>
            <label for="">Roles</label>
            <br>
            <input type="checkbox" class="form-control {{ $errors->first('roles') ? 'is-inactive' : ''}}" name="roles[]" id="ADMIN" value="ADMIN" {{ in_array("ADMIN", json_decode($user->roles)) ? 'checked' : ''}}>
            <label for="ADMIN">Administrator</label>
            <input type="checkbox" class="form-control {{ $errors->first('roles') ? 'is-inactive' : ''}}" name="roles[]" id="STAFF" value="STAFF" {{ in_array("STAFF", json_decode($user->roles)) ? 'checked' : ''}}>
            <label for="STAFF">Staf</label>
            <input type="checkbox" class="form-control {{ $errors->first('roles') ? 'is-inactive' : ''}}" name="roles[]" id="CUSTOMER" value="CUSTOMER" {{ in_array("CUSTOMER", json_decode($user->roles)) ? 'checked' : ''}}>
            <label for="CUSTOMER">Customer</label>
            <div class="invalid-feedback">
                {{ $errors->first('roles')}}
            </div>            
            <br>

            <label for="">Status</label>
            <br>
            
            <input type="radio" name="status" id="status1" value="ACTIVE" {{ $user->status == 'ACTIVE' ? 'checked' : '' }}>
            <label for="status1">aktif</label>
            <input type="radio" name="status" id="status2" value="INACTIVE" {{ $user->status == 'INACTIVE' ? 'checked' : '' }}>
            <label for="status2">inaktif</label>
            <br>
            <label for="phone">Phone Number</label>
            <br>
            <input type="text" name="phone" id="phone" class="form-control {{ $errors->first('phone') ? 'is-invalid' : ''}}" value="{{ old('phone') ? old('phone') :  $user->phone }}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
            <br>
            <label for="address">Addres</label>
            <br>
            <textarea name="address" id="address" cols="80" rows="10" class="form-control {{ $errors->first('address') ? 'is-invalid' : ''}}">
                {{ old('address') ? old('address') : $user->address }}
            </textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address')}}
            </div>
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
            <input class="form-control {{ $errors->first('email') ? 'is-invalid' : ''}}" type="text" name="email" id="email" value="{{ old('email') ? old('email') : $user->email }}" disabled/>
            <br>
            <input class="btn btn-primary" type="submit" value="Save"/>

        </form>
    </div>
@endsection