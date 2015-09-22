@extends ('template.master')

@section('content')
<h3>Blocks</h3>
<table id="blockList" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Block Name</th>
        <th>Core</th>
        <th>Created By</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>
    @foreach($blocks as $block)
        <tr>
            <td>{{ $block->name }}</td>
            <td>@if($block->core)
                <i class='fa fa-check'></i>
                @endif
            </td>
            <td>{{ $block->user->name }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/blocks/show/{{ $block->id }}">View</a></li>
                        @if(isset($user))
                        <li><a href="/blocks/edit/{{ $block->id }}">Edit</a></li>
                        <li><a href="/blocks/clone/{{ $block->id }}">Clone</a></li>
                        @endif
                        @if(isset($user) && $block->user_id==$user->id)
                        <li><a href="/blocks/delete/{{ $block->id }}">Delete</a></li>
                        @endif
                    </ul>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section('scripts');
$(document).ready(function() {
$('#blockList').dataTable();
} );
@endsection;
