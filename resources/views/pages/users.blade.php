@extends ('template.master')

@section('content')
<h2>Users</h2>

<table id="userList" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Mod Count</th>
        <th>Email</th>
        <th>Admin</th>
    </tr>
    </thead>

    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->modCount() }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->admin }} <a href="/users/toggleadmin/{{ $user->id }}">Toggle</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section('scripts');
    $(document).ready(function() {
        $('#userList').dataTable();
    } );
@endsection;