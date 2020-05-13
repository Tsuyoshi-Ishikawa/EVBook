@extends('layouts.app')

@section('title', 'Show words')

@section('content')
  <h1>ユーザーページ</h1>
  <p>{{ $currentUser->name }}</p>
  <table border="1">
  @forelse ($User_words as $word)
      @if ($word->user_id === $currentUser->id)
      <tr id="word_{{$word->id}}">
        <td>{{$word->English}}</td>
        <td>{{$word->Japanese}}</td>
        <td><a href="{{ action('WordsController@edit', $word)}}">編集</a></td>
        <td><span class="delete_word" data-id="{{$word->id}}" >X</span></td>
      </tr>
      @else
      <tr>
        <td>{{$word->English}}</td>
        <td>{{$word->Japanese}}</td>
        <td>
          <span class="like_word after_favo" id="like_{{$word->id}}" data-id="{{$word->id}}">お気に入り解除
          </span>
        </td>
        <td></td>
      </tr>
      @endif
  @empty
    <p>no English Word</p>
  @endforelse
  </table>
  
  

  <a href="{{ url('/words/create') }}">英単語登録ページ</a>
  <a href="{{ url('/words/test') }}">英単語テストページ</a>
  <a href="{{ url('/words/index') }}">英単語投稿一覧</a>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->
  <script src="{{ asset('/js/main.js') }}"></script>
@endsection('content')