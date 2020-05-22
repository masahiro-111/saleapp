@extends('layouts.layout')
@section('title', '案件詳細フォ−ム')

@section('content')
<div class="container">
    <a href="{{ action('SalesController@index') }}" class="btn btn-info btn-sm mb-2">一覧に戻る</a>
    <h1>案件詳細フォーム</h1>
    <form method="post" action="{{ action('SalesController@update') }}" enctype="multipart/form-data">
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li><b><font color="red">{{ $error }}</font></b></li>
                @endforeach
            </ul>
        @endif

        <input type="hidden" name="id" value="{{ $sales->id }}">

        <div class="form-group">
            <label>担当者</label><font color="red">　修正する場合は選択</font>
            <select class="form-control" name="pic_id">
                <option value="{{ $sales->pic_id }}" selected>設定中：{{ $sales->name }}</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>顧客先</label><font color="red">　修正する場合は選択</font>
            <select class="form-control" name="client_id">
                <option value="{{ $sales->client_id }}" selected>設定中：{{ $sales->corp_name }} {{ $sales->pic_name }}</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->corp_name }} {{ $client->pic_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>案件名</label>
            <input type="text" class="form-control" name="title" value="{{ $sales->title }}">
        </div>
        <div class="form-group">
            <label>内容</label>
            <textarea class="form-control" name="content" style="height: 300px">{{ $sales->content }}</textarea>
        </div>
        <div class="form-group">
            <label>場所</label>
            <input type="text" class="form-control" name="location" value="{{ $sales->location }}">
        </div>
        <div class="form-group">
            <label>必須スキル</label>
            <input type="text" class="form-control" name="skill" value="{{ $sales->skill }}">
        </div>
        <div class="form-group">
            <label>期間</label>
            <input type="text" class="form-control" name="term" value="{{ $sales->term }}">
        </div>
        <div class="form-group">
            <label>提案する人</label>
            <input type="text" class="form-control" name="proponent" value="{{ $sales->proponent }}">
        </div>
        <div class="form-group">
            <label>備考欄</label>
            <textarea class="form-control" name="note">{{ $sales->note }}</textarea>
        </div>
        <div class="form-group">
            <label>状況</label>
            @if( $sales->status == '提案前')
                <select class="form-control" name='status'>
                    <option value='提案前' selected>提案前</option>
                    <option value='提案中'>提案中</option>
                    <option value='面談前'>面談前</option>
                    <option value='結果待ち'>結果待ち</option>
                    <option value='終了'>終了</option>
                </select>
            @elseif( $sales->status == '提案中')
                <select class="form-control" name='status'>
                    <option value='提案前'>提案前</option>
                    <option value='提案中' selected>提案中</option>
                    <option value='面談前'>面談前</option>
                    <option value='結果待ち'>結果待ち</option>
                    <option value='終了'>終了</option>
                </select>
            @elseif( $sales->status == '面談前')
                <select class="form-control" name='status'>
                    <option value='提案前'>提案前</option>
                    <option value='提案中'>提案中</option>
                    <option value='面談前' selected>面談前</option>
                    <option value='結果待ち'>結果待ち</option>
                    <option value='終了'>終了</option>
                </select>
            @elseif( $sales->status == '結果待ち')
                <select class="form-control" name='status'>
                    <option value='提案前'>提案前</option>
                    <option value='提案中'>提案中</option>
                    <option value='面談前'>面談前</option>
                    <option value='結果待ち' selected>結果待ち</option>
                    <option value='終了'>終了</option>
                </select>
            @elseif( $sales->status == '終了')
                <select class="form-control" name='status'>
                    <option value='提案前'>提案前</option>
                    <option value='提案中'>提案中</option>
                    <option value='面談前'>面談前</option>
                    <option value='結果待ち'>結果待ち</option>
                    <option value='終了' selected>終了</option>
                </select>
            @endif
        </div>
        
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
                        <a href="{{ action('SalesController@delete', ['id' => $sales->id]) }}">
                            <button type="button" class="btn btn-danger">OK</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ↑↑↑↑↑↑↑↑↑↑ -->
    </form>
</div>
@endsection