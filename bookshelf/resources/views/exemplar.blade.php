@extends('layouts.barraLateral')

@section("nomeFormulario")
@isset($exemplar)
Editar Exemplar
@else
Cadastrar Exemplar
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
<form class="form" @isset($exemplar) action="/exemplar/{{$exemplar->codigo}}" @else action="/exemplar" @endisset method="POST" enctype="multipart/form-data">
  @isset($exemplar)
  @method("PUT")
  @endisset
  @csrf
  @isset($exemplar)
  @else
    <div class = "form-row">
      <div class="elementoForm">
        <label for="">Código do exemplar</label>
        <br>
        <input name = "codigo" @isset($exemplar) value = "{{$exemplar->codigo}}" @endisset required type="text">
      </div>
    </div>
  @endisset

  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Estado de conservação</label>
      <br>
      <select name="estadoConservacao" id="estadoConservacao">
        <option @isset($exemplar) @if($exemplar->estadoConservacao == 0) selected @endif @endisset value="0">Ruim</option>
        <option @isset($exemplar) @if($exemplar->estadoConservacao == 1) selected @endif @endisset value="1">Médio</option>
        <option @isset($exemplar) @if($exemplar->estadoConservacao == 1) selected @endif @endisset value="2">Bom</option>
      </select>
    </div>

  @isset($exemplar)  
  @else
    <div class="elementoForm">
      <label for="">Quantidade de exemplares</label>
      <br>
      <input name = "quantidadeExe" value = "1" type="numeric">
    </div>
  @endisset

  </div>
  
  <div class = "form-row">
    <div class="elementoForm">
      <label for="">CNPJ fornecedor</label>
      <br>
      <input name = "CNPJFornecedor" @isset($exemplar) value = "{{$exemplar->CNPJFornecedor}}" @endisset type="text" placeholder = "Livro fornecido por sócio? deixe esse campo em branco.">
    </div>

    <div class="elementoForm">
      <label for="">CPF Sócio</label>
      <br>
      <input name = "CPFSocio" @isset($exemplar) value = "{{$exemplar->CPFSocio}}" @endisset type="text" placeholder = "Livro fornecido por fornecedor? deixe esse campo em branco.">
    </div>
       
  </div>

  <div class = "form-last-row" style = "padding-top:2rem;">

    <div class="buttonSubmit">
      <button type = "submit">
        @isset($exemplar)
        Editar
        @else
        Cadastrar
        @endisset
      </button>
    </div>
  </div>
</form>
@endsection