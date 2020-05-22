@extends('layouts.layout')
@section('title', '顧客一覧')

@section('content')
<div class="container">
    <h1>顧客一覧</h1>
    <a href="{{ action('ClientsController@create') }}" class="btn btn-primary mb-2">顧客追加</a>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>所属会社</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->pic_name }}</td>
                    <td>{{ $client->corp_name }}</td>
                    <td>{{ $client->phone_number }}</td>
                    <td>{{ $client->mail_address }}</td>
                    <th>
                    <a href="{{ action('ClientsController@edit', ['id' => $client->id]) }}" class="btn btn-info">詳細</a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection