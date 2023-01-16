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
  <link href="{{asset('assets/img/icone.png')}}" rel="icon">
  <link href="{{asset('assets/img/icone.png')}}" rel="apple-touch-icon">

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

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div id="mySidenav" class="sidenav">
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type = "submit" id = "sair" >Sair</button>
          </form>
          @if(Auth::user()->acesso > 0)
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="/livro/create">Cadastrar livro</a>
            <a href="/categoria/create">Cadastrar categoria</a>
            <a href="/socio/create">Cadastrar sócio</a>
            <a href="/exemplar/create">Cadastrar exemplar</a>
            <a href="/fornecedor/create">Cadastrar fornecedor</a>
            @if(Auth::user()->acesso > 1)
              <a href="/administrador/create">Cadastrar administrador</a>
              <a href="/funcionario/create">Cadastrar funcionário</a>
            @endif
          @endif
        </div>

 
      <span style="font-size:30px;cursor:pointer" onclick="openNav()"><img src="/assets/img/Vector.png" alt=""></span> 

      <div class = "user">
        <img src="/assets/img/perfil-de-usuario.png" alt="usuário">
        <div>
          <h5>{{Auth::user()->name}} </h5>
        </div>
      </div>

      <div class = "logo">
        <img src="/assets/img/logo-removebg-preview 1.png" alt="Logo bookshelf">      
      </div>
    </div>
        
  </header><!-- End Header -->
    <div class = "sobre">
      <div class = "text">
        <h1>Livraria CEUNES</h1>
        <p>
          É notório a falta de organização e estagnação do acervo de
          bibliotecas nas escolas brasileiras inclusive a gestão da biblioteca de maneira
          manual, impede que o estudante manuseie as obras e faça suas próprias
          descobertas no local. Tendo em vista que os alunos do século XXI valorizam os
          recursos que otimizam o tempo e tornam mais práticas as atividades diárias.
          O software tem como propósito possibilitar aos clientes de biblioteca uma maior
          rapidez, organização e controle de cadastros de todo acervo bibliográfico,
          permitindo a gestão eficiente dos empréstimos de livros.
        </p>
        <form action="/filtro" method = "POST">
          @csrf
          <input type="text" placeholder = "pesquisar" name = "nome" >
          <button type = "submit"><img src="{{asset('/assets/img/lupa.png')}}" alt="pesquisar"></button>
        </form>
      </div>
      <div class = "img">
        <img src="/assets/img/image 4.png" alt="">
      </div>
    </div>
    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container-fluid">
        <div class="row gy-4 justify-content-center">
          @isset($livros)
            @foreach ($livros as $livro)
                <div class="col-xl-3 col-lg-4 col-md-6">
                  <a href = "#" class="gallery-item h-100">
                    <div style = "display:flex;justify-content: center;">
                      <img src= "{{url("storage/{$livro->capa}")}}" class="img-fluid" alt="">
                    </div>
                    <div class = "titulo">
                      <h5>{{$livro->nome}}</h5>
                    </div>
                    <div class = "classificacao">
                      @for($i = 0; $i < 3; $i++)
                        @if($i < $livro->avaliacao)
                          <img src = "{{asset('/assets/img/estrela (1).png')}}"></img>
                        @else
                          <img src = "{{asset('/assets/img/estrela.png')}}"></img>
                        @endif
                      @endfor
                    </div>
                  </a>
                </div><!-- End Gallery Item -->
            
            @endforeach
            <div class = "pagination">
              {{ $livros->links() }} 
            </div>
          @endisset
        </div>
      </div>
    </section><!-- End Gallery Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class = "img-logo">
      <img src="/assets/img/image 5.png" alt="logo ufes">
    </div>
    <div class="container" style = "align-items:center;">
      <div class="copyright">
        &copy; Copyright <strong><span>UMPS, república</span></strong>. Todos os direitos reservados.
      </div>
      <div class="credits">
        Designed by <a href="#">wilsin</a>
      </div>
    </div>
    <div class = "contato">
          <!-- Facebook -->
          <a href="#"><img src="/assets/img/simbolo-de-aplicativo-do-facebook.png" alt="logo Facebook"></a>

          <!-- Twitter -->
          <a href="#"><img src="/assets/img/twitter.png" alt="logo Twitter"></a>

          <!-- github -->
          <a href="#"><img src="/assets/img/github.png" alt="logo github"></a>

          <!-- Instagram -->
          <a href="#"><img src="/assets/img/instagram.png" alt="logo instagram"></a>
    </div>
  </footer><!-- End Footer -->


  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>

</body>

</html>