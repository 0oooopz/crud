@extends('layouts.index')
@section('h1')
  Add User
@endsection
@section('content')
  <div class="col-md-5 mx-auto">
    <form action="" method="post">
      <div class="form-group">
        <label for="">First name</label>
        <input type="text" class="form-control" name="first_name">
      </div>
      <div class="form-group">
        <label for="">Last name</label>
        <input type="text" class="form-control" name="last_name">
      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input type="text" class="form-control" name="email">
      </div>
      <button type="submit" class="btn btn-success" name="submit_create">Add User</button>
      <button type="submit" class="btn btn-danger" name="cancel_create">Cancel</button>
    </form>
  </div>
@endsection