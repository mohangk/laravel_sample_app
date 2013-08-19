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
      Or, sign in with Google
      <a href="{{ URL::route('hybridauth') }}" title="Sign in with Google">
        <img src="{{ asset('/assets/images/icon-google.png') }}" alt="google icon" title="google" />
      </a>
    </footer>
  {{ Form::close() }}

@stop
