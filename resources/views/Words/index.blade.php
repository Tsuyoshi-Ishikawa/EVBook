<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="token" content="{{ csrf_token() }}">
  <title>Word index</title>
</head>
<body>
  <h1>登録された英単語一覧</h1>
  <div id="msg"></div>
  @if ($words)
    <table border="1">
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
</body>
