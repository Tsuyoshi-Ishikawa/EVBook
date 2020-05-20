@extends('layouts.app')

@section('title', 'Edit Word')

@section('content')
  @section('h3', '英単語編集')
  @include('layouts.wordform', ['url' => route('Words.update',  ['id' => $word->id]), 'method' => 'PUT','En_input_Value' => old('English', $word->English), 'Ja_input_Value' => old('Japanese', $word->Japanese), 'submit_value' => "編集登録"])
@endsection('content')