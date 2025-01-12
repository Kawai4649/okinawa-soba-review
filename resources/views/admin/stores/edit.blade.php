@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>店舗情報更新</h1>
        <form action="{{ route('admin.admin.stores.update', $store->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">店舗名</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $store->name }}" required>
            </div>
            <div class="form-group">
                <label for="picture">店舗の写真</label>
                <input type="file" id="picture" name="picture" class="form-control"value="{{ $store->picture }}">
            </div>
            <div class="form-group">
                <label for="postalcode">郵便番号</label>
                <input type="text" name="postalcode" id="postalcode" class="form-control"value="{{ $store->postalcode }}" required>
            </div>
            <div class="form-group">
                <label for="address">住所</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ $store->address }}" required>
            </div>
            <div class="form-group">
                <label for="closeddays">定休日</label>
                <input type="text" name="closeddays" id="closeddays" class="form-control"value="{{ $store->closeddays }} "required>
            </div>
            <div class="form-group">
                <label for="opening_hours">営業時間</label>
                <input type="text" id="openinghours" name="opening_hours" class="form-control" value="{{ $store->openinghours }}"required>
            </div>
            <div class="form-group">
                <label for="latitude">緯度</label>
                <input type="text" id="latitude" name="latitude" class="form-control"value="{{ $store->latitude }}"required>
            </div>
            <div class="form-group">
                <label for="longitude">経度</label>
                <input type="text" id="longitude" name="longitude" class="form-control"value="{{ $store->longitude }}"required>
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>

        <!-- 削除フォーム -->
        <form action="{{ route('admin.admin.stores.destroy', $store->id) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
    </div>
@endsection
