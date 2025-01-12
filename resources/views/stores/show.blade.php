@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="display: flex; align-items: center;">
            <strong>店舗名：</strong> 
            <span style="margin-left: 10px;">{{ $store->name }}</span>

            <!-- お気に入り登録ボタン -->
            @auth
                @php
                    $isFavorite = Auth::user()->favorites()->where('store_id', $store->id)->exists();
                @endphp

                <button 
                    class="favorite-toggle btn btn-link" 
                    data-store-id="{{ $store->id }}" 
                    data-is-favorite="{{ $isFavorite }}" 
                    style="color: {{ $isFavorite ? 'gold' : 'gray' }}; font-size: 24px; padding: 20px;">
                    <i class="{{ $isFavorite ? 'fas fa-star' : 'far fa-star' }}"></i>
                </button>
            @endauth
        </h1>

        <p><strong>住所：</strong> {{ $store->address }}</p>
        <p><strong>営業時間：</strong> {{ $store->openinghours }}</p>
        <p><strong>定休日：</strong> {{ $store->closeddays }}</p>

        <!-- 店舗画像表示 -->
        @if ($store->picture)
            <div style="margin-top: 20px;">
                <img src="{{ asset('storage/' . $store->picture) }}" alt="{{ $store->name }}" style="max-width: 30%; height: auto;">
            </div>
        @else
            <p>画像はありません。</p>
        @endif

        <h2 style="margin-top: 20%">レビュー</h2>
        @if($store->reviews->isEmpty())
            <p>まだレビューはありません。</p>
        @else

        <h3 style="display: inline;">総合評価</h3>
        <p style="display: inline; margin-left: 10px;">
            @for ($i = 1; $i <= 5; $i++)
                @if($i <= floor($averageRating))
                    <i class="fas fa-star" style="color: gold;"></i>
                @elseif($i === ceil($averageRating) && $averageRating - floor($averageRating) > 0)
                    <i class="fas fa-star-half-alt" style="color: gold;"></i> <!-- 半分の星 -->
                @else
                    <i class="far fa-star" style="color: gray;"></i>
                @endif
            @endfor
        </p>
        
        <div class="list-group">
            @foreach($store->reviews as $review)
                <div class="list-group-item">
                    <h5>{{ $review->title }}</h5>
                    
                    <p>
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= floor($review->star_rating))
                                <i class="fas fa-star" style="color: gold;"></i>
                            @elseif($i === ceil($review->star_rating) && $review->star_rating - floor($review->star_rating) > 0)
                                <i class="fas fa-star-half-alt" style="color: gold;"></i> <!-- 半分の星 -->
                            @else
                                <i class="far fa-star" style="color: gray;"></i>
                            @endif
                        @endfor
                    </p>
                        
                        <p>{{ $review->content }}</p>
                        <p><small>レビュー者: {{ $review->user->name }}</small></p>
                        <p><small>投稿日: {{ $review->created_at->format('Y-m-d') }}</small></p>
                    </div>
                @endforeach
            </div>
        @endif
        

        <!-- レビュー作成へのリンク -->
        <a href="{{ route('reviews.create', $store->id) }}" class="btn btn-primary mt-3">レビューを投稿する</a>
    </div>

    <!-- CSRFトークンを含める -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- JavaScriptコード -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            document.querySelectorAll('.favorite-toggle').forEach(function(button) {
                button.addEventListener('click', function() {
                    var storeId = this.getAttribute('data-store-id');
                    var isFavorite = this.getAttribute('data-is-favorite') === 'true';

                    var url = isFavorite ? 
                    '{{ route('favorites.destroy') }}' : 
                    '{{ route('favorites.store') }}';
                
                    // POSTメソッドでリクエスト
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ store_id: storeId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // アイコンと色を更新
                            var icon = isFavorite ? 'far fa-star' : 'fas fa-star';
                            var color = isFavorite ? 'gray' : 'gold';
                            button.querySelector('i').className = icon;
                            button.style.color = color;
                            button.setAttribute('data-is-favorite', !isFavorite);
                        } else {
                            alert('エラーが発生しました。' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('エラー:', error);
                    });
                });
            });
        });
    </script>
@endsection

