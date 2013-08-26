@extends('layout')

@section('content')
<h1>
  layout Creator
</h1>

<ul>
@foreach ($scopes as $scope)
    <li> {{ $scope }}
@endforeach
</ul>

  {{ Form::model($layout, [ 'route' => ['layouts.store']]) }}

    @include('shared/errors')

    <ul>
      <li>
        {{ Form::label('name') }}
        {{ Form::text('name') }}
      </li>

      <li>
        {{ Form::label('content') }}
        {{ Form::textarea('content', null, ['cols' => 80, 'rows' => 60]) }}
      </li>

      <li>
        {{ Form::submit('Save') }}
      </li>
    </ul>

  {{ Form::close() }}

@stop
