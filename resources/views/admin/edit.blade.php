@extends('layouts.layout')
@section('title', 'アカウント情報変更')

@section('content')
<div class="container">
    <a href="{{ action('Admin\UsersController@index') }}" class="btn btn-info btn-sm mb-2">一覧に戻る</a>
    <h1>アカウント情報変更</h1>
    <form method="post" action="{{ action('Admin\UsersController@update') }}" enctype="multipart/form-data">
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li><b><font color="red">{{ $error }}</font></b></li>
                @endforeach
            </ul>
        @endif

        <div class="form-group">
            <label>名前</label>
            <input type="text" class="form-control" name="name" value="{{ $users->name }}">
        </div>

        <div class="form-group">
            <label>管理者権限</label>
            <input type="hidden" name="admin" value="0">
            <input type="checkbox" name="admin" value="1"
                @if($users->admin == true)
                    checked
                @endif
            >
        </div>

        <!-- hidden属性 -->
        <input type="hidden" value="{{ $users->password }}" name="password">
        <input type="hidden" name="id" value="{{ $users->id }}">
        <!-- !!!!!!!!!! -->
        
        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" style="width:150px" value="変更">
        <button type="button" class="btn btn-danger" style="width:150px" data-toggle="modal" data-target="#modal1">削除</button>
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
                        本当に削除しますか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <a href="{{ action('Admin\UsersController@delete', ['id' => $users->id]) }}">
                            <button type="button" class="btn btn-danger">OK</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection