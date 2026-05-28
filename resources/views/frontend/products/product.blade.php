@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: ₹{{ $product->sale_price ?? $product->price }}</p>

    {{-- Related Products --}}
    @if($related->count())
    <h3>Related Products</h3>
    @foreach($related as $item)
        <p>{{ $item->name }}</p>
    @endforeach
    @endif
</div>

@endsection