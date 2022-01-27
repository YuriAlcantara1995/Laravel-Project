@extends('properties.layout')
   
@section('content')

<script type="text/javascript">
    function add_image() {
        let container = document.getElementById('image_container');
        let counter = document.getElementById('image_count');
        let count = parseInt(counter.getAttribute('value'));
        
        container.appendChild(document.createElement("BR"));
        var inputfile = document.createElement("INPUT");
        inputfile.type = "file";
        inputfile.name = "images" + count.toString();
        inputfile.class = "form-control";
        inputfile.style = "margin-top:10px";
        container.appendChild(inputfile);

        count += 1;
        counter.setAttribute('value',count.toString());
    }
</script>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Property</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('properties.index') }}"> Properties</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('properties.update',$property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" value="{{ $property->name }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                        @if($category->name == $property->category->name)
                            <option selected="true" value="{{$category->id}}">{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                          @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="number" name="price" class="form-control" value="{{ $property->price }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <input type="text" name="description" class="form-control" value="{{ $property->description }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div id="image_container" class="form-group">
                    <strong>Images:</strong>
                    <button type="button" onclick="add_image()" id="btn_add_image" class="btn btn-primary" style="margin-left:10px">Add new image</button>
                    <input id="image_count" hidden type="number" name="count" class="form-control" value=0> 
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

   
    </form>
@endsection
