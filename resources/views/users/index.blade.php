@extends('layouts.index')
@section('h1')
  All Users
@endsection
@section('content')
<div class="col-md-12">
  <table class="table">
    <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <th scope="row">{{ $loop->index+1 }}</th>
        <td>{{ $user->first_name }}</td>
        <td>{{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          <a class="btn-sm btn-primary" href="{{ route('users.show',['user' => $user->id]) }}" role="button">Show</a>
          <a class="btn-sm btn-secondary" href="#" role="button">Edit</a>
          <a class="btn-sm btn-danger" href="#" role="button">Delete</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection