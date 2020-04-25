@component('mail::message')
    <h1 style="text-align: center"> {{$post->title}} </h1>
    <img src='{{ url("storage/post/{$post->id}/{$post->imagem}") }}' class="img-post mb-3">

   <h2 style="text-align: center"><?= nl2br($post->description) ?></h2>
@endcomponent

