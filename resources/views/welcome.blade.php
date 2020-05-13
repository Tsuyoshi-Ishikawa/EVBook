<!-- <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
</head>
<body>
  <h1>English Vocabulary Book</h1>
  <h3>説明</h3>
  <p>このアプリでは....</p>

  <a href="{{ route('register') }}">新規登録</a>
  <a href="{{ route('login') }}">ログイン</a>
</body>
</html> -->

@extends('layouts.app')

@section('title', 'Welcome app')

@section('content')
  <h1>English Vocabulary Book</h1>
  <h3>説明</h3>
  <p>このアプリでは....</p>
  <a href="{{ route('register') }}">新規登録</a>
  <a href="{{ route('login') }}">ログイン</a>
@endsection('content')