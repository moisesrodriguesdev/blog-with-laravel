@extends('layout.master')
@section('content')
    <div class="d-flex justify-content-between">
        <div class="box p-3">
            <h1 class="mb-3 text-center">Visualizações - Posts</h1>
            @foreach($posts as $post)
                <h6>{{ $post->title }} : <b>{{ $post->views }}</b></h6> 
            @endforeach
            
        </div>
        <div class="box p-3">
            <h1 class="mb-3 text-center">Curtidas - Posts</h1>
            @foreach($posts as $post)
                <h6>{{ $post->title }} : <b>{{ $post->likes }}</b></h6> 
            @endforeach
        </div>
    </div>
@endsection
