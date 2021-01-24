@extends('layouts.index')
@section('h1')
  Additional Information
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-5 mx-auto">
        <div class="card">
          <div class="card-header">
            User Info
          </div><!-- /.card-header -->
          <div class="card-body">
            <p>User name : {{ $user->first_name }}</p>
            <p>User surname : {{ $user->last_name }}</p>
            <p>User email : {{ $user->email }}</p>
            <a class="btn btn-sm btn-primary" href="{{ route('users.index') }}">Back</a>
          </div><!-- /.card-body -->
        </div><!-- /.card-->
      </div><!-- /.col-md-5 mx-auto -->
    </div>
  </div>
@endsection
