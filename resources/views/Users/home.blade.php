@extends('layouts.app')

@section('title', 'User page')

@section('content')
  @section('h3', 'ユーザーページ')

  <div>
    <div id="msg"></div>
    <table border="1" class="table-stripped table-bordered mx-auto my-5 w-50">
    @forelse ($User_words as $word)
        @if ($word->user_id === $currentUser->id)
        <tr id="word_{{$word->id}}">
          <td>{{$word->English}}</td>
          <td>{{$word->Japanese}}</td>
          <td><a href="{{ action('WordsController@edit', $word)}}">編集</a></td>
          <td><span class="delete_word" data-id="{{$word->id}}" id=del_btn>X</span></td>
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
    

    <div class="w-50 mx-auto">
      <div class="d-flex justify-content-between">
        <a class="btn-sm btn-primary" href="{{ url('/words/create') }}">英単語登録ページ</a>
        <a class="btn-sm btn-primary" href="{{ url('/words/test') }}">英単語テストページ</a>
        <a class="btn-sm btn-primary" href="{{ url('/words/index') }}">英単語投稿一覧</a>
      </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>
  <script src="{{ asset('/js/main.js') }}"></script>
@endsection('content')