@extends('layout')

@section('content')

  {{ Form::open([ 'url' => URL::to('sign-up'), 'method' => 'post' ]) }}
    <ul>
      <li>
        {{ Form::label('name') }}
        {{ Form::text('name') }}
      </li>
      <li>
        {{ Form::label('email') }}
        {{ Form::email('email') }}
      </li>
      <li>
        {{ Form::label('password') }}
        {{ Form::password('password') }}
      </li>
      <li>
        {{ Form::submit('Sign Up') }}
      </li>
    </ul>
  {{ Form::close() }}

@stop
