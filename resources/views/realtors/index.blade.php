@extends('realtors.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Real Estate Selling System</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('realtors.create') }}"> Create Realtor Profile</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            @if($sortBy == "realtors.phone")
                @if($order == "desc")
                    <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'realtors.phone', 'order' => 'asc']) }}">Realtor Contact &darr;</a></th>
                @else
                    <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'realtors.phone', 'order' => 'desc']) }}">Realtor Contact &uarr;</a></th>
                @endif
            @else
                <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'realtors.phone', 'order' => 'asc']) }}">Realtor Contact</a></th>
            @endif            
            <th width="280px">Action</th>
        </tr>
        @foreach ($realtors as $realtor)
        <tr>
            <td>{{ ++$i }}</td>
            <td><a class="" href="{{ route('realtors.show',$realtor->id) }}">{{ $realtor->phone}}</a></td>
            <td>
                <form action="{{ route('realtors.destroy',$realtor->id) }}" method="POST">
   
                    <a class="btn btn-primary" href="{{ route('realtors.edit',$realtor->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button onclick="return confirm('Are you sure to delete this realtor?')" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $realtors->appends(Request::query())->links() !!}
      
@endsection
