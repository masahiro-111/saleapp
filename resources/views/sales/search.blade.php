@extends('layouts.layout')
@section('title', '案件検索フォーム')

@section('content')
<div class="container">
    <a href="{{ action('SalesController@index') }}" class="btn btn-info btn-sm mb-2">一覧に戻る</a>
    <h1>案件検索フォーム</h1>
    <form method="post" action="/sales/result">

    <!-- ↓↓↓↓↓↓↓↓↓↓↓↓↓テスト↓↓↓↓↓↓↓↓↓↓↓↓↓ -->
        
        <label>日付範囲指定</label>
        <div class="form-group form-inline">
        <a style="padding-left: 15px;　padding-right: 15px;">登録日：</a>
            <input type="date" class="form-control col-md-2" name="created_from" placeholder="from_date" style="padding-right: 15px;">
                <span class="mx-3 text-grey">〜</span>
            <input type="date" class="form-control col-md-2" name="created_until" placeholder="until_date" style="padding-right: 15px;">
        
        <a style="padding-left: 15px; padding-right: 15px;">更新日：</a>
            <input type="date" class="form-control col-md-2" name="updated_from" placeholder="from_date" style="padding-right: 15px;">
                <span class="mx-3 text-grey">〜</span>
            <input type="date" class="form-control col-md-2" name="updated_until" placeholder="until_date" style="padding-right: 15px;">
        </div>
    <!-- ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ -->

        <div class="form-group">
            <label>担当者</label>
            <select class="form-control" name="serach_pic_id">
                <option value="">-</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>顧客先</label>
            <select class="form-control" name="serach_client_id">
                <option value="">-</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->corp_name }} {{ $client->pic_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>案件名</label>
            <input type="text" class="form-control" name="serach_title">
        </div>
        <div class="form-group">
            <label>内容</label>
            <textarea class="form-control" name="serach_content"></textarea>
        </div>
        <div class="form-group">
            <label>場所</label>
            <input type="text" class="form-control" name="serach_location">
        </div>
        <div class="form-group">
            <label>必須スキル</label>
            <input type="text" class="form-control" name="serach_skill">
        </div>
        <div class="form-group">
            <label>期間</label>
            <input type="text" class="form-control" name="serach_term">
        </div>
        <div class="form-group">
            <label>提案する人</label>
            <input type="text" class="form-control" name="serach_proponent">
        </div>
        <div class="form-group">
            <label>備考欄</label>
            <textarea class="form-control" name="serach_note"></textarea>
        </div>
        <div class="form-group">
            <label>状況</label>
            <select class="form-control" name='serach_status'>
                <option value='' selected>指定せず</option>
                <option value='提案前'>提案前</option>
                <option value='提案中'>提案中</option>
                <option value='面談前'>面談前</option>
                <option value='結果待ち'>結果待ち</option>
                <option value='終了'>終了</option>
            </select>
        </div>
        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" value="検索">
    </form>
</div>
@endsection