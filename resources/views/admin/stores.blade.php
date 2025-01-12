@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <h1>店舗一覧</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.admin.stores.create') }}" class="btn btn-primary">新規登録</a>

    <table class="table">
        <thead>
            <tr>
                <th>店舗名</th>
                <th>カナ</th>
                <th>写真</th>
                <th>郵便番号</th>
                <th>住所</th>
                <th>定休日</th>
                <th>営業時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stores as $store)
                <tr>
                    <td><a href="{{ route('admin.admin.stores.edit', $store->id) }}">{{ $store->name }}</a></td>
                    <td>{{ $store->kana }}</td>
                    <td>
                        @if ($store->picture)
                            <img src="{{ asset('storage/' . $store->picture) }}" alt="{{ $store->name }}" style="width: 100px;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $store->postalcode }}</td>
                    <td>{{ $store->address }}</td>
                    <td>{{ $store->closeddays }}</td>
                    <td>{{ $store->openinghours }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $stores->links() }}
</div>
@endsection






