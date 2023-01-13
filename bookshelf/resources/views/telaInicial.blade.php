<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bookshelf</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- jQuery -->
  <script src="{{asset('assets/js/jquery-2.1.0.min.js')}}"></script>
  
  <!-- Bootstrap -->
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">

</head>

<body>
  <div class = "conteudo">
    <div class = "entrar">
      <div class = "marca">
        <h2>Bookshelf</h2>
      </div>

      <div class = "textPotente">
        <h1>Bem-vindo de volta!</h1>
      </div>

      <div class = "frase">
        <p>Acesse sua conta agora mesmo!</p>
      </div>
      <div class = "botaoLogin">
        <a href = "/login">Entrar</a>
      </div>
    </div>
    <div class = "cadastro">
      <div class = "textPotente" style = "color:#000;">
        <h4>Criar sua conta</h4>
      </div>
      <div class = "frase" style = "color: #000; margin-top:0;">
        <p>Preencha seus dados</p>
      </div>
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
      <form action="/cadastrarSocio" method = "POST" class = "form">
        @csrf
        <div class = "form-row">
          <div class="elementoForm">
            <input type="text" name = "CPF" placeholder="CPF">
          </div>
          <div class = "elementoForm">
            <input type="text" name = "endereco" placeholder="Endereco">
          </div>
        </div>
        <div class = "form-row">
          <div class = "elementoForm">
            <input type="text" name = "name" placeholder="Nome">
          </div>
          <div class = "elementoForm">
            <input type="email" name = "email" placeholder="Email">
          </div>
        </div>
        <div class = "form-row">
          <div class = "elementoForm">
            <input type="password" name = "password" placeholder="Senha">
          </div>
          <div class = "elementoForm">
            <input type="password" name = "confirmarSenha" placeholder="Confirmar senha">
          </div>
        </div>
        <div class = "element" style = "margin-top:2rem;">
          <button type = "submit">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>

</body>

</html>