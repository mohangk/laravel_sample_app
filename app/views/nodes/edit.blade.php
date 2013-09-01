@extends('layout')
@section('content')

<h1>Edit Node</h1>
{{ Form::model($node, ['method' => 'PATCH', 'route' => ['nodes.update', $node->id]]) }}

  @include('shared/errors')
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description') }}
        </li>

        <li>
            {{ Form::label('layout_id', 'Layout_id:') }}
            {{ Form::input('number', 'layout_id') }}
        </li>

        <li>
            {{ Form::label('parent_id', 'Parent_id:') }}
            {{ Form::input('number', 'parent_id') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('nodes.show', 'Cancel', $node->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
