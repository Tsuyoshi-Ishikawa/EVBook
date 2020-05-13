@extends('layouts.app')

@section('title', 'Edit Word')

@section('content')
  @include('layouts.wordform', ['url' => action('WordsController@update', $word), 'method' => 'PUT','En_input_Value' => old('English', $word->English), 'Ja_input_Value' => old('Japanese', $word->Japanese), 'submit_value' => "編集登録"])
@endsection('content')