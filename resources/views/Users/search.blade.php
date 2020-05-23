@extends('layouts.app')

@section('title', 'Search User')

@section('content')
  @section('h3', 'ユーザー検索')
  <a href="{{route('Users.home') }}">戻る</a>
  
  <div id="msg" class="text-center"></div>

  <div class="text-center mx-auto">
    <p>
      <input type="text" name="user_name" id="search_word" value="{{old('user_name')}}" >
    </p>
    <div class="btn-sm btn-primary w-25 mx-auto" id="search">
      検索
    </div>
  </div>
@endsection('content')