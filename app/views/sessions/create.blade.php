@extends('layout')

@section('content')

  <form method="POST" action ="{{ URL::to('sign-in') }}">
    <p><input type="text" id="email" name="email" placeholder="email"/></p>
    <p><input type="password" id="password" name="password"/></p>
    <p><input type="submit" value="Sign In"/></p>
  </form>

@stop
