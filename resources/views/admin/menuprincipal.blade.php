<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Santa Maria del Camino</title>
  <link rel="shortcut icon" href="{{ asset('css/assets2/ico/favicon.png') }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
 <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/jquery.timepicker.css') }}">  
  <!-- Theme style -->

  <link rel="stylesheet"  href="{{ asset('adminlte/css/AdminLTE.min.css') }}"> 
 
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <!--<link rel="stylesheet"  href="adminlte/css/skins/skin-blue.min.css">-->
 <!--link rel="stylesheet"  href="{{ asset('adminlte/css/skins/skin-blue.min.css') }}"-->

   <link rel="stylesheet"  href="{{ asset('adminlte/css/skins/skin-blue.min.css') }}">
<link rel="stylesheet"  href="{{ asset('js/jquery.timepicker.css') }}">
 <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> 

  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bootstrap-daterangepicker/daterangepicker.css') }}"-->
 
        <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css') }}"-->
   <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/all.css') }}">
   <!-- DataTables -->

  <link rel="stylesheet" href="{{ asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
   <!-- modal -->
  <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

  <!--link type="text/css" rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/ui-lightness/jquery-ui.min.css"  /-->

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<!--body class="hold-transition skin-blue sidebar-mini"-->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{route('menu')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">AIGES</span>
      <!-- logo for regular state and mobile devices -->
      <!--img src="{{ asset('/imagenes/recursosrpt/logosistemapequenotrans.png')}}" class="user-image" alt="User Image" class="logo" style="height: auto"-->
       <span class="logo-lg"><b>AIGES</b> 

      </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Panel Navegación</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">           
            <a href="https://www.facebook.com/Centro-Escolar-Catolico-Santa-M%C3%A1ria-del-camino-173803866027545" class="dropdown-toggle" title="facebook oficial" target="__blank">
              <i class="fa fa-facebook-square"></i>
            </a>
          </li>
           <li class="dropdown notifications-menu">
             <a href="http://192.168.43.36/centroescolarwebsite/" class="dropdown-toggle"  title="Sitio web oficial" target="__blank"><i class="fa fa-wifi"></i><span class="label label-warning">WEB</span>
            </a>            
           </li> 

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar--> 
      <?php if(Auth::user()->empleado!=null):?>      
     <img src="{{asset('/imagenes/Recursohumano/'.Auth::user()->foto)}}" class="user-image" alt="User Image">    
              <span class="hidden-xs">{{Auth::user()->empleado->v_nombres}}</span>
            </a>  <?php endif ?>

             <?php if(Auth::user()->estudiante!=null):?>      
     <img src="{{ asset('/imagenes/Administracionacademica/Estudiantes/'.Auth::user()->foto) }}" class="user-image" alt="User Image">    
              <span class="hidden-xs">{{Auth::user()->estudiante->v_nombres}}</span>
            </a>  <?php endif ?>

            <?php if(Auth::user()->familiar!=null):?>      
<img src="{{ asset('/imagenes/Administracionacademica/Padresdefamilia/'.Auth::user()->foto)}}" class="user-image" alt="User Image">    
              <span class="hidden-xs">{{Auth::user()->familiar->nombres}}</span>
            </a>  <?php endif ?>


            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
            <?php if(Auth::user()->empleado!=null):?>      
     <img src="{{asset('/imagenes/Recursohumano/'.Auth::user()->foto)}}" class="user-image" alt="User Image">
      <?php endif ?>

    <?php if(Auth::user()->estudiante!=null):?>      
     <img src="{{ asset('/imagenes/Administracionacademica/Estudiantes/'.Auth::user()->foto) }}" class="user-image" alt="User Image">
      <?php endif ?>

       <?php if(Auth::user()->familiar!=null):?>      
<img  src="{{ asset('/imagenes/Administracionacademica/Padresdefamilia/'.Auth::user()->foto)}}" class="user-image" alt="User Image">
      <?php endif ?>

                <p>
                  <?php if(Auth::user()->empleado!=null):?>
                    {{Auth::user()->empleado->v_nombres.' '.Auth::user()->empleado->v_apellidos}}
                  <small>Miembro desde {{Auth::user()->empleado->created_at}}</small>
                  <?php endif ?>

                  <?php if(Auth::user()->estudiante!=null):?>
                    {{Auth::user()->estudiante->v_nombres.' '.Auth::user()->estudiante->v_apellidos}}
                    <small>Miembro desde {{Auth::user()->estudiante->created_at}}</small>
                  <?php endif ?>

                   <?php if(Auth::user()->familiar!=null):?>
                    {{Auth::user()->familiar->nombres.' '.Auth::user()->familiar->apellidos}}
                    <small>Miembro desde {{Auth::user()->familiar->created_at}}</small>
                  <?php endif ?>
                  
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <!--a href="#">Followers</a-->
                  </div>
                  <div class="col-xs-4 text-center">

                <?php if(Auth::user()->empleado!=null):?>
                   <a href="{{route('verexpedientedocente')}}">Ver perfil</a> 
                  <?php endif ?>

                  <?php if(Auth::user()->estudiante!=null):?>
                    
                  <?php endif ?>

                   <?php if(Auth::user()->familiar!=null):?>
                   
                  <?php endif ?>

    
                  </div>
                  <div class="col-xs-4 text-center">
                    <!--a href="#">Friends</a-->
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('passwordchange',Auth::user()->id)}}" class="btn btn-default btn-flat">Cambiar contraseña</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <!--i class="fa fa-circle-o-notch"></i-->   {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
   <?php if(Auth::user()->empleado!=null):?> 
  <img src="{{asset('/imagenes/Recursohumano/'.Auth::user()->foto)}}" class="image-circle" alt="User Image">    
   <?php endif ?>

 <?php if(Auth::user()->estudiante!=null): ?>
 <img src="{{ asset('/imagenes/Administracionacademica/Estudiantes/'.Auth::user()->foto) }}" class="image-circle" alt="User Image">       
 <?php endif ?>

 <?php if(Auth::user()->familiar!=null): ?>
 <img src="{{ asset('/imagenes/Administracionacademica/Padresdefamilia/'.Auth::user()->foto)}}" class="image-circle" alt="User Image">       
 <?php endif ?>

        </div>
        <div class="pull-left info">
          <?php if(Auth::user()->empleado!=null): ?>
          <p>{{Auth::user()->empleado->v_nombres}}</p>
          <?php endif ?>  

          <?php if(Auth::user()->estudiante!=null): ?>
          <p>{{Auth::user()->estudiante->v_nombres}}</p>
          <?php endif ?>

          <?php if(Auth::user()->familiar!=null): ?>
          <p>{{Auth::user()->familiar->nombres}}</p>
          <?php endif ?>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Enlinea</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
       
        <!-- Optionally, you can add icons to the links -->
 <?php if($roles[3]==true || $roles[0]==true):?><!-- si el rol es administrador academico o superusuaio entrara en el if-->
       
<li class="header">MENU PRINCIPAL</li>
 <li class="treeview nemu-close">
          <a href="#">
            <i class="fa fa-folder-open"></i> <span>Académica</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
                        
            <li class="treeview">
              <a href="#"><i class="fa  fa-graduation-cap"></i> Expediente Estudiantil
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
               <li><a href="{{ route('listaexpedientes') }}"><i class="fa fa-user"></i>Estudiantes activos</a></li>
                <li><a href="{{ route('listadeexpedientesinactivos') }}"><i class="fa fa-user-times"></i>Estudiantes inactivos</a></li>               
              </ul>
            </li>
           
            
            <li class="treeview">
              <a href="#"><i class="fa  fa-user"></i> Padres de Familia
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ route('listafamiliares')}}"><i class="fa fa-user"></i> Familiares activos</a></li>
                <li><a href="{{ route('listafamiliaresinactivos')}}"><i class="fa fa-user-times"></i> Familiares inactivos</a></li>
                
              </ul>
            </li>

             <li class="treeview">
              <a href="#"><i class="fa fa-calendar"></i> Horario de Clases
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ route('listadohorariosclase')}}"><i class="fa fa-plus-square-o"></i> Gestionar Horarios Clase</a></li>
                
              </ul>
            </li>
            
<li class="treeview">
              <a href="#"><i class="fa fa-list"></i> Matricula
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{route('listadematriculados')}}"><i class="fa fa-user"></i>Matriculas</a></li>
                
                 <li class="treeview">
                  <a href="#"><i class="fa fa-feed"></i> Solicitudes en Linea
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{route('listasolicitudesmatricula')}}"><i class="fa fa-file-text"></i>Gestionar Solicitudes</a></li>
                   
                  </ul>
                </li>
                </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa  fa-file-pdf-o"></i> Consultas y reportes
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
         <ul class="treeview-menu" style="display: none;">
    <li><a href="{{route('listareportes/secciones')}}"><i class="fa fa-user"></i>Reportes por sección</a></li>
     <li><a href="{{route('listareportes/institucional')}}"><i class="fa fa-institution"></i>Reportes institucionales</a></li>
     <li><a href="{{route('academicaconsultasadmin')}}"><i class="fa fa-database"></i>Busqueda avanzada</a></li>
        </ul>
      </li> 

    <!--li><a href="{{route('listaestadisticas')}}"><i class="fa fa-bar-chart"></i>Estadísticas y gráficos</a></li-->
     <li><a href="{{route('estadisticasgraficas')}}"><i class="fa fa-bar-chart"></i>Gráficas</a></li>

          </ul>
        </li>
    <?php endif ?>

    <?php if($roles[7]==true || $roles[0]==true):?><!-- si el rol es administrador rrhh o superusuario entrara en el if-->
<li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-group"></i> <span>Recurso Humano</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li>
              <a href="{{ route('listaexpedientesrh')}}"><i class="fa  fa-user-plus"></i> Expedientes activos</a>
            </li>
            <li>
              <a href="{{ route('listaexpedientesdesactivadosrh')}}"><i class="fa fa-user-times"></i> Expedientes Inactivos</a>
            </li>
            <!--li>
              <a href="{{ route('listaempleados')}}"><i class="fa  fa-clock-o"></i> Horarios</a>
            </li-->
            <li>
              <a href="{{ route('listapermisosrh')}}"><i class="fa  fa-list-alt"></i> Permisos</a>
            </li>
            <li>
              <a href="{{ route('consultahistorialasistencia_docente')}}"><i class="fa  fa-check-square-o"></i> Asistencias</a>
            </li> 
        <li>
      <a href="{{ route('listareportesrrhh')}}"><i class="fa fa-file-pdf-o"></i>Reportes</a>
        </li> 

             

          </ul>
        </li>
 <?php endif ?>
<?php if($roles[1]==true || $roles[0]==true):?><!-- si el rol es administrador bono escolar o superusuario entrara en el if-->

       <li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-dollar"></i> <span>Bono Escolar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;"> 
            <li><a href="{{route('listacotizaciones')}}"><i class="fa fa-list-alt"></i>Cotizaciones</a> </li>         
   <li class="treeview">
              <a href="#"><i class="fa fa-calculator"></i>Transacciones
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">                
    <li><a href="{{route('historialtransacciones')}}"><i class="fa fa-dollar"></i>Control de transacciones</a> </li>  
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-file-pdf-o"></i>Libros
           <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a>
              <ul class="treeview-menu" style="display: none;">  
    <li><a href="{{route('librooperacionyfuncionamiento')}}"><i class="fa fa-dollar"></i>Op. y funcionamiento</a> </li>
    <li><a href="{{route('librobancos')}}"><i class="fa fa-dollar"></i>Bancos</a> </li> 
    <li><a href="{{route('historialgastos')}}"><i class="fa fa-dollar"></i>Cuadro resumen de gastos</a> </li>  
              </ul>
            </li>


              </ul>
        </li>
<?php endif ?>
<?php if($roles[2]==true || $roles[0]==true):?><!-- si el rol es administrador activo fijo o superusuario entrara en el if-->
 <li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-laptop"></i> <span>Activo Fijo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">            
            <li><a href="{{route('activofijo')}}"><i class="fa  fa-sign-in"></i> Gestión activo fijo</a></li>
            <li><a href="{{route('listatraslado')}}"><i class="fa fa-truck"></i> Traslados</a></li>
             <li>
      <a href="{{route('reportesactivos_view')}}"><i class="fa fa-file-pdf-o"></i>Reportes</a>
        </li> 

        
          </ul>
            
        </li>
<?php endif ?>
<?php if($roles[4]==true || $roles[0]==true):?><!-- si el rol es docente o superusuario entrara en el if-->
         <li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-user"></i> <span>Personal docente</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('verexpedientedocente')}}"><i class="fa fa-file-image-o"></i> Expediente personal</a></li>
        <li><a href="{{route('historialpermisos')}}"><i class="fa fa-list-alt"></i> Permisos</a></li>
          
          <li class="treeview">
              <a href="#"><i class="fa fa-pencil-square-o"></i> Gestión académica
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{route('missecciones')}}"><i class="fa  fa-group"></i>Mis secciones</a></li> 
                <li><a href="{{route( 'misseccionesteacher')}}"><i class="fa  fa-calculator"></i>Calificaciones</a></li>
               <li><a href="{{route('missecciones_teacher')}}"><i class="fa fa-legal"></i>Competencias ciudadanas</a></li> 
                 <!--li><a href="#"><i class="fa  fa-calculator"></i>Control de conducta</a></li-->

               <li><a href="{{route('listaasistencias')}}"><i class="fa fa-check-square-o"></i>Control de asistencia</a></li>                    
                        
          </ul>
          </li>

       <li><a href="{{route('listareportes')}}"><i class="fa fa-file-pdf-o"></i> Reportes</a></li>


              </ul>
           </li>
<?php endif ?>
<?php if($roles[5]==true):?><!-- si el rol es estudiante -->
 <li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-child"></i> <span>Estudiantes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('verexpedienteonline',Auth::user()->estudiante->id)}}"><i class="fa  fa-file-image-o"></i> Expediente</a></li>
             <li class="treeview">
              <a href="#"><i class="fa  fa-chrome"></i> Matricula en línea
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
         <ul class="treeview-menu" style="display: none;">
    <li><a href="{{route('llenarsolicitudmatricula')}}"><i class="fa fa-edit"></i>Matricula</a></li>
     <li><a href="{{route('comprobantematricula_pdf',Auth::user()->estudiante->id)}}" target="__blank"><i class="fa fa-download"></i>Comprobante 
      <span class="pull-right-container">
      <small class="label pull-right bg-red">PDF</small>
      </span></a></li>
        </ul>
      </li> 


       <li><a href="{{route('historialcalificacionesestudianteonline',Auth::user()->estudiante->id)}}"><i class="fa fa-clipboard"></i>Historial de calificaciones</a></li>
        <li><a href="{{ route('horariodeclases_estudiante',Auth::user()->estudiante->id)}}"><i class="fa fa-table"></i>Horario de clases</a></li>   
            <!--li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Historial de calificaciones
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> 
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li!-->            
          </ul>
        </li>
<?php endif ?>

<?php if($roles[6]==true):?><!-- si el rol es Padre en el if-->
       <li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-group"></i> <span>Padres de familia</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
           <li><a href="{{route('expedienteonline',Auth::user()->familiar->id)}}"><i class="fa fa-circle-o"></i>Expediente personal</a></li> 
           <li><a href="{{route('estudiantes_familiares',Auth::user()->familiar->id)}}"><i class="fa fa-circle-o"></i>Mis estudiantes</a></li>
           
          </ul>
        </li>
<?php endif ?>

<?php if($roles[1]==true || $roles[0]==true || $roles[2]==true|| $roles[7]==true|| $roles[3]==true || $roles[4]==true):?><!-- si el usuario es todo excepto estudiante o familiar podra ingresar-->
        <!--
        <li class="treeview menu-open">
          <a href="#">
            <i class="fa fa-file-pdf-o"></i> <span>Consultas y reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Academica
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{route('nominadeestudiantespdf')}}"><i class="fa fa-circle-o"></i> Nómina de estudiantes</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Nómina de padres</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Estudiantes matriculados</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>

          </ul>
        </li>
        -->
<?php endif ?>

<?php if($roles[1]==true || $roles[0]==true || $roles[2]==true|| $roles[7]==true|| $roles[3]==true || $roles[4]==true):?>    
 <!--li class="treeview menu-open">
          <a href="#">
            <i class="fa  fa-line-chart"></i> <span>Estadisticas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Académica
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li-->

<?php endif ?>
<?php if ($roles[0]==true):?> <!--solo el superusuario podra ingresar a la opcion -->
<li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-unlock-alt"></i> <span>Seguridad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            
             <li><a href="{{route('bitacora')}}"><i class="fa fa-save"></i>Bitácora</a></li>

            <li class="treeview">
              <a href="#"><i class="fa  fa-group"></i> Usuarios
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ route('listausuariosactivos') }}"><i class="fa fa-user"></i> Gestionar usuarios</a></li>
                <li><a href="{{route('listaroles')}}"><i class="fa  fa-unlock-alt"></i>Gestionar roles</a></li>
                
        <li><a href="{{route('listadoconsultasyreportes')}}"><i class="fa fa-file-pdf-o"></i>Reportes</a></li>
             </ul>
            </li>
   
  <li class="treeview">
              <a href="#"><i class="fa fa-database"></i> Base de Datos
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{route('respaldo')}}"><i class="fa fa-arrow-circle-down"></i> Respaldo</a></li>                                
              </ul>
    </li>




 </ul>
</li>
<?php endif ?>

<?php if($roles[1]==true || $roles[0]==true || $roles[2]==true|| $roles[7]==true|| $roles[3]==true):?>

<?php if($roles[3]==true  || $roles[0]==true):?><!--configuraciones ACADEMICA-->
<li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Configuraciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu" style="display: none;">
              <li class="treeview">
              <a href="#"><i class="fa fa-folder-open"></i> Académica
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                
                <li >
                  <a href="{{ route('listagrados') }}"><i class="fa fa-circle-o"></i>Grados
                    </i>
                    </a>                  
                </li>
                <li >
                  <a href="{{ route('listasecciones') }}"><i class="fa fa-circle-o"></i>Secciones
                    </i>
                    </a>
                  
                </li>
                <li ><a href="{{ route('listaturnos') }}"><i class="fa fa-circle-o"></i>Turnos</i> </a> </li>
                 <li ><a href="{{ route('listaasignaturas') }}"><i class="fa fa-circle-o"></i>Asignaturas</i> </a> </li>
                 
                 <li ><a href="{{ route('listabloquehorarios') }}"><i class="fa fa-circle-o"></i>Horario de clases</i> </a> </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Matricula en línea
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{route('periododeinscripcionenlinea')}}"><i class="fa fa-circle-o"></i>Periodo de inscripción</a></li>                
              </ul>
            </li> 

            <?php if($roles[0]==true):?>               
              <li ><a href="{{route('ciclosacademicos')}}"><i class="fa fa-circle-o"></i>Ciclos académicos</i></a></li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Calificaciones
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{route('listaperiodosdeevaluacion')}}"><i class="fa fa-circle-o"></i>Períodos</a></li>
                <li><a href="{{route('listaevaluacionesperiodo')}}"><i class="fa fa-circle-o"></i>Evaluaciones</a></li>  
                <li><a href="{{route('listacompetenciasciudadanas')}}"><i class="fa fa-circle-o"></i>Competencia ciudadana</a></li>                       
              </ul>
            </li>
            
             <?php endif ?> 

          </ul>

<?php if($roles[7]==true  || $roles[0]==true):?>
      <li class="treeview">
              <a href=""><i class="fa fa-group"></i> Recurso humano
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
               
          <li ><a href="{{ route('listatipopersonalrh')}}"><i class="fa fa-circle-o"></i>Clasificación de personal</i></a>                  
          </li>
                <li >
           <a href="{{ route('listatipocargorh')}}"><i class="fa fa-circle-o"></i>Cargos
                    </i></a>                  
                </li>
                <li >
                  <a href="{{ route('listaespecialidadrh')}}"><i class="fa fa-circle-o"></i>Especialidades
                    </i>
                    </a>
                  
                </li>
                <li >
                  <a href="{{ route('listatipopermisosrh')}}"><i class="fa fa-circle-o"></i>Tipo permisos
                    </i>
                    </a>                  
                </li>

                <li >
                  <a href="{{route('listamotivopermisosrh')}}"><i class="fa fa-circle-o"></i>Motivo permisos
                    </i>
                    </a>                  
                </li>

              </ul>
            </li> 

      <?php endif ?>  
<?php if($roles[1]==true  || $roles[0]==true):?>
        <li class="treeview">
              <a href="#"><i class="fa fa-dollar"></i> Bono escolar
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              
              <ul class="treeview-menu" style="display: none;">
       
         <li > <a href="{{route('listaperiodocontable')}}"><i class="fa fa-circle-o"></i>Periodo contable</i></a></li>
         <li >
              <a href="{{route('listadepositodefondos')}}"><i class="fa fa-circle-o"></i>Establecer fondo disponible</i></a>
            </li>
              </ul> 
            </li>  
      <?php endif ?>  
<?php if($roles[2]==true  || $roles[0]==true):?>
            <li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i> Activo fijo
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
               <li><a href="{{route('catalogoactivo')}}"><i class="fa fa-file-text-o"></i>Catálogo de activos</a></li>
                <li >
                  <a href="{{route('listainstituciones')}}"><i class="fa fa-circle-o"></i>Instituciones destino
                    </i>
                    </a>                  
                </li>

              </ul>           
</li> 
 <?php endif ?>
</ul> 
</li> <!-- este li y ul los coloque afuera para q no me distorsiones el menu cuando cambie de tipo de rol y de privilegios sobre el menu -->
<?php endif ?>


<?php if($roles[7]==true ):?><!--configuraciones RRHH-->
  <li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Configuraciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

             <ul class="treeview-menu" style="display: none;">
            <li ><a href="{{ route('listatipopersonalrh')}}"><i class="fa fa-circle-o"></i>Clasificación de personal</i></a>                  
          </li>
                <li >
           <a href="{{ route('listatipocargorh')}}"><i class="fa fa-circle-o"></i>Cargos
                    </i></a>                  
                </li>

                <li >
                  <a href="{{ route('listaespecialidadrh')}}"><i class="fa fa-circle-o"></i>Especialidades
                    </i>
                    </a>
                  
                </li>
               
                <li >
                  <a href="{{ route('listatipopermisosrh')}}"><i class="fa fa-circle-o"></i>Tipos de permisos
                    </i>
                    </a>                  
                </li>

               </ul>
</li>
<?php endif ?> 

<?php if($roles[1]==true):?><!--configuraciones BONO ESCOLAR-->
  <li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Configuraciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

             <ul class="treeview-menu" style="display: none;">
             <li >
              <a href="{{route('listadepositodefondos')}}"><i class="fa fa-circle-o"></i>Establecer fondo disponible</i></a>
            </li>
            <li > <a href="{{route('listaperiodocontable')}}"><i class="fa fa-circle-o"></i>Periodo contable</i></a></li>
               </ul>
</li>
<?php endif ?> 


<?php if($roles[2]==true):?><!--configuraciones ACTIVO FIJO-->
  <li class="treeview menu-close">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Configuraciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

             <ul class="treeview-menu" style="display: none;">
             <li class="treeview">
              <a href="{{route('listainstituciones')}}"><i class="fa fa-circle-o"></i>Instituciones destino
                    </i>
                    </a>  
            </li>
               </ul>
</li>
<?php endif ?>
<?php endif ?>  


      <li class="treeview menu-close">
          <a href="#">
            <i class="glyphicon glyphicon-search"></i> <span>Ayuda</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            
<?php if($roles[0]==true):?><!-- si el rol es admin -->
            <li><a href="{{route('ayuda')}}"><i class="fa  fa-newspaper-o"></i>Manual de uso</a>
            </li>
<?php endif ?>

<?php if($roles[1]==true):?><!--ayuda bono escolar-->
             <li><a href="{{route('ayuda_bonoescolar')}}"><i class="fa  fa-newspaper-o"></i>Admin. bono escolar</a>
            </li>
<?php endif ?>

 <?php if($roles[2]==true):?><!-- si es administrador activo fijo-->
 <li><a href="{{route('ayuda_adminactivofijo')}}"><i class="fa  fa-newspaper-o"></i>Admin. activo fijo</a>
            </li>
<?php endif ?>

 <?php if($roles[3]==true):?><!-- si es administrador academico-->
 <li><a href="{{route('ayuda_adminacademica')}}"><i class="fa  fa-newspaper-o"></i>Admin. académica</a>
            </li>
<?php endif ?>

<?php if($roles[4]==true):?><!-- si el rol es docente-->
            <li><a href="{{route('ayuda_docente')}}"><i class="fa  fa-newspaper-o"></i>Personal docente</a>
            </li>
<?php endif ?>

<?php if($roles[5]==true):?><!-- si el rol es estudiante -->
            <li><a href="{{route('ayuda_estudiante')}}"><i class="fa  fa-newspaper-o"></i>Manual de uso</a>
            </li>
<?php endif ?>

<?php if($roles[6]==true):?><!-- padre de familia-->
 <li><a href="{{route('ayuda_padredefamilia')}}"><i class="fa  fa-newspaper-o"></i>Manual de uso</a>
            </li>
<?php endif ?>

 <?php if($roles[7]==true):?><!-- administrador recurso humano-->
 <li><a href="{{route('ayuda_adminrrhh')}}"><i class="fa  fa-newspaper-o"></i>Admin. recurso humano</a>
            </li>
<?php endif ?>



          </ul>
        </li>

        <li>
          <a href="{{route('acercade')}}">
            <i class="fa fa-info-circle"></i> <span>Acerca de </span> 
          </a>
        </li>


      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
      <!--  @yield('tittle')-->
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-chrome"></i>@yield('tittle')</a></li>
        <!--li class="active"></li-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
@include('flash::message')    
@yield('content') <!-- ESTA ES UNA DIRECTIVA DE BLADE PARA AGREGAR PAGINAS DINAMICAMENTE -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer" align="center"> 
    <!-- Default to the left -->
    <strong>Todos los derechos reservados  <a href="#">2019 UES-FMP AIGES v1.0</a></strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="{{ asset('adminlte/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
<!-- dateTables -->
<script src="{{ asset('adminlte/datatables.net/js/jquery.dataTables.min.js') }}"></script>  
<script src="{{ asset('adminlte/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script src="{{ asset('adminlte/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('adminlte/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>

<script src="{{ asset('js/jquery-idleTimeout.min.js') }}"></script>

<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('js/datepair.js') }}"></script>
<!-- InputMask -->

<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.numeric.extensions.js') }}"></script>
  <!-- moment -->
<script src="{{ asset('adminlte/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/moment/locale/es.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('adminlte/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- PARA ESTADISTICAS --> 
<script src="{{ asset('js/highcharts.js') }}"></script>

<!--script src="https://code.highcharts.com/modules/exporting.js"></script-->
<!--script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/store-js@2.0.4/dist/store.legacy.min.js"></script-->
<!--script src="{{ asset('js/export-data.js') }}"></script>
<script src="{{ asset('adminlte/chart.js/Chart.js') }}"></script-->

<!--script src="{{ asset('js/jquery-idleTimeout.min.js') }}"></script-->
<script src="{{asset('js/exporting.js')}}"></script>
<script src="{{ asset('js/graficas.js') }}"></script>
<script src="{{ asset('js/calificaciones.js') }}"></script>

</body>
<script>

$(document).ready(function(e)
 {
/*
   $(e).idleTimeout({
    idleTimeLimit: 180,
    redirectUrl: 'http://localhost/aiges/public/index.php/logout',
    customCallback: false,
    activityEvents: 'click keypress scroll wheel mousewheel mousemove',
    enableDialog: true,        // set to false for logout without warning dialog
    dialogDisplayLimit: 60,   // time to display the warning dialog before logout (and optional callback) in seconds. 180 = 3 Minutes
    dialogTitle: 'Aviso de expiración de sesión',
    dialogText: 'Por su inactividad, su sesión esta a punto de expirar.',
    sessionKeepAliveTimer: 600
  });
  */
});


$(function () {

//Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass   : 'iradio_flat-blue'
  });

//Date picker
  $('.calendario').datepicker({
    autoclose: true,
    todayBtn: 'linked',
    language: 'es',
    format: 'dd/mm/yyyy'
  });

//Timepicker
/*
  $('.timepicker').timepicker({
    minuteStep: 5,
    showInputs: false,
    defaultTime:false,
    disableFocus: true
  });
*/
//Date picker fecha nacimiento (no selecciona dias futuros)
  $('.nac').datepicker({
    autoclose: true,
    todayBtn: 'linked',
    language: 'es',
    format: 'dd/mm/yyyy',
    endDate:'0d'
  });

//Date range picker fechas pasadas desactivadas
  var dateToday = new Date();
  $('.rango').daterangepicker({
    minDate: dateToday,
    autoUpdateInput: false,
    "opens": "center",
    "locale": {
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar"
    }
  });
  
//Date range picker fechas futuras desactivadas
  $('.rangoPast').daterangepicker({
    maxDate: dateToday,
    autoUpdateInput: false,
    "opens": "center",
    "locale": {
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar"
    }
  });

$('.rangoPastYear').datepicker({
    endDate:dateToday,
    autoclose: true,
    language: 'es',
    minViewMode: 2,
    format: 'yyyy'
  });

  $('.rangoPeriodo').daterangepicker({
    autoUpdateInput: false,
    "opens": "center",    
    "locale": {
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar"
    }
  });


 $('.rangoPeriodo').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });
  $('.rangoPeriodo').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

//Calcular dias solicitados permiso rh
  $('.rango').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });
  $('.rango').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

//Date range picker fechas pasadas
  $('.rangoPast').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    document.myform.submit();
  });
  $('.rangoPast').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

 
//input mask
  $('[data-mask]').inputmask();
  $('.tel').inputmask('9999-9999',{'clearIncomplete': 'true'});
  $('.calendario').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/aaaa','clearIncomplete':'true' });
  $('.nac').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/aaaa','clearIncomplete':'true' });


//dataTables
  $('#tablaAsistencia').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 35,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  });

//dataTables
  $('#tablaBusqueda').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 15,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  });

//dataTables
  $('#tablaBusquedaauxiliar').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 5,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  })


});


//Calculo de edad
function calcular(txtfecha, txtedad){
  if(txtfecha.value!="")
  { 
    contenido = txtfecha.value.split('/');
    fecha = new Date(contenido[2], contenido[1] - 1, contenido[0]);
    ageDifMs = Date.now() - fecha.getTime();
    ageDate = new Date(ageDifMs);
    ed = Math.abs(ageDate.getUTCFullYear() - 1970);
    $('#'+txtedad).val(ed);
  }
  else{
    $('#'+txtedad).val('');
  }
}

</script>
@yield('script')
</html>