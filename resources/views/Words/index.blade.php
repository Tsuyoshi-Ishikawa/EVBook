@extends('layouts.app')

@section('title', 'User page')

@section('content')
  <a href="{{route('Users.home') }}">戻る</a>

    @section('h3', '英単語一覧')
    <div id="msg"></div>
    @if ($words)
      <table border="1" class="table-stripped table-bordered mx-auto my-5 w-50">
      @foreach ($words as $word)
      <tr id="word_{{$word->id}}">
        <td>{{$word->English}}</td>
        <td>{{$word->Japanese}}</td>
        <td><span class="like_word" id="like_{{$word->id}}" data-id="{{$word->id}}">お気に入り登録</span></td>
      </tr>
      @endforeach
      </table>
    @endif

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>
  <script src="{{ asset('/js/main.js') }}"></script>
@endsection('content')
