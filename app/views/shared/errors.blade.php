@if ($errors->any())
  <ul class="errors">
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
  </ul>
@endif
