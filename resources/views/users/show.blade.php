@extends('layouts.index')
@section('h1')
  User Info
@endsection
@section('content')
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        Single User
      </div><!-- /.card-header -->
      <div class="card-body">
        <p>User name : {{ $user->first_name }}</p>
        <p>User surname : {{ $user->last_name }}</p>
        <p>User email : {{ $user->email }}</p>
        <a class="btn-sm btn-primary" href="{{ route('users.index') }}" role="button">Back</a>
      </div><!-- /.card-body -->
    </div><!-- /.card-->
  </div><!-- /.col-md-5 mx-auto -->

@endsection
