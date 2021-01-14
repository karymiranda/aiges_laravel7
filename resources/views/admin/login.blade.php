<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Aiges/Inicio</title>

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/assets2/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/assets2/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/assets2/css/form-elements.css')}}">
        <link rel="stylesheet" href="{{ asset('css/assets2/css/style.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="{{ asset('css/assets2/ico/favicon.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('css/assets2/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('css/assets2/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('css/assets2/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('css/assets2/ico/apple-touch-icon-57-precomposed.png')}}">
    </head>
  <!--body style="background-color: rgb(227, 230, 232); zoom: 1;"-->
    <body style="background-color: rgb(166, 186, 199); zoom: 1;">

        <!-- Top content -->
        <div class="top-content">           
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <!--div class="col-sm-8 col-sm-offset-2 text">
                          <h1><b>CENTRO ESCOLAR CATOLICO<b></h1>
                           <h1><strong>SANTA MARIA DEL CAMINO </strong></h1>
                            <div class="description">
                                <p>
                                    
                                </p>
                            </div>
                        </div-->
                    </div>

                     <div class="row">
                    </div>

                      <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box ">
                            <div class="form-top">

                       
 <img src="{{ asset('/imagenes/recursosrpt/logosistemapequeno.png')}}" class="user-image" alt="User Image" style="height: auto"> 
                 <!--h1 align="center"><b>Centro Escolar Católico "Santa Maria del Camino"</b></h1-->
                                
                                <!--h3 align="center"><b>Aplicación Informática para la Gestión Estudiantil</b></h3>
                                 <h4 align="center"><b>Centro Escolar Católico "Santa Maria del Camino"</b></h4-->
                                    <P align="center">Digite usuario y contraseña para ingresar...</P>
                           
                              <!--div class="form-top-left">
                         <h4 align="center">Aplicación Informática para la Gestión Escolar</h4>
                                    <h1 align="center"><b>AIGES</b></h1>
                                    <P align="center">Digite usuario y contraseña para ingresar...</P>
                                </div>
  <div class="form-top-right">
                                    <i class="fa fa-users"></i>
 <img src="{{ asset('/imagenes/recursosrpt/logoce.jpg')}}" class="user-image" alt="User Image">  
                                </div-->       

                            </div>
                            <div class="form-bottom">
                                <form role="form" action="{{ route('login') }}" method="POST" class="login-form">
                                     @csrf
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                        <input  id="name" type="text"name="name" class="form-username form-control" placeholder="Usuario" value="{{ old('name') }}" required autofocus>
            
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <!--input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password"-->
                             <input id="password" type="password" placeholder="Contraseña" class="form-password form-control" name="password" required>

                <div class="form-group">
                    @if ($errors->has('name'))
                    <!--span class="invalid-feedback" role="alert"-->                    
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>                
                     @endif

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                                    </div>
                                    <button type="submit" class="btn">Iniciar Sesión</button>
                                </form>

  <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <a href="reset" class="text-primary">¿Ha olvidado su contraseña?</h3>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <!--script src="{{ asset('css/assets2/js/jquery-1.11.1.min.js')}}"></script>
        <script src="{{ asset('css/assets2/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('css/assets2/js/jquery.backstretch.min.js')}}"></script>
        <script src="{{ asset('css/assets2/js/scripts.js')}}"></script-->
        
        <!--[if lt IE 10]>
            <script src="css/assets2/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>