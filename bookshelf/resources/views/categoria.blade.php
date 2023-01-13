@extends('layouts.barraLateral')


@section('nomeFormulario')
  @isset($categoria)
  Editar Categoria
  @else
  Cadastrar Categoria
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
<form class="form" method="POST" @isset($categoria) action="/categoria/{{$categoria->id}}" @else action="/categoria" @endisset >
  @csrf
  @isset($categoria)
    @method("PUT")
  @endisset
  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Nome</label>
      <br>
      <input name = "nome" required type="text" @isset($categoria) value = "{{$categoria->nome}}" @endisset>
    </div>
  </div>

  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Faixa etária</label>
      <br>
      <input name = "faixaEtaria" required @isset($categoria) value = "{{$categoria->faixaEtaria}}" @endisset type="text">
    </div>
  </div>
  
  
  <div class = "form-last-row" style = "padding-top:2rem;">
    <div class="buttonSubmit">
      <button type = "submit">
        @isset($categoria)
          Editar
        @else
          Cadastrar
        @endisset
      </button>
    </div>
  </div>
</form>
@endsection