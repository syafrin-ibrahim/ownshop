@extends('layouts.global')
@section('title')
List Of User
@endsection

@section('content')
    <h5>Daftar User</h5>
    <a href="{{ route('user.create') }}">create user</a>
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    @if ($user)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>no</th>
                    <th>name</th>
                    <th>username</th>
                    <th>email</th>
                    <th>avatar</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($user as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            @if ($item->avatar)
                                <img src="{{ asset(Storage::url($item->avatar)) }}" alt="N / A" width="70" height="40">
                            @else
                                Not available
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('user.edit', $item->id) }}" class="btn-info btn-sm text-white">edit</a> | 
                            <form class="d-inline" onsubmit="return confirm('yakin akan menghapus data ini ?')" action="{{ route('user.destroy', $item->id) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <input type="submit" name="delete" value="hapus" class="btn-info btn-sm text-white">
                            </form>

                        </td>
                     </tr>

                 @endforeach
            </tbody>
        </table>
    @else    
        <div class="alert alert-info">
            Data Not available
        </div>
    @endif
@endsection