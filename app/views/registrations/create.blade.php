@extends('layout')

@section('content')

  <form method="POST" action ="{{ URL::to('signup') }}">
    <p><input type="text" id="name" name="name" placeholder="name"/></p>
    <p><input type="text" id="email" name="email" placeholder="email"/></p>
    <p><input type="password" id="password" name="password"/></p>
    <p><input type="password" id="password_confirmation" name="password_confirmation"/></p>
    <p><input type="submit" value="Log In"/></p>
  </form>

@stop
