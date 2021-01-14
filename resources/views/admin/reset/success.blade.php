<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Aiges</title>
        <!-- CSS -->
        <link
            rel="stylesheet"
            href="{{ asset('css/assets2/bootstrap/css/bootstrap.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{
                asset('css/assets2/font-awesome/css/font-awesome.min.css')
            }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/assets2/css/form-elements.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/assets2/css/style.css') }}"
        />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link
            rel="shortcut icon"
            href="{{ asset('css/assets2/ico/favicon.png') }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="144x144"
            href="{{
                asset('css/assets2/ico/apple-touch-icon-144-precomposed.png')
            }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="114x114"
            href="{{
                asset('css/assets2/ico/apple-touch-icon-114-precomposed.png')
            }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="72x72"
            href="{{
                asset('css/assets2/ico/apple-touch-icon-72-precomposed.png')
            }}"
        />
        <link 
            rel="apple-touch-icon-precomposed"
            href="{{
                asset('css/assets2/ico/apple-touch-icon-57-precomposed.png')
            }}"
        />
    </head>

    <body class="hold-transition login-page" style="background-color: #d2d6de">
        <!-- Top content -->
        <div class="login-box">
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <!--div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>
                              <strong>CENTRO ESCOLAR CATOLICO SANTA MARIA DEL CAMINO</strong>
                            </h1>
                            <div class="description">
                              <p></p>
                            </div>
                        </div>
                    </div-->


                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <img src="{{ asset('/imagenes/recursosrpt/logosistemapequeno.png')}}" class="user-image" alt="User Image" style="height: auto">

                                <div class="form-top">
                                   <p align="center"><span class="label label-warning">CONFIRMACION ENVIO DE CONTRASEÑA</span>
                                      
                                   </p>

                                  
@if ($type == '1')
  <h3>Hemos actualizado con éxito la contraseña. Revise su correo por favor.</h3>
  <div class="col-sm-12" align="center">
  <a href="{{ route('iniciarsesion') }}" class="btn  btn-primary">Iniciar sesión</a></div>
@elseif( $type == '2' )
    <h3>Lo sentimos pero el usuario no tiene una dirección de correo asigando.</h3>
    <div class="col-sm-12" align="center">
    <a href="{{ route('iniciarsesion') }}" class="btn btn-primary">Iniciar sesión</a>
</div>
@else
    <h3>Tenemos un problema con el servidor por favor intente más tarde.</h3>
    <div class="col-sm-12" align="center">
    <a href="{{ route('iniciarsesion') }}" class="btn btn-primary">Iniciar sesión</a></div>
@endif

                                  
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="{{
                asset('css/assets2/js/jquery-1.11.1.min.js')
            }}"></script>
        <script src="{{
                asset('css/assets2/bootstrap/js/bootstrap.min.js')
            }}"></script>
      
        <script src="{{ asset('css/assets2/js/scripts.js') }}"></script>
    </body>
</html>





<!--h2>Confirmacion</h2>
@if ($type == '1')
  <h3>Hemos actualizado con exito la contraseña revisa tu correo por favor</h3>
  <a href="{{ route('login') }}">Login</a>
@elseif( $type == '2' )
    <h3>Lo sentimos pero el usuario no tiene un correo asigando</h3>
    <a href="{{ route('login') }}">Login</a>
@else
    <h3>Tenemos un problema con el servidor por favor intenta mas tarde</h3>
    <a href="{{ route('login') }}">Login</a>
@endif<-->