@extends('layouts.barraLateral')

@section("nomeFormulario")
@isset($exemplar)
Reservar exemplar
@else
Devolução de exemplar
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
<form class="form" @isset($exemplar) action="/exemplar/reservar/{{$exemplar->codigo}}" @else action="/exemplar/entregar" @endisset method="POST" enctype="multipart/form-data">
  @method("PUT")
  @csrf

  @isset($exemplar)
  @else
  <div class = "form-row">
    <div class="elementoForm">
      <label for="">Informe o código do exemplar</label>
      <br>
    <input name="codigo" required type="text">
    </div>
  </div>
  @endisset

  <div class = "form-last-row">
    <div class="elementoForm">
      <label for="">Data de entrega prevista</label>
      <br>
      <input name="entrega" required type="date">
    </div>

    <div class="buttonSubmit">
      <button type = "submit">
        @isset($exemplar)
        Reservar
        @else
        Devolver
        @endisset
      </button>
    </div>
  </div>
</form>
@endsection