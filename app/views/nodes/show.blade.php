@extends('layouts.scaffold')

@section('main')

<h1>Show node</h1>

<p>{{ link_to_route('nodes.index', 'Return to all nodes') }}</p>

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
	</tbody>
</table>

@stop
