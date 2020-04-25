@extends('layout.master')
@section('content')

    <div class="mb-3">
        <h1>{{ $post->title }}</h1>
        <input type="hidden" value="{{ $post->id }}" id="post_id">
        <span class="line"></span>
    </div>

    <div class="d-flex justify-content-center flex-column" style="width: 65%; margin: 0 auto;">
        <img src='{{ url("storage/post/{$post->id}/{$post->imagem}") }}' class="img-post mb-3">
        <div class="ali-center">
            {!! nl2br($post->description) !!}
        </div>
    </div>

    <div class="d-flex justify-content-center ">
        <a href="#" class="d-flex flex-row link" id="like">
            <i class="fas fa-thumbs-up" style="font-size: 30px"></i>
            <span class="pl-2">Curtir</span>
        </a>
        <a href="#" class="d-flex flex-row link" id="comment">
            <i class="fas fa-comment-alt" style="font-size: 30px"></i>
            <span class="pl-2">Comentar</span>
        </a>
        <a href="#" data-toggle="modal" data-target="#exampleModal" class="d-flex flex-row link">
            <i class="fas fa-share" style="font-size: 30px"></i>
            <span class="pl-2">Compartilhar</span>
        </a>
        <span class="msg_success" id="msg_like" style="display: none;">Você curtiu o post</span>
    </div>

        <div class="d-flex flex-column">
            <div class="messages al-self-center" style="width: 65%;">
                @foreach($comments as $comment)
                    <div class="message">
                        <strong>{{ $comment->data2 }}</strong>:  {{ $comment->comment}}
                    </div>
                @endforeach
            </div>
            <form class="al-self-center" id="add-coments" style="width: 65%;">
                <div class="input-group">
                    <input type="text" class="form-control" id="msg-post" placeholder="Escreva um comentário ..." required>
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Enviar</button>
                    </span>
                </div>
            </form>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Informe o email para compartilhar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('post.share', $post) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="email" name="email" class="form-control" Placeholder="exemplo@exemplo.com.br">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script>

        let post_id = $("#post_id").val();

        $("#like").click(function () {

            $.ajax({
                method: "PUT",
                url: "http://127.0.0.1:8000/post/like",
                data: {
                        "_token": "{{ csrf_token() }}",
                        "post_id": post_id
                    },
                dataType: "json",
                success: function (response) {
                    $("#msg_like").fadeIn();

                    setTimeout(function() {
                        $('#msg_like').fadeOut(function(){
                            $(this).remove();
                        });
                    }, 3000);


                },
                error: function (error) {
                    console.log({ "pq erro": error });
                },
            });
        });

        function renderComents(coments){
            $('.messages').append('<div class="message"><strong>'+ coments.data2 +'</strong>:  '+ coments.comment +'</div>')
            $("#msg-post").val('');
        }


        $("#comment").click(function(e){
            e.preventDefault();
            $("#msg-post").focus();
        });


        $("#add-coments").submit(function(e){
            e.preventDefault();

            let comment = $("#msg-post").val();

            $.ajax({
                method: "POST",
                url: "http://127.0.0.1:8000/post/comment",
                data: {
                        "_token": "{{ csrf_token() }}",
                        "post_id": post_id,
                        "comment": comment
                    },
                dataType: "json",
                success: function (response) {
                    renderComents(response.docs.comment);
                },
                error: function (error) {
                    console.log({ "pq erro": error });
                },
            });
        });

    </script>
@endsection
