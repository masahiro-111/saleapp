@extends('layouts.layout')
@section('title', 'パスワードリセット')

@section('content')
<div class="container">
    <a href="{{ action('Admin\UsersController@index') }}" class="btn btn-info btn-sm mb-2">一覧に戻る</a>
    <h1>パスワードリセット</h1>
    <form method="post" action="{{ action('Admin\UsersController@pass_reset') }}" enctype="multipart/form-data">
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li><b><font color="red">{{ $error }}</font></b></li>
                @endforeach
            </ul>
        @endif
        
    <h4>選択ユーザー：{{ $users->name }}</h4>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" class="form-control" name="password">
        </div>

        <!-- hidden属性 -->
        <input type="hidden" name="id" value="{{ $users->id }}">
        <input type="hidden" name="name" value="{{ $users->name }}">
        <!-- !!!!!!!!!! -->
        
        {{ csrf_field() }}
        <button type="button" class="btn btn-danger" style="width:150px" data-toggle="modal" data-target="#modal1">変更</button>
        <!-- ↓モーダル表示部分↓ -->
        <div class="modal fade" id="modal1" tabindex="-1"　role="dialog" aria-labelledby="label1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="label1">確認</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        本当に変更しますか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <input type="submit" class="btn btn-danger" value="変更">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection