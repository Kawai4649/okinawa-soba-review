@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">店舗検索</h1>

        <!-- 検索フォーム -->
        @include('stores.partials.search-form')
    
        <!-- 検索結果が表示されるリンク -->
        @if(request()->has('query') || request()->has('category') || request()->has('area'))
            <a href="{{ route('stores.results') }}" class="btn btn-info">検索結果を見る</a>
        @endif
    </div>
@endsection


