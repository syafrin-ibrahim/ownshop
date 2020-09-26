@extends('layouts.global')
@section('title')
    List Orders
@endsection
@section('content')
    <h5>Daftar Orders</h5>
   
     @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    
        <div class="row">
            <div class="col-md-6">
                <form action="{{  route('order.index') }}" method="get">
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
                    <th>invoice number</th>
                    <th>status</th>
                    <th>buyer</th>
                    <th>total quantity</th>
                    <th>order date</th>
                    <th>total price</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($order as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->invoice_number }}</td>
                        <td>
                            @if($item->status == "SUBMIT")
                                <span class="badge bg-warning text-light">{{$item->status}}</span>
                            @elseif($item->status == "PROCESS")
                                <span class="badge bg-info text-light">{{$item->status}}</span>
                            @elseif($item->status == "FINISH")
                                <span class="badge bg-success text-light">{{$item->status}}</span>
                            @elseif($item->status == "CANCEL")
                                <span class="badge bg-dark text-light">{{$item->status}}</span>
                            @endif
                        </td>
                        <td>
                        {{ $item->user->name }} <br>
                        <small>{{ $item->user->email}}</small>
                        </td>
                        <td>{{ $item->totalQuantity }}</td>
                        <td>{{ $item->created_at}}</td>
                        <td>{{ $item->total_price }}</td>                       
                        <td>
                            <a href="{{ route('order.edit', $item->id) }}" class="btn-info btn-sm text-white">edit</a> | 
                            <form class="d-inline" onsubmit="return confirm('yakin akan menghapus data ini ?')" action="{{ route('order.destroy', $item->id) }}" method="post">
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
                        {{-- {{ $order->links() }} --}}
                        {{-- {{ $order->appends(Request::all())->links() }} --}}
                    </td>
                </tr>
            </tfoot>
        </table>
   
    
@endsection