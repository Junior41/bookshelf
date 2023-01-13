@extends('layouts.barraLateral')


@section('nomeFormulario')
  @isset($funcionario)
  Editar Funcionário
  @else
  Cadastrar Funcionário
  @endisset
@endsection

@section("escopoFormulario")
@if(session('success'))
    <div class="alert alert-success">
        <p>{{session('success')}}</p>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        <p>{{session('error')}}</p>
    </div>
@endif

@if($errors->all() != [])
  <div class = "alert alert-danger">
    <ul>
      @foreach($errors->all() as $erro)
        <li>{{$erro[0]}}</li>
      @endforeach
    </ul>
  </div>
@endif
<form class="form" method="POST" @isset($funcionario) action="/funcionario/{{$funcionario->CPF}}" @else action="/funcionario" @endisset >
  @csrf
  @isset($funcionario)
    @method("PUT")
  @endisset
  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Nome</label>
      <br>
      <input name = "name" required type="text" @isset($user) value = "{{$user->name}}" @endisset>
    </div>
  </div>

  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Email</label>
      <br>
      <input name = "email" required @isset($user) value = "{{$user->email}}" @endisset type="email">
    </div>
  </div>

  <div class = "form-row">

    @isset($funcionario)
    @else
      <div class="elementoForm">
        <label for="">CPF</label>
        <br>
        <input name = "CPF" required type="text">
      </div>
    @endisset


    <div class="elementoForm">
      <label for="">Status</label>
      <br>
      <select name="status" id="status">
        <option @isset($funcionario) @if($funcionario->status == 1) selected @endif @endisset value="1">Ativo</option>
        <option @isset($funcionario) @if($funcionario->status == 0) selected @endif @endisset value="0">Inativo</option>
      </select>
    </div>
  </div>

  <div class = "form-row">
    <div class="elementoForm">
      <label for="">@isset($user)Nova @endisset Senha</label>
      <br>
      <input name = "password" type="password" @isset($user) placeholder="Caso não queira alterar a senha basta deixar esse campo em branco" @endisset>
    </div>
  </div>

  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Confirmar senha</label>
      <br>
      <input name = "confirmarSenha" type="password" @isset($user) placeholder="Caso não queira alterar a senha basta deixar esse campo em branco" @endisset>
    </div>
  </div>
  
  
  <div class = "form-last-row" style = "padding-top:2rem;">
    <div class="buttonSubmit">
      <button type = "submit">
        @isset($funcionario)
          Editar
        @else
          Cadastrar
        @endisset
      </button>
    </div>
  </div>
</form>
@endsection