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
