@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">検索結果</h1>

        <!-- 検索フォーム（再度表示） -->
        @include('stores.partials.search-form')

        <div class="row">
            <!-- 検索結果リスト -->
            <div class="col-md-12">
                @include('stores.partials.store-list', ['stores' => $stores])
            </div>
        </div>
    </div>
@endsection
