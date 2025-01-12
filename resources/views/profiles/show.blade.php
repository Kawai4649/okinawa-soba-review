@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>プロフィール</h1>

        <div class="card">
            <div class="card-body">
                @if($profile && $profile->profile_picture)
                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" width="150">
                @else
                    <p>プロフィール写真がありません。</p>
                @endif

                <p><strong>自己紹介:</strong></p>
                <p>{{ $profile->bio ?? '自己紹介でみんなに自分を知ってもらおう！' }}</p>

                <a href="{{ route('profiles.edit') }}" class="btn btn-primary">編集</a>
            </div>
        </div>
    </div>
@endsection
