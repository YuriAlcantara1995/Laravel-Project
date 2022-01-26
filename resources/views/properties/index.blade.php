@extends('properties.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Real Estate Selling System</h2>
            </div>
            <div class="pull-right" style="margin-left:10px">
                    <a class="btn btn-success" href="{{ 'welcome' }}"> Home</a>
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
            <th>Properties</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($properties as $property)
        <tr>
            <td>{{ ++$i }}</td>
            <td>
                <div class="row">
                @forelse ($property->images as $image)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    @if(!is_null($image->thumbnail))
                       <img src="/storage/images/{{$image->thumbnail->file_path}}" alt="">
                    @else
                       <img src="/storage/images/{{$image->file_path}}" alt="">
                    @endif
                </div>
                
                @if ($loop->first)
                   @break
                @endif
                @empty
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p>No image</p>
                </div>
                @endforelse
                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <a class="" href="{{ route('properties.show',$property->id) }}">{{ $property->name }}</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category:</strong>
                            {{ $property->category_name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $property->description }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $property->price }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Realtor:</strong>
                            <a class="" href="{{ route('realtors.show',$property->realtor_id) }}">{{ $property->realtor_name}}</a>    
                        </div>
                    </div>
                </div>
            </td>
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
  
    <div class="d-flex justify-content-center">
        {!! $properties->appends(Request::query())->links() !!}
    </div>
      
@endsection
