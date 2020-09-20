@extends('layouts.global')
@section('title')
    List Book
@endsection
@section('content')
    <h5>Daftar Buku</h5>
    <a href="{{ route('book.create') }}">create book</a>
     @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    @if ($books)
        <div class="row">
            <div class="col-md-6">
                <form action="{{  route('user.index') }}" method="get">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="key" value="{{ Request::get('key') }}" class="form-control col-md-10" placeholder="Filter Berdasarkan Email"/>
                        <div class="input-group-append">
                            <input type="submit" value="filter" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>no</th>
                    <th>cover</th>
                    <th>title</th>
                    <th>author</th>
                    <th>status</th>
                    <th>category</th>
                    <th>stock</th>
                    <th>price</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($books as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                               @if ($item->cover)
                                <img src="{{ asset(Storage::url($item->cover)) }}" alt="N / A" width="70" height="40">
                            @else
                                Not available
                            @endif
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->author}}</td>
                        <td>
                            @if ($item->status == 'PUBLISH')
                                <span class="badge badge-success">
                                    {{ $item->status }}
                                </span>
                            @else
                                 <span class="badge badge-danger">
                                    {{ $item->status }}
                                </span>
                            @endif
                        </td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->price }}</td>                       
                        <td>
                            <a href="{{ route('book.edit', $item->id) }}" class="btn-info btn-sm text-white">edit</a> | 
                            <form class="d-inline" onsubmit="return confirm('yakin akan menghapus data ini ?')" action="{{ route('book.destroy', $item->id) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <input type="submit" name="delete" value="hapus" class="btn-info btn-sm text-white">
                            </form>

                        </td>
                     </tr>

                 @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">
                        {{-- {{ $books->links() }} --}}
                        {{-- {{ $books->appends(Request::all())->links() }} --}}
                    </td>
                </tr>
            </tfoot>
        </table>
    @else    
        <div class="alert alert-info">
            Data Not available
        </div>
    @endif
@endsection