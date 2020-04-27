@component('mail::message')

    <h1 style="text-align: center"> {{$post->title}} </h1>

    <h3 style="text-align: center"><?= nl2br($post->description) ?></h3>
@endcomponent

