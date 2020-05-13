<form action="{{ $url }}" method="post">
@method($method)
  @csrf
  @error ("English")
  <p>{{ $message }}</p>
  @enderror
  <p>
    <label>英語：
    <input type="text" name="English" id="" value = "{{ $En_input_Value }}">
    </label>
  </p>
  @error ("Japanese")
  <p>{{ $message }}</p>
  @enderror
  <p>
    <label>日本語：
    <input type="text" name="Japanese" id="" value = "{{ $Ja_input_Value }}">
    </label>
  </p>

<input type="submit" value="{{$submit_value}}">
</form>