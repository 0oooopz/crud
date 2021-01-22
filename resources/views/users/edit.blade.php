@extends('layouts.index')
@section('h1')
  Edit User
@endsection
@section('content')
  <div class="col-md-5 mx-auto">
    <form action="{{ route('users.update',['user' => $user->id]) }}" method="POST">
      @method('PUT')
      @csrf
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>User updated successfully</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <div class="form-group">
        <label for="">First name</label>
        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
      </div>
      <div class="form-group">
        <label for="">Last name</label>
        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
      </div>
      <button type="submit" class="btn btn-success">Update</button>
      <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
    </form>


  </div>
@endsection