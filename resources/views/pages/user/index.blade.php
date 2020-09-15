@extends('layouts.global')
@section('title')
List Of User
@endsection

@section('content')
    <h5>Daftar User</h5>
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    @if ($user)
        @foreach ($user as $item)
            {{ $item->username }} <br/>
            <img src="{{ asset(Storage::url($item->avatar)) }}" alt="xanda ada gambar">
        @endforeach
    @endif
    <a href="{{ route('user.create') }}">create user</a>
@endsection