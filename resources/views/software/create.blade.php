@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Cadastrar Software
            <a href="{{ route('software.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-home"></i> Inicio
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    @if ($clientes->count() > 0)
        <form action="{{ route('software.store') }}" method="post">
            @csrf

            @if ($errors->any())
                @include('mensagens.formulario.erro')
            @endif

            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Titulo:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="descricao" maxlength="100" value="{{ old('descricao') }}" autocomplete="off" placeholder="Insira o nome do software criado" required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Cliente:</label>
                <div class="col-sm-8">
                    <select class="custom-select" id="cliente_id" name="cliente_id" required>
                        <option selected>&nbsp;</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Est. Entrega:</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" name="prazo" value="{{ old('prazo') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Responsável:</label>
                <div class="col-sm-8">
                    <input type="text" id="responsavel" class="form-control" placeholder="Responsável pela empresa" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Email:</label>
                <div class="col-sm-4">
                    <input type="text" id="email" class="form-control" placeholder="Email" disabled>
                </div>
                <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Telefone:</label>
                <div class="col-sm-3">
                    <input type="text" id="telefone" class="form-control" placeholder="Telefone" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Cidade:</label>
                <div class="col-sm-5">
                    <input type="text" id="cidade" class="form-control" placeholder="Cidade" disabled>
                </div>

                <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Estado:</label>
                <div class="col-sm-2">
                    <input type="text" id="estado" class="form-control" placeholder="UF" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Endereco:</label>
                <div class="col-sm-5">
                    <input type="text" id="endereco" class="form-control" placeholder="Endereco" disabled>
                </div>
                <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Número:</label>
                <div class="col-sm-2">
                    <input type="text" id="numero" class="form-control" placeholder="Número" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Complemento:</label>
                <div class="col-sm-8">
                    <input type="text" id="complemento" class="form-control" placeholder="Complemento" disabled>
                </div>
            </div>

            <div class="col-md-8 offset-md-2 pl-1 text-left">
                <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
            </div>
        </form>
    @else
        @include('mensagens.cadastrar.cliente')
    @endif

    <script>
        $(document).ready(function() {
            $('#cliente_id').click(function(e){
                e.preventDefault();

                //cliente id
                let cliId = $(this).val();

                //AJAX
                $.ajax({
                    type: "GET",
                    url: `{!! URL::to('getUsuario/${cliId}') !!}`,
                    dataType: "json",
                    data: cliId,
                    success: function(response){
                        
                        $("#responsavel").val(response.responsavel);
                        $("#email").val(response.email);
                        $("#telefone").val(response.telefone);
                        $("#cidade").val(response.cidade);
                        $("#endereco").val(response.endereco);
                        $("#numero").val(response.numero);
                        
                        $("#complemento").val(response.complemento);
                        if(!response.complemento){
                            $("#complemento").val(' ');
                        }
                        
                        if(cliId > 0){ // if para não dar erro de encontro de uf
                            $("#estado").val(response.estado.uf);
                        } else {
                            $("#estado").val("");
                        }
                        console.log(cliId);
                    }
                })
            })
        })
    </script>

@endsection
