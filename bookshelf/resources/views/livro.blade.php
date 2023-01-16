@extends('layouts.barraLateral')

@section("nomeFormulario")
@isset($livro)
Editar Livro
@else
Cadastrar livro
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
<form class="form" @isset($livro) action="/livro/{{$livro->codigo}}" @else action="/livro" @endisset method="POST" enctype="multipart/form-data">
  @isset($livro)
  @method("PUT")
  @endisset
  @csrf

  @isset($livro)
  @else
  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Código do livro</label>
      <br>
      <input name = "codigo" @isset($livro) value = "{{$livro->codigo}}" @endisset required type="text">
    </div>
  </div>
  @endisset

  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Titulo do livro</label>
      <br>
      <input name = "nome" @isset($livro) value = "{{$livro->nome}}" @endisset required type="text">
    </div>
  </div>
  
  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Autor</label>
      <br>
      <input name = "autor" @isset($livro) value = "{{$livro->autor}}" @endisset required type="text">
    </div>
  </div>
  
  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Editora</label>
      <br>
      <input name = "editora" @isset($livro) value = "{{$livro->editora}}" @endisset required type="text">
    </div>
    <div class="elementoForm">
      <label for="">Capa</label>
      <br>
      <input name = "capa" @isset($livro) value = "{{$livro->capa}}" @endisset type="file">
    </div>
       
  </div>
   
  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Avaliação</label>
      <br>
      <select name="avaliacao" id="avaliacao">
        <option @isset($livro) @if($livro->avaliacao == 0) selected @endif @endisset value="0">0</option>
        <option @isset($livro) @if($livro->avaliacao == 1) selected @endif @endisset value="1">1</option>
        <option @isset($livro) @if($livro->avaliacao == 2) selected @endif @endisset value="2">2</option>
        <option @isset($livro) @if($livro->avaliacao == 3) selected @endif @endisset value="3">3</option>
      </select>
    </div>
    
    <div class="elementoForm">
      <label for="">Categoria do livro</label>
      <br>
      <select name="categoria_id" id="classificacao">
        @foreach ($categorias as $categoria)
          <option @isset($livro) @if($livro->categoria_id == $categoria->id) selected @endif @endisset value="{{$categoria->id}}">{{$categoria->nome}}</option>
        @endforeach
      </select>
    </div>
  
  </div>

  <div class = "form-last-row">
    <div class="elementoForm">
      <label for="">Qntd. páginas</label>
      <br>
      <input name="quantidadePag" @isset($livro) value = "{{$livro->quantidadePag}}" @endisset required type="text">
    </div>

    <div class="buttonSubmit">
      <button type = "submit">
        @isset($livro)
        Editar
        @else
        Cadastrar
        @endisset
      </button>
    </div>
  </div>
</form>
@endsection