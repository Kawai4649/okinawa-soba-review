@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <h1>新規店舗登録</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.admin.stores') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">店舗名</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="kana">店舗名（カタカナ）</label>
            <input type="text" name="kana" id="kana" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="picture">店舗の写真</label>
            <input type="file" id="picture" name="picture" class="form-control"required>
        </div>

        <div class="form-group">
            <label for="postalcode">郵便番号</label>
            <input type="text" name="postalcode" id="postalcode" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="closeddays">定休日</label>
            <input type="text" name="closeddays" id="closeddays" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="openinghours">営業時間</label>
            <input type="text" name="openinghours" id="openinghours" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection
