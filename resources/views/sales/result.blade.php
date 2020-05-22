@extends('layouts.layout')
@section('title', '検索結果')

@section('content')
<div class="container-fluid">
    <a href="{{ action('SalesController@search') }}" class="btn btn-info btn-sm mb-2">検索画面に戻る</a>
    <h1>検索結果</h1>
    <h5>該当件数：{{ $count }}件</h5>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>案件名</th>
                    <th>状況</th>
                    <th>場所</th>
                    <th>顧客先</th>
                    <th>担当</th>
                    <th>登録日</th>
                    <th>更新日</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->title }}</td>
                        <td>
                            @if( $sale->status == '提案前')
                                <h4><div class="badge badge-primary">{{ $sale->status }}</div></h4>
                            @elseif( $sale->status == '提案中')
                                <h4><div class="badge badge-warning">{{ $sale->status }}</div></h4>
                            @elseif( $sale->status == '面談前')
                                <h4><div class="badge badge-success">{{ $sale->status }}</div></h4>
                            @elseif( $sale->status == '結果待ち')
                                <h4><div class="badge badge-danger">{{ $sale->status }}</div></h4>                      
                            @elseif( $sale->status == '終了')
                                <h4><div class="badge badge-dark">{{ $sale->status }}</div></h4>
                            @endif
                        <td>{{ $sale->location }}</td>
                        <td>{{ $sale->corp_name }} {{ $sale->pic_name }}</td>
                        <td>{{ $sale->name }}</td>
                        <td>{{ $sale->created_at->format('Y/m/d H:i') }}</td>
                        <td>{{ $sale->updated_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <a href="{{ action('SalesController@edit', ['id' => $sale->id]) }}" class="btn btn-info btn-sm">詳細</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- ページネーション -->
        {{ $sales->links() }}
    </div>
</div>
@endsection