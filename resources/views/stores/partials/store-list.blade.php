<!-- resources/views/stores/partials/store-list.blade.php -->

<ul class="list-group">
    @forelse ($stores as $store)
        <li class="list-group-item">
            <!-- 店舗名をクリックすると店舗詳細ページに遷移 -->
            <a href="{{ route('stores.show', $store->id) }}">{{ $store->name }}</a>
            <p>{{ $store->address }}</p>
        </li>
    @empty
        <li class="list-group-item">検索結果が見つかりませんでした。</li>
    @endforelse
</ul>
