@extends('realtors.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Realtor</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url()->previous() }}"> Back</a>
            </div>
        </div>
    </div>
   
        <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $realtor->user->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $realtor->user->email }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Contact:</strong>
                            {{ $realtor->phone }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Amount of selling properties:</strong>
                            {{ $realtor->properties->count() }}
                        </div>
                    </div>
            </div>
@endsection
