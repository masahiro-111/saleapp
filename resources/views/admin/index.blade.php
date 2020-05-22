@extends('layouts.layout')
@section('title', '案件一覧')

@section('content')
<div class="container">
    <h1>アカウント管理</h1>
    <a href="{{ action('Admin\UsersController@create') }}" class="btn btn-primary mb-2">アカウント追加</a>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ユーザー名</th>
                    <th>管理者権限</th>
                    <th> </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        @if($user->admin == true)
                            ○
                        @else
                            ×
                        @endif
                    </td>
                    <td>
                        <a href="{{ action('Admin\UsersController@edit', ['id' => $user->id]) }}" class="btn btn-info">変更</a>
                    </td>
                    <td>
                        <a href="{{ action('Admin\UsersController@pass_set', ['id' => $user->id]) }}" class="btn btn-danger">パスワードリセット</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection