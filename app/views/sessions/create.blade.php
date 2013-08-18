@extends('layout')

@section('content')

  {{ Form::open([ 'url' => URL::to('sign-in'),
                  'method' => 'post' ]) }}

    <ul>
      <li>
        {{ Form::label('email') }}
        {{ Form::email('email') }}
      </li>

      <li>
        {{ Form::label('password') }}
        {{ Form::password('password') }}
      </li>

      <li>
        {{ Form::submit('Sign In') }}
      </li>
    </ul>

    </hr>

    <footer>
      Sign in with "some other auth service".
    </footer>
  {{ Form::close() }}

@stop
