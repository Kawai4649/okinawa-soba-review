@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>レビュー管理</h1>

        @if($reviews->isEmpty())
            <p>レビューはありません。</p>
        @else
            <div class="list-group">
                @foreach($reviews as $review)
                    <div class="list-group-item">
                        <p><strong>店舗名: {{ $review->store->name }}</strong></p>
                        <h5>{{ $review->title }}</h5>
                        <p>評価: {{ $review->star_rating }} 星</p>
                        <p>{{ $review->content }}</p>
                        <p><small>レビュー者: {{ $review->user->name }}</small></p>
                        <p><small>投稿日: {{ $review->date }}</small></p>

                        <!-- 削除ボタン -->
                        <form action="{{ route('admin.admin.reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection

