@extends('layouts.index')
@section('h1')
  All Users
@endsection
@section('content')
  @if(session('success'))
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="dropdown filters">

          <button class="btn mx-3 btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton"
                  data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
            Sort by
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" data-value="1" data-order="id">Id</a>
            <a class="dropdown-item" href="#" data-value="0" data-order="first_name">First name</a>
            <a class="dropdown-item" href="#" data-value="0" data-order="last_name">Last name</a>
            <a class="dropdown-item" href="#" data-value="0" data-order="email">Email</a>
            <a class="dropdown-item" href="#" data-value="0" data-order="created_at">Created-at</a>
            <a class="dropdown-item" href="#" data-value="0" data-order="updated_at">Updated-at</a>
          </div>
        </div>
        <div class="d-flex mt-3 align-items-center">
          <nav class="navbar navbar-light bg-light float-right">
            <a class="form-group filters">
              <input type="text" class="form-control" name="search" placeholder="Search" id="search">
            </a>
          </nav>
        </div>
        <div class="d-flex align-items-center">
          <div class="row d-flex align-items-center">
            <a role="button" class="mx-3 btn btn-primary" id="customSearch">Search</a>
          </div>
        </div>


        <div class="d-flex align-items-right offset-md-6">
          <a role="button" class="ml-4 btn btn-success" href="{{ route('users.create') }}">Add User</a>
        </div>
      </div>
    </div>
    <div class="container">

      <div class="row">
        <div class="col-md-12 ">
          <table class="table">
            <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
              <th scope="col">Created at</th>
              <th scope="col">Updated at</th>
              <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody class="ajax-sort">
            @foreach ($users as $user)
              <tr>
                <th scope="row">{{ $loop->index+1 }}</th>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
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
        </div>
        @endif
      </div>
    </div>
@endsection
@section('ajax')
  <script>
      $(document).ready(function () {
          $('.dropdown-item').click(function () {
              $('*[data-value]').attr("data-value",0);
              $(this).attr("data-value", 1);
          })
          $('#customSearch').click(function () {
              let orderBy = $('*[data-value=1]').data('order')
              let search = $('#search').val()
              $.ajax({
                  url: "{{route('users.index')}}",
                  type: "GET",
                  data: {
                      orderBy: orderBy,
                      search: search,
                  },
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (data) {
                      let positionParameters = location.pathname.indexOf('?');
                      let url = location.pathname.substring(positionParameters, location.pathname.length);
                      let newURL = url + '?';
                      newURL += 'orderBy=' + orderBy;
                      history.pushState({}, '', newURL);

                      $('.ajax-sort').html(data)
                  }
              });
          })
          $('.dropdown-item').click(function () {
              let orderBy = $(this).data('order')
              $.ajax({
                  url: "{{route('users.index')}}",
                  type: "GET",
                  data: {
                      orderBy: orderBy
                  },
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (data) {
                      let positionParameters = location.pathname.indexOf('?');
                      let url = location.pathname.substring(positionParameters, location.pathname.length);
                      let newURL = url + '?';
                      newURL += 'orderBy=' + orderBy;
                      history.pushState({}, '', newURL);
                      $('.ajax-sort').html(data)
                  }
              });
          })
      })
  </script>
@endsection
