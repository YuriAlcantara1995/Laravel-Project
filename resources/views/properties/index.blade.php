@extends('properties.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Real Estate Selling System</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('properties.create') }}"> Create New Property</a>
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
            @if($sortBy == "properties.description" || $sortBy == null)
                @if($order == "desc")
                    <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'properties.description', 'order' => 'asc']) }}">Description &darr;</a></th>
                @else
                    <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'properties.description', 'order' => 'desc']) }}">Description &uarr;</a></th>
                @endif
            @else
                <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'properties.description', 'order' => 'asc']) }}">Description</a></th>
            @endif
            @if($sortBy == "realtors.phone")
                @if($order == "desc")
                    <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'realtors.phone', 'order' => 'asc']) }}">Realtor Contact &darr;</a></th>
                @else
                    <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'realtors.phone', 'order' => 'desc']) }}">Realtor Contact &uarr;</a></th>
                @endif
            @else
                <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'realtors.phone', 'order' => 'asc']) }}">Realtor Contact</a></th>
            @endif            
            @if($sortBy == "price")
                @if($order == "desc")
                    <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'price', 'order' => 'asc']) }}">Price &darr;</a></th>
                @else
                    <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'price', 'order' => 'desc']) }}">Price &uarr;</a></th>
                @endif
            @else
                <th><a style="color:black" class="" href="{{ Request::fullUrlWithQuery(['sortBy' => 'price', 'order' => 'asc']) }}">Price</a></th>
            @endif
            <th width="280px">Action</th>
        </tr>
        @foreach ($properties as $property)
        <tr>
            <td>{{ ++$i }}</td>
            <td><a class="" href="{{ route('properties.show',$property->id) }}">{{ $property->description}}</a></td>
            <td><a class="" href="#">{{ $property->realtor_contact }}</a></td>
            <td>{{ $property->price }}</td>
            <td>
                <form action="{{ route('properties.destroy',$property->id) }}" method="POST">
   
                    <a class="btn btn-primary" href="{{ route('properties.edit',$property->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button onclick="return confirm('Are you sure to delete this property?')" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $properties->appends(Request::query())->links() !!}
      
@endsection
