@extends('layouts.layout')
@section('title', '顧客追加')

@section('content')
<div class="container">
    <a href="{{ action('ClientsController@index') }}" class="btn btn-info btn-sm mb-2">一覧に戻る</a>
    <h1>顧客追加</h1>
    <form method="post" action="{{ action('ClientsController@create') }}" enctype="multipart/form-data">
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li><b><font color="red">{{ $error }}</font></b></li>
                @endforeach
            </ul>
        @endif
        
        <div class="form-group">
            <label>名前</label>
            <input type="text" class="form-control" name="pic_name">
        </div>
        <div class="form-group">
            <label>会社名</label>
            <input type="text" class="form-control" name="corp_name">
        </div>
        <div class="form-group">
            <label>電話番号</label>
            <input type="text" class="form-control" name="phone_number">
        </div>
        <div class="form-group">
            <label>メールアドレス</label>
            <input type="text" class="form-control" name="mail_address">
        </div>

        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" style="width:150px" value="追加">
    </form>
</div>
@endsection