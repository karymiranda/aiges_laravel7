@extends('admin.menuprincipal')
@section('tittle','Inicio')
@section('content')
<section class="content">
      <!-- Small boxes (Stat box) -->
          
<!-- FIN MENU DOCENTES -->
@foreach(Auth::user()->usuario_rol as $rol)
    <?php if($rol->v_nombrerol=='Docente'):?><!-- si el rol es administrador rrhh o superusuario entrara en el if-->
 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">             
              <h3><i class="fa fa-street-view"></i></h3> 
              <p>MIS SECCIONES</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{route('missecciones')}}" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
          </div>
  </div>
<!-- ./col -->

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <h3><i class="fa fa-edit"></i></h3>
 
            <p>CALIFICACIONES</p>
            </div>
            <div class="icon">
              <i class="fa fa-table"></i>
            </div>
            <a href="{{route('misseccionesteacher')}}" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
          </div>
  </div>


<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">             
              <h3><i class="fa fa-outdent"></i></h3> 
              <p>COMPETENCIAS CIUDADANAS</p>
            </div>
            <div class="icon">
              <i class="fa fa-venus-double"></i>
            </div>
            <a href="{{route('missecciones_teacher')}}" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
          </div>
  </div>
<!-- ./col -->

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">             
              <h3><i class="fa fa-check-square-o"></i></h3> 
              <p>ASISTENCIA</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('marcarasistencia_view')}}" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
          </div>
  </div>
<!-- ./col -->

<!-- ./col -->
  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <h3><i class="fa fa-user-plus"></i></h3>
              <p>MI EXPEDIENTE</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-open-o"></i>
            </div>
            <a href="{{route('verexpedientedocente')}}" class="small-box-footer">Ir<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


<!-- ./col -->
  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <h3><i class="fa fa-list"></i></h3>
              <p>MIS PERMISOS</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-excel-o"></i>
            </div>
            <a href="{{route('historialpermisos')}}" class="small-box-footer">Ir<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <h3><i class="fa fa-clock-o"></i></h3>
              <p>MI HORARIO DE CLASES</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="{{route('mihorariodeclases')}}" class="small-box-footer">Ir<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><i class="fa fa-file-pdf-o"></i></h3>

              <p>CONSULTAS Y REPORTES</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cloud-download-outline"></i>
            </div>
            <a href="{{route('listareportes')}}" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
<?php endif ?>

<!-- FIN MENU DOCENTES -->


<?php if($rol->v_nombrerol=='Administrador academico' || $rol->v_nombrerol=='Super Administrador'):?>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$countsecciones}}</h3>
 
              <p>SECCIONES</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people-outline"></i>
            </div>
            <a href="{{route('listasecciones')}}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$alcance}}<sup style="font-size: 20px"></sup></h3>

              <p>MATRICULAS</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('listadematriculados')}}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$countestudiantesactivos}}</h3>

              <p>ESTUDIANTES ACTIVOS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('listaexpedientes')}}" class="small-box-footer">Más información  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$countmatriculasonline}}</h3>

              <p>SOLICITUDES MATRICULA EN LINEA</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cloud-download-outline"></i>
            </div>
            <a href="{{route('listasolicitudesmatricula')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
<?php endif ?>




<div class="box-body" align="center" id="graficas" <?php if($rol->v_nombrerol=='Administrador academico' || $rol->v_nombrerol=='Super Administrador'){?>  <?php }else{?>hidden="true"<?php }?>>

<?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>

<div  class="row" >
<!--div class="col-md-6">
                  <label>Año</label>
                  <select class="form-control" id="anio_sel"  onchange="cambiar_anio_grafica();">

                  <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
                    <option value="2015" >2015</option>
                    <option value="2016" >2016</option>
                    <option value="2017" >2017</option>
                    <option value="2018">2018</option>
                    <option value="2019" >2019</option>
                    <option value="2020" >2019</option>
                  </select>

</div-->


<!--div class="col-md-6">
                  <label>Mes</label>
                  <select class="form-control" id="mes_sel" onchange="cambiar_fecha_grafica();" >
                  <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>
                  
                  </select>

</div-->
</div>


<br/>
  <div class="box box-primary ">
    <div class="box-header with-border">
      <h3 class="box-tittle"></h3>
      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
    </div>

    <div class="box-body" id="div_grafica_barras" style="min-width: 310px; height: 400px; margin: 0 auto">

    </div>

      <!--div class="box-footer">
    </div-->
  </div>
 

    <br/>
  <div class="box box-primary">
   <div class="box-header with-border">
      <h3 class="box-tittle"></h3>
      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
    </div>

    <div class="box-body" id="div_grafica_lineas">
    </div>

<p class="highcharts-description">
        El gráfico refleja el historial de los últimos cinco años, de estudiantes matriculados en el Centro Educativo. 
    </p>
      <div class="box-footer">
    </div>
  </div>


  <br/>

  <!--div class="box box-primary">
   <div class="box-header with-border">
      <h3 class="box-tittle"></h3>
      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
    </div>

    <div class="box-body" id="div_grafica_pie">
    </div>

      <div class="box-footer">
    </div>
  </div-->

</div>







 <!--      MENU MODULO RECURSOS HUMANOS            -->
<?php if($rol->v_nombrerol=='Administrador recurso humano' || $rol->v_nombrerol=='Super Administrador'):?>
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$countrrhhactivos}}</h3>
 
              <p>EXPEDIENTES RRHH</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{route('listaexpedientesrh')}}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
             <h3><i class="fa fa-edit"></i></h3>
              <p>CONTROL DE ASISTENCIAS</p>
            </div>
            <div class="icon">
              <i class="fa  fa-clock-o"></i>
            </div>
            <a href="{{route('consultahistorialasistencia_docente')}}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--div class="small-box bg-yellow"-->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><i class="fa fa-clipboard"></i></h3>

              <p>PERMISOS Y LICENCIAS</p>
            </div>
            <div class="icon">
              <i class="fa fa-table"></i>
            </div>
            <a href="{{route('listapermisosrh')}}" class="small-box-footer">Más información  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--div class="small-box bg-red"-->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><i class="fa fa-print"></i></h3>

              <p>REPORTES</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-pdf-o"></i>
            </div>
            <a href="{{route('listareportesrrhh')}}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
<?php endif ?>


<?php if($rol->v_nombrerol=='Administrador bono escolar' || $rol->v_nombrerol=='Super Administrador'):?>
 <!--      MENU MODULO BONO ESCOLAR            -->

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>$ {{$saldobancos->saldo_bancos}}</h3> 
              <p>BANCOS</p>
            </div>
            <div class="icon">
              <i class="fa fa-bank"></i>
            </div>
            <a href="{{route('historialtransacciones')}}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--div class="small-box bg-green"-->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>${{$saldobancos->saldo}}</h3>

              <p>CUENTA DE FUNCIONAMIENTO</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card"></i>
            </div>
            <a href="{{route('librooperacionyfuncionamiento')}}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--div class="small-box bg-yellow"-->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><i class="fa fa-shopping-cart"></i></h3>

              <p>GASTOS </p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="{{route('historialgastos')}}" class="small-box-footer">Más información  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

       
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--div class="small-box bg-aqua"-->
          <div class="small-box bg-aqua">
            <div class="inner">
               <h3><i class="fa fa-check-square-o"></i></h3>

              <p>COTIZACIONES</p>
            </div>
            <div class="icon">
              <i class="fa fa-list-alt"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
<?php endif ?>


<?php if($rol->v_nombrerol=='Administrador activo fijo' || $rol->v_nombrerol=='Super Administrador'):?>
 <!--      MENU MODULO BONO ESCOLAR            -->

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><i class="fa fa-list-ol"></i></h3> 
              <p>CLASIFICACION DE ACTIVOS</p>
            </div>
            <div class="icon">
              <i class=" fa fa-sitemap"></i>
            </div>
            <a href="{{route('listasecciones')}}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--div class="small-box bg-green"-->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><i class="fa fa-print"></i></h3>

              <p>ACTIVOS REGISTRADOS</p>
            </div>
            <div class="icon">
              <i class="fa fa-building-o"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--div class="small-box bg-yellow"-->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><i class="fa fa-truck"></i></h3>

              <p>TRASLADOS</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck"></i>
            </div>
            <a href="{{route('listaexpedientes')}}" class="small-box-footer">Más información  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

       
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--div class="small-box bg-red"-->
            <div class="small-box bg-aqua">
            <div class="inner">
              <h3><i class="fa fa-download"></i></h3>

              <p>ACTIVOS DESCARGADOS</p>
            </div>
            <div class="icon">
              <i class="fa fa-download"></i>
            </div>
            <a href="#" class="small-box-footer">Más información<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
<?php endif ?>




@endforeach

</section>

@endsection

@section('script')
 <script type="text/javascript"> 
  cargar_graficamatriculas(<?= $anio; ?>);
  cargar_graficamatriculasanio(<?= $anio; ?>);
 </script>
       
@endsection