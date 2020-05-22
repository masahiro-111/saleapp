@extends('layouts.layout')
@section('title', 'アカウント追加')

@section('content')
<div class="container">
    <a href="{{ action('Admin\UsersController@index') }}" class="btn btn-info btn-sm mb-2">一覧に戻る</a>
    <h1>アカウント追加</h1>
    <form method="post" action="{{ action('Admin\UsersController@create') }}" enctype="multipart/form-data">
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li><b><font color="red">{{ $error }}</font></b></li>
                @endforeach
            </ul>
        @endif
        
        <div class="form-group">
            <label>名前</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>パスワード</label>
            <input type="password" class="form-control" name="password">
        </div>

        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" style="width:150px" value="追加">
    </form>
</div>
@endsection