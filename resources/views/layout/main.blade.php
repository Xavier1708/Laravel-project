<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
    

       <!--CSS DA BOOTSTRAP-->
       <link rel="stylesheet" href="/css2/bootstrap.min.css">
       <script src="/js2/bootstrap.min.JS"></script>
 <!--CSS DA AOLICACAO-->
 
  <link rel="stylesheet" href="/css/style.css">
  <!--JAVA SCRIP DA APLICACAO-->
  <script src="/js/script.js"></script>
    </head>
    <body>
      
    <header>
         <div class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                <span>EVENTOSANGOLA</span>
                </a>
              <ul class="navbar-nav">
                 <li class="nav item">
                     <a href="" class="nav-link">Eventos</a>
                 </li>
                 <li class="nav item">
                     <a href="/events/create" class="nav-link">Criar Eventos</a>
                 </li>

                  @auth 
                  <li class="nav item">
                     <a href="/dashboard" class="nav-link">Meus eventos</a>
                 </li>

                 <li class="nav item">
                     <form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                     </form>
                 </li>
                  @endauth

                @guest 
                <li class="nav item">
                     <a href="/login" class="nav-link">Entrar</a>
                 </li>
                 <li class="nav item">
                     <a href="/register" class="nav-link">Cadastrar</a>
                 </li>
                 @endguest


              </ul>
            </div>


         </div>
    </header>


    <div class="container-fluid">
        <div class="row">
            @if(session('msg'))
                <P class="msg"> {{session('msg')}} </P>
            @endif
          @yield('content')
        </div>
    </div>
    <footer>
        <p>ANGOEVENTOS @ 2022</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>   
    </body>
</html>
