@extends('layout')

@section('content')
<h1>
  Page Creator
</h1>

<ul>
@foreach ($scopes as $scope)
    <li> {{ $scope }}
@endforeach
</ul>

  {{ Form::model($page, [ 'route' => ['page.update', $page->id]]) }}

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
