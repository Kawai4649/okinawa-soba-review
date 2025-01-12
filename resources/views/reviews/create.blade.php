@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>レビューを作成する</h1>

        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf

            <input type="hidden" name="store_id" value="{{ $store->id }}">

            <div class="star-rating">
                <label for="title">評価</label>
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star" data-value="{{ $i }}">
                        <i class="far fa-star"></i>
                    </span>
                @endfor
            </div>
            <input type="hidden" name="star_rating" id="star-rating-input" value="0">
            
            <style>
                .star-rating {
                    display: flex;
                    cursor: pointer;
                }
                .star {
                    font-size: 24px;
                    transition: color 0.3s ease;
                }
                .star i {
                    color: gray; 
                }
                .star.selected i,
                .star.hover i,
                .star.hover ~ .star i {
                    color: gold;
                }
            </style>
            

            <div class="form-group">
                <label for="title">レビュータイトル</label>
                <input type="text" id="title" name="title" class="form-control" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">レビュー内容</label>
                <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">レビューを投稿</button>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star');
        const starRatingInput = document.getElementById('star-rating-input');

        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const value = parseInt(this.getAttribute('data-value'));
                updateStars(value);
            });

            star.addEventListener('mouseout', function() {
                const value = parseInt(starRatingInput.value);
                updateStars(value);
            });

            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                starRatingInput.value = value;
                updateStars(value);
            });
        });

        function updateStars(value) {
            stars.forEach(star => {
                const starValue = parseInt(star.getAttribute('data-value'));
                const icon = star.querySelector('i');
                if (starValue <= value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    });
</script>


