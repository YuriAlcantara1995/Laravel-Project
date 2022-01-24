@extends('realtors.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Real Estate Selling System</h2>
            </div>
            @if (!$existRealtorProfile && auth()->check())
               <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('realtors.create') }}"> Create Realtor Profile</a>
                </div>
            @endif
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
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($realtors as $realtor)
        <tr>
            <td>{{ ++$i }}</td>
            <td><a class="" href="{{ route('realtors.show',$realtor->id) }}">{{ $realtor->user_name}}</a></td>
            <td>{{ $realtor->user_email}}</td>
            <td>{{ $realtor->phone}}</td>
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
    
    <div class="d-flex justify-content-center">
        {!! $realtors->appends(Request::query())->links() !!}
    </div>
      
@endsection
