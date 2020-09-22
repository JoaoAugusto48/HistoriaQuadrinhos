@extends('layouts.app')

@section('content')
    <div class="row">
        <h1>
            Usuário - {{ $usuario->name }}
            <a href="{{ route('hq.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-home"></i> Inicio
            </a>
        </h1>
        
    </div>
    <hr class="bg-dark mt-0"/>

    <form action="{{ route('atualizarUsuario') }}" method="post">
        @csrf

        <input type="hidden" name="id" value="{{ $usuario->id }}">
        
        <div class="form-group row">
            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">{{ __('Name') }}:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nome" value="{{ $usuario->name }}" maxlength="255" autocomplete="name" required>
            </div>

            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">{{ __('E-Mail Address') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="email" value="{{ $usuario->email }}" disabled>
            </div>
        </div>

        <div class="col-md-8 offset-md-1 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Atualizar</button>
        </div>
        
    </form>
    
    <hr class="bg-dark mt-2"/>


    <form action="{{ route('atualizarSenha') }}" method="post">
        @csrf
        {{-- @method('PUT') --}}

        @if ($error = Session::get('error'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($error as $mensagem)
                    <li>{{ $mensagem }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($success = Session::get('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ $success }}</li>
                </ul>
            </div>
        @endif

        <input type="hidden" name="id" value="{{ $usuario->id }}">
        
        <div class="form-group row">
            <label for="senha_antiga" class="col-sm-3 col-form-label text-right font-weight-bold">{{ __('Old Password') }}:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control @error('senha_antiga') is-invalid @enderror" name="senha_antiga" maxlength="255" min="8" required>
                
                @error('senha_antiga')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="form-group row">
            <label for="nova_senha" class="col-sm-3 col-form-label text-right font-weight-bold">{{ __('New Password') }}:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control @error('nova_senha') is-invalid @enderror" name="nova_senha" required>
                
                @error('nova_senha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
            </div>
        </div>

        <div class="form-group row">
            <label for="confirmar_senha" class="col-sm-3 col-form-label text-right font-weight-bold">{{ __('Confirm Password') }}:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control @error('confirmar_senha') is-invalid @enderror" name="confirmar_senha" required>
                
                @error('confirmar_senha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-8 offset-md-3 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Atualizar Senha</button>
        </div>
        
    </form>


@endsection