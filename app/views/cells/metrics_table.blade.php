<h1>
{{$title}}
</h1>

<table>
  <thead>
    <tr>
      <th>Date</th>
      <th>Count</th>
    <tr>
  </thead>
  <tbody>
    @foreach($items as $item)
      <tr>
        <td>{{ $item->date->format("d/m/y") }}</td>
        <td>{{ $item->count }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

