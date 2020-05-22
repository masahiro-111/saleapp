@extends('layouts.layout')
@section('title', '案件一覧')

@section('content')
<div class="container-fluid">
    <h1>案件一覧</h1>
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
                    <th>　</th>
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
                    </td>
                    <td>{{ $sale->location }}</td>
                    <td>{{ $sale->corp_name }} {{ $sale->pic_name }}</td>
                    <td>{{ $sale->name }}</td>
                    <td>{{ date('Y年m月d日 H:i',strtotime($sale->created_at)) }}</td>
                    <td>{{ date('Y年m月d日 H:i',strtotime($sale->updated_at)) }}</td>
                    <td>
                        <a href="{{ action('SalesController@edit', ['id' => $sale->id]) }}" class="btn btn-info btn-sm">詳細</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $sales->links() }}
    </div>
</div>
@endsection