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
  @include('cells/metrics_table',['title' => 'Unique visitors:', 'items' => $uniqueVisitorsByDate])
  </br>
  @include('cells/metrics_table',['title' => 'Pageviews:', 'items' => $pageviewsByDate])

@stop
