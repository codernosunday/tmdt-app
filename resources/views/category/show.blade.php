@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="display-4">{{ $category->ten }}</h1>
    <p>{{ $category->description }}</p>
    <!-- Add more content here as needed -->
</div>
@endsection
