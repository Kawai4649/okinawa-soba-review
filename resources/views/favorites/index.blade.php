@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>お気に入りリスト</h1>

        @if($favorites->isEmpty())
            <p>お気に入り店舗がありません。</p>
        @else
            <ul>
                @foreach($favorites as $favorite)
                    <li>
                        {{ $favorite->store->name }} - {{ $favorite->store->address }}
                        <!-- 店舗情報へのリンク -->
                        <a href="{{ route('stores.show', $favorite->store_id) }}">詳細</a>

                        <!-- 削除ボタン -->
                        <button class="remove-favorite-btn" data-store-id="{{ $favorite->store_id }}" style="
                            background-color: #00BFFF;
                            color: white;
                            border: none;
                            border-radius: 8px; 
                            padding: 10px 15px;
                            font-size: 16px;
                            cursor: pointer;
                            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                            transition: background-color 0.3s ease, transform 0.2s ease;">
                            削除
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            document.querySelectorAll('.remove-favorite-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var storeId = this.getAttribute('data-store-id');

                    fetch('/favorites/delete', {
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
                            // 成功した場合、リストから削除
                            this.parentElement.remove();
                        } else {
                            alert('エラーが発生しました。');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
        });
    </script>
@endsection

