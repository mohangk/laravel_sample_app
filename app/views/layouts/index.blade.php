@extends('layout')

@section('content')

<h1>All Layouts</h1>

<p>{{ link_to_route('layouts.create', 'Add new layout') }}</p>

@if ($layouts->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Used by</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($layouts as $layout)
				<tr>
					<td>{{{ $layout->name }}}</td>
          <td> {{
                 join(',', array_map(function($n) { return link_to_route('nodes.show', $n->name, [$n->id]); }, $layout->nodes->all()))
               }}
          </td>
          <td>{{ link_to_route('layouts.edit', 'Edit', array($layout->id), array('class' => 'btn btn-info')) }}</td>
          <td>
              {{ Form::open(array('method' => 'DELETE', 'route' => array('layouts.destroy', $layout->id))) }}
                  {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
              {{ Form::close() }}
          </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no layouts
@endif

@stop
