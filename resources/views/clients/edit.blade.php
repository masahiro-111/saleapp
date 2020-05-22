@extends('layouts.layout')
@section('title', '顧客情報変更')

@section('content')
<div class="container">
    <a href="{{ action('ClientsController@index') }}" class="btn btn-info btn-sm mb-2">一覧に戻る</a>
    <h1>顧客情報変更</h1>
    <form method="post" action="{{ action('ClientsController@update') }}" enctype="multipart/form-data">
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li><b><font color="red">{{ $error }}</font></b></li>
                @endforeach
            </ul>
        @endif

        <div class="form-group">
            <label>名前</label>
            <input type="text" class="form-control" name="pic_name" value="{{ $clients->pic_name }}">
        </div>
        <div class="form-group">
            <label>会社名</label>
            <input type="text" class="form-control" name="corp_name" value="{{ $clients->corp_name }}">
        </div>
        <div class="form-group">
            <label>電話番号</label>
            <input type="text" class="form-control" name="phone_number" value="{{ $clients->phone_number }}">
        </div>
        <div class="form-group">
            <label>メールアドレス</label>
            <input type="text" class="form-control" name="mail_address" value="{{ $clients->mail_address }}">
        </div>

        <!-- hidden属性 -->
        <input type="hidden" name="id" value="{{ $clients->id }}">
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
                        <a href="{{ action('ClientsController@delete', ['id' => $clients->id]) }}">
                            <button type="button" class="btn btn-danger">OK</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection