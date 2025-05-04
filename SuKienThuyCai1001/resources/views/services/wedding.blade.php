@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Dịch Vụ Tổ Chức Tiệc Cưới</h1>
    
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->excerpt, 150) }}</p>
                    <a href="{{ route('services.wedding.post', $post->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection 