@extends('layout.master')
@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <div>
            <h1>Post cadastrados</h1>
            <span class="line"></span>
        </div>
        <a href="{{ route('post.create')  }}">
            <button type="button" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>  Criar Post
            </button>
        </a>
    </div>


    @if(Session::has('message') &&  Session::has('type'))
        <div class="alert alert-{{ Session::get('type') }} text-center">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="row row-cols-1 row-cols-md-3">
        @forelse($posts as $post)
            <div class="col-sm-4 mb-2">
                <div class="card img-banner-home">
                    <img src='{{ url("storage/post/{$post->id}/{$post->imagem}") }}' class="card-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('post.show', $post) }}">Ver mais</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
