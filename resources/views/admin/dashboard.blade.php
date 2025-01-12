@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>管理者ダッシュボード</h1>
        <div class="list-group">
            <a href="{{ route('admin.admin.reviews') }}" class="list-group-item list-group-item-action">レビュー管理</a>
            <a href="{{ route('admin.admin.users') }}" class="list-group-item list-group-item-action">ユーザーアカウント管理</a>
            <a href="{{ route('admin.admin.index') }}" class="list-group-item list-group-item-action">店舗管理</a>
        </div>
    </div>
@endsection
