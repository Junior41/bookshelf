@extends('layouts.app')

@section('content')

<div class = "element">
    <h2>Fazer login</h2>
</div>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class = "element">    
        <input id="cpf" type="cpf" placeholder = "CPF" class="form-control"  name="CPF" required autofocus>
    </div>
    <div class = "element">
        <input id="password" placeholder = "Senha" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    </div>

    <div class = "element">
        @error('CPF')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    <div class = "element">
        <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>
    </div>
</form>
@endsection
