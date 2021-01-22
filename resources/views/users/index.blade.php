@extends('layouts.index')
@section('h1')
  All Users
@endsection
@section('content')
  @if(session('success'))
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>User deleted successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  @endif
  @if(!count($users))
    <div class="col-md-12 text-center">
      <h2>No Users ! </h2>
      <h3>Would you want <a href="{{ route('users.create') }}">add</a> some one?</h3>
    </div>
  @else
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
            <th scope="row">{{ $loop->count }}</th>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              <a class="btn btn-sm btn-primary" href="{{ route('users.show',['user' => $user->id]) }}"
                 role="button">Show</a>
              <a class="btn btn-sm btn-secondary" href="{{ route('users.edit',['user' => $user->id]) }}"
                 role="button">Edit</a>
              <form class="d-inline" method="POST" action="{{ route('users.destroy',['user' => $user->id]) }}">
                @method('DELETE')
                @csrf
                <button class="btn btn-sm btn-danger delete-btn" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="row">
        <div class="col-12">
          {{ $users->links() }}
        </div>
      </div>
    </div>
  @endif
@endsection