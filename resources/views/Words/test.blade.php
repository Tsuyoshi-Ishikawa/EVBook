@extends('layouts.app')

@section('title', 'Words test')

@section('content')
  <h1>テスト実施ページ</h1>
  <p>{{ $rand_word->English }}の訳はなんですか？</p>

  <p id="answer" style="display:none;">答えは{{ $rand_word->Japanese }}です</p>
  <button id="answer_btn">答えをみる</button>
  <a href="{{ url('/words/test') }}">次の問題へ</a>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>
  <script src="{{ asset('/js/main.js') }}"></script>
@endsection('content')