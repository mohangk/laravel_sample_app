@extends('layout')

@section('content')

  <h1>
    Users:
  </h1>

  <table>
    <thead>
      <tr>
        <th>id</th>
        <th>email</th>
        <th>name</th>
        <th>updated at</th>
        <th>created at</th>
      <tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->created_at->format("d/m/y") }}</td>
          <td>{{ $user->updated_at->format("d/m/y") }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  </br>

  <h1>
    Unique visitors:
  </h1>

  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Count</th>
      <tr>
    </thead>
    <tbody>
      @foreach($uniqueVisitorsByDate as $uniqueVisitors)
        <tr>
          <td>{{ $uniqueVisitors->date->format("d/m/y") }}</td>
          <td>{{ $uniqueVisitors->count }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  </br>

  <h1>
   Pageviews:
  </h1>

  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Count</th>
      <tr>
    </thead>
    <tbody>
      @foreach($pageviewsByDate as $uniqueVisitors)
        <tr>
          <td>{{ $uniqueVisitors->date->format("d/m/y") }}</td>
          <td>{{ $uniqueVisitors->count }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
