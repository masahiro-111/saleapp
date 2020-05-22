@extends('layouts.layout')
@section('title', '案件追加フォーム')

@section('content')
<div class="container">
    <a href="{{ action('SalesController@index') }}" class="btn btn-info btn-sm mb-2">一覧に戻る</a>
    <h1>案件追加フォーム</h1>
    <form method="post" action="{{ action('SalesController@create') }}" enctype="multipart/form-data">
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li><b><font color="red">{{ $error }}</font></b></li>
                @endforeach
            </ul>
        @endif
        
        <div class="form-group">
            <label>担当者</label>
            <select class="form-control" name="pic_id">
                <option value="{{ Auth::user()->id }}">選択中：{{ Auth::user()->name }}（担当が違う場合は、リストから選択する。）</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>顧客先</label>
            <b><font color="red">※必須</font></b>
            <select class="form-control" name="client_id">
                <option value="">-</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->corp_name }} {{ $client->pic_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>案件名</label>
            <b><font color="red">※必須</font></b>
            <input type="text" class="form-control" name="title" placeholder="例：書店予約サイト開発案件">
        </div>
        <div class="form-group">
            <label>内容</label>
            <b><font color="red">※必須</font></b>
            <textarea class="form-control" name="content" rows="4" style="height: 300px" placeholder="※客先から連絡されてきた内容をそのまま記入ください。
↓↓↓↓以下例↓↓↓↓
面 談:1回
就業時期:即日～長期
就業時間:10:00-19:00
【案件概要】
PHP開発案件
【業務内容】
書店の予約サイトの開発">
            </textarea>
        </div>
        <div class="form-group">
            <label>場所</label>
            <b><font color="red">※必須</font></b>
            <input type="text" class="form-control" name="location" placeholder="例：池袋">
        </div>
        <div class="form-group">
            <label>スキル</label>
            <b><font color="red">※必須</font></b>
            <input type="text" class="form-control" name="skill" placeholder="例：PHPの開発経験2年以上　Laravelの開発経験">
        </div>
        <div class="form-group">
            <label>期間</label>
            <b><font color="red">※必須</font></b>
            <input type="text" class="form-control" name="term" placeholder="例：即日〜長期">
        </div>
        <div class="form-group">
            <label>提案する人</label>
            <input type="text" class="form-control" name="proponent" placeholder="田中 太郎、案件 花子">
        </div>
        <div class="form-group">
            <label>備考欄</label>
            <textarea class="form-control" name="note" placeholder="メモ欄としてお使いください"></textarea>
        </div>
        <div class="form-group">
            <label>状況</label>
            <select class="form-control" name='status'>
                <option value='提案前' selected>提案前</option>
                <option value='提案中'>提案中</option>
                <option value='面談前'>面談前</option>
                <option value='結果待ち'>結果待ち</option>
                <option value='終了'>終了</option>
            </select>
        </div>

        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" style="width:150px" value="追加">
    </form>
</div>
@endsection