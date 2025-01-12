@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>プロフィール編集</h1>

        <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="profile_picture">プロフィール画像</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                <!-- 現在のプロフィール写真がある場合は表示 -->
                @if ($profile->profile_picture)
                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" width="150">
                @endif
                <!-- エラーメッセージの表示 -->
                @error('profile_picture')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="bio">自己紹介</label>
                <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $profile->bio) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
@endsection
