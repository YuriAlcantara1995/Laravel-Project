@extends('properties.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Property</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('properties.index') }}"> Properties</a>
            </div>
        </div>
    </div>
   
    <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <a class="" href="{{ route('properties.show',$property->id) }}">{{ $property->name }}</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category:</strong>
                            @if(!is_null($property->category))
                                {{ $property->category->name }}
                            @endif
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
                            <a class="" href="{{ route('realtors.show',$property->realtor_id) }}">{{ $property->realtor->user->name}}</a>    
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Images:</strong>
                <br/>
                @foreach ($images as $image)
                    <img src="/storage/images/{{$image->thumbnail_file_path}}" alt="">
                    <br/>
                    <br/>
                @endforeach
            </div>
        </div>

                </div>
@endsection
