<!-- resources/views/stores/partials/search-form.blade.php -->
<form action="{{ route('stores.results') }}" method="GET">
    <div class="form-group">
        <label for="query">検索クエリ:</label>
        <input type="text" id="query" name="query" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">検索</button>
</form>
