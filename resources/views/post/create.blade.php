@extends('layout.master')
@section('content')
    <div class="mb-3">
        <h1>Criar Post</h1>
        <span class="line"></span>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header text-center" style="background: #44494D; color:white;">Conteúdo</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="title">Título</label>
                                <input type="text" name="title" id="title"class="form-control">
                                @error('title')
                                    <div class="alert alert-danger alert-danger-form mt-1 mb-2">{{ $message }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 p-0">
                            <label for="">Descrição</label>
                            <textarea class="form-control description" name="description"></textarea>
                            @error('description')
                                <div class="alert alert-danger alert-danger-form mt-1 mb-2">{{ $message }}</div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Imagem do Post</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileLang" name="imagem" lang="es">
                                <label class="custom-file-label" for="customFileLang">Imagem da capa</label>
                                @error('imagem')
                                    <div class="alert alert-danger alert-danger-form mt-2 mb-3">{{ $message }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('no_image.jpg') }}" id="img-preview" class="col-md-12 p-0" style="max-width: 600px; max-height: 342px" />
                        </div>
                    </div>
                </div>
                <div class="card-footer d-f d-justi-flex-end">
                    <a href="{{ route('post.home') }}"><button class="btn btn-primary m-l-10" type="button"><i class="fas fa-arrow-circle-left"></i> Voltar</button></a>
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <script>
        tinymce.init({
            selector:'textarea.description',
            height: 300
        });
        // RENDERIZAR CAPA - INICIO
        function readImage() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("img-preview").src = e.target.result;
                };
                file.readAsDataURL(this.files[0]);
            }
        }
        document
            .getElementById("customFileLang")
            .addEventListener("change", readImage, false);

        // RENDERIZAR CAPA - FIM
    </script>
@endsection
