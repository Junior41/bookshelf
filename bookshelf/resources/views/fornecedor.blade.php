@extends('layouts.barraLateral')


@section('nomeFormulario')
  @isset($fornecedor)
  Editar Fornecedor
  @else
  Cadastrar Fornecedor
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
<form class="form" method="POST" @isset($fornecedor) action="/fornecedor/{{$fornecedor->CNPJ}}" @else action="/fornecedor" @endisset >
  @csrf
  @isset($fornecedor)
    @method("PUT")
  @endisset

  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Nome</label>
      <br>
      <input name = "nome" required @isset($fornecedor) value = "{{$fornecedor->nome}}" @endisset type="text">
    </div>
    <div class="elementoForm">
      <label for="">Endereço</label>
      <br>
      <input name = "endereco" required @isset($fornecedor) value = "{{$fornecedor->endereco}}" @endisset type="text">
    </div>
  </div>

  <div class = "form-row">

    @isset($fornecedor)
    @else
      <div class="elementoForm">
        <label for="">CNPJ</label>
        <br>
        <input name = "CNPJ" required type="text">
      </div>
    @endisset


    <div class="elementoForm">
      <label for="">Status</label>
      <br>
      <select name="status" required id="status">
        <option @isset($fornecedor) @if($fornecedor->status == 1) selected @endif @endisset value="1">Ativo</option>
        <option @isset($fornecedor) @if($fornecedor->status == 0) selected @endif @endisset value="0">Inativo</option>
      </select>
    </div>
  </div>

  <div class = "form-last-row" style = "padding-top:2rem;">
    <div class="buttonSubmit">
      <button type = "submit">
        @isset($fornecedor)
          Editar
        @else
          Cadastrar
        @endisset
      </button>
    </div>
  </div>
</form>
@endsection