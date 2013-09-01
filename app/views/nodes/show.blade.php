@extends('layout')
@section('content')
 {{ TwigHelper::render($node->layout->name, $scopes) }}
@stop
