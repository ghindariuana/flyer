<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flayer</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/libs.css">
    @yield('style')


</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Project flyer</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <?php /* Refactor @if(Auth::check()): */?>
          <p class=" navbar-text navbar-right ">
          @if($user)
                <a>Hello {{ $user->name }}</a>
                 <a class="btn btn-info" href="/logout">Logout</a>
          @else

                <a href="/login">Login</a>
                 <a  class="btn btn-success" href="/register">Register</a>
          @endif
          </p>
        </div><!--/.nav-collapse -->
    </nav>


    <div class="container">
        @yield('content')
    </div>
</body>
<script src="/js/libs.js"></script>

@yield('scripts.footer')
<?php #keep at the bottom after all js is loaded ?>
@include('flash')
</html>
