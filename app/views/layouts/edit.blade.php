@extends('layout')
@section('content')

<h1>New Layout</h1>

<ul>
@foreach ($scopes as $scope)
    <li> {{ $scope }}
@endforeach
</ul>

  {{ Form::model($layout, ['method' => 'PATCH', 'route' => ['layouts.update', $layout->id]]) }}

    @include('shared/errors')

    <ul>
      <li>
        {{ Form::label('name') }}
        {{ Form::text('name') }}
      </li>

      <li>
        {{ Form::label('content') }}
        {{ Form::textarea('content') }}
      </li>

      <li>
        {{ Form::submit('Save') }}
      </li>
    </ul>

  {{ Form::close() }}

@stop
