<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cadastro de livro</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- jQuery -->
  <script src="{{ asset('assets/js/jquery-2.1.0.min.js')}}"></script>
  
  <!-- Bootstrap -->
  <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    

  <!-- Favicons -->
  <link href="{{asset('assets/img/icone.png')}}" rel="icon">
  <link href="{{asset('assets/img/icone.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset ('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset ('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{ asset ('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset ('assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset ('assets/css/main.css')}}" rel="stylesheet">
  <link href="{{ asset ('assets/css/icons.css')}}" rel="stylesheet">

</head>

<body>
    <div class = "d-flex">
        <!--
          Barra lateral
        -->
        <div class = "barraLateral">
          <div class = "logo"> 
            <img src="/assets/img/logo-removebg-preview 1.png" alt="logo bookshelf">
          </div>
          <div class = "botaoMenu">
            <a href = "/home">Menu inicial</a>
          </div>
          <div class = "botaoMenu">
            <a href = "/livro/create">Cadastrar livro</a>
          </div>
          <div class = "botaoMenu">
            <a href = "/categoria/create">Cadastrar categoria</a>
          </div>
          <div class = "botaoMenu">
            <a href = "/socio/create">Cadastrar sócio</a>
          </div>
          @if(Auth::user()->acesso > 1)
            <div class = "botaoMenu">
              <a href = "/administrador/create">Cadastrar Administrador</a>
            </div>
            <div class = "botaoMenu">
              <a href = "/funcionario/create">Cadastrar Funcionário</a>
            </div>
          @endif
          <div class = "botaoMenu">
            <a href = "/exemplar/create">Cadastrar Exemplar</a>
          </div>
          <div class = "botaoMenu">
            <a href = "/fornecedor/create">Cadastrar Fornecedor</a>
          </div>
        </div>

        <!--
          escopo do formulário
        -->
        <div class = "escopoFormulario">
           <div class = "titulo">
                <h2>@yield("nomeFormulario")</h2>
            </div>
            @yield("escopoFormulario")
        </div>
    </div>
</body>

</html>