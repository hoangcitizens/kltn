@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <article>
                <h1 class="mb-4">{{ $post->title }}</h1>
                
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-4" alt="{{ $post->title }}">
                @endif

                <div class="post-content">
                    {!! $post->content !!}
                </div>
            </article>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thiết bị liên quan</h5>
                </div>
                <div class="card-body">
                    @foreach($relatedEquipments as $equipment)
                    <div class="mb-3">
                        <h6>{{ $equipment->name }}</h6>
                        @if($equipment->image)
                        <img src="{{ asset('storage/' . $equipment->image) }}" class="img-fluid mb-2" alt="{{ $equipment->name }}">
                        @endif
                        <p class="mb-1">{{ Str::limit($equipment->description, 100) }}</p>
                        <p class="mb-1"><strong>Giá thuê:</strong> {{ number_format($equipment->price) }} VNĐ/ngày</p>
                        <a href="{{ route('equipment.show', $equipment->id) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Đặt thiết bị</h5>
                </div>
                <div class="card-body">
                    <p>Bạn muốn thuê thiết bị cho tiệc cưới của mình?</p>
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary">Đặt ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 