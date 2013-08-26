@extends('layout')

@section('content')

 {{ TwigHelper::render('home/index.twig', $scopes) }}

@stop
