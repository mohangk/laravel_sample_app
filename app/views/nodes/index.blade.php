@extends('layouts.scaffold')

@section('main')

<h1>All Nodes</h1>

<p>{{ link_to_route('nodes.create', 'Add new node') }}</p>

@if ($nodes->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Layout_id</th>
				<th>Parent_id</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($nodes as $node)
				<tr>
					<td>{{{ $node->name }}}</td>
					<td>{{{ $node->description }}}</td>
					<td>{{{ $node->layout_id }}}</td>
					<td>{{{ $node->parent_id }}}</td>
                    <td>{{ link_to_route('nodes.edit', 'Edit', array($node->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('nodes.destroy', $node->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no nodes
@endif

@stop
