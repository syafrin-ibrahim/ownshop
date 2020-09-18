@extends('layouts.global')
@section('title')
List Of Category
@endsection

@section('content')
    <h5>Daftar Category</h5>
    <a href="{{ route('category.create') }}" class="btn btn-success btn-sm">create category</a><br/><br/>
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    @if ($categ)
        {{-- <div class="row">
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
        </div> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>no</th>
                    <th>name</th>
                    <th>image</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($categ as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset(Storage::url($item->image)) }}" alt="N / A" width="70" height="40">
                            @else
                                Not available
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('category.edit', $item->id) }}" class="btn-info btn-sm text-white">edit</a> | 
                            <form class="d-inline" onsubmit="return confirm('yakin akan menghapus data ini ?')" action="{{ route('category.destroy', $item->id) }}" method="post">
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
                        {{-- {{ $user->links() }} --}}
                        {{ $categ->appends(Request::all())->links() }}
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