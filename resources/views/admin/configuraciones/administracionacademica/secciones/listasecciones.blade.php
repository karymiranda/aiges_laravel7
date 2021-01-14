@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Secciones')
@section('content')


<div class="box box-primary">
  <div class="box-header">
    <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">SECCIONES</label></h2>
    </div>
    <div class="col-sm-12" align="right">
      <a href="{{route('agregarseccion')}}" class="btn btn-primary">Registrar sección</a>
@if($cantidadsecciones==0)
    <a href="{{route('duplicarsecciones')}}" class="btn btn-primary"></i> Duplicar secciones del año anterior</a>
@endif

    </div>
  </div>
  <hr>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead>
        <th>No</th>
        <th>GRADO</th>
        <th>SECCION</th>
        <th>TURNO</th>
        <th>ASESOR</th>
        <th>MATRICULAS</th>
        <!--th>CUPO MAXIMO</th-->
        <th>SECCION INTEGRADA</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>
        @foreach($listasecciones as $key => $listasecciones)
        <tr id="{{$listasecciones->id}}">
          <td>{{$key+1}}</td>
          <td>{{$listasecciones->seccion_grado->grado}}</td>
          <td>{{$listasecciones->seccion}}</td>
          <td>{{$listasecciones->seccion_turno->turno}}</td>

                 @if($listasecciones->seccion_empleado==null) 
                 <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                @if($listasecciones->seccion_empleado!=null) 
                 <td>{{$listasecciones->seccion_empleado->v_nombres}} {{$listasecciones->seccion_empleado->v_apellidos}}</td>
                   @endif 


          <td>{{$listasecciones->seccion_estudiante_count}}</td>
          <?php if($listasecciones->seccionintegrada==1){?><td>SI</td> <?php }else{?> <td>NO</td><?php }?>
          
          <td>
            <a href="{{route('verseccion',$listasecciones->id)}}" title="Ver" class="btn btn-primary"><i
                class="fa fa-eye"></i></a>
            <a href="{{route('editarseccion',$listasecciones->id)}}" title="Editar" class="btn btn-success"><i
                class="fa fa-edit"></i></a>
            <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar"
              data-target="#seccion_{{$listasecciones->id}}">
              <i class="fa fa-close"></i>
            </a>
            <div class="modal fade" id="seccion_{{$listasecciones->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header danger">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">CONFIRMAR ACCION</h4>
                  </div>
                  <div class="modal-body">
                    <p>¿Está seguro, desea deshabilitar la sección {{$listasecciones->seccion}}?</p>
                  </div>
                  <div class="modal-footer">
                    <form method="GET" action="{{route('desactivarseccion',$listasecciones->id)}}">
                      <input type="hidden" name="id" value="{{$listasecciones->id}}">
                      <input type="submit" value="Deshabilitar" class="btn btn-sm btn-danger delete-btn">
                      <button type="button" class="btn btn-sm btn-default cancel-btn"
                        data-dismiss="modal">Cancelar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="btn-group">
                  <button type="button" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i></button>
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button> 
                  <ul class="dropdown-menu" role="menu">
                    <!--li><a href="#">Asignar asesor de sección</a></li-->
                     
                      @if(strlen(strstr($listasecciones->seccion_grado->nivel_educativo,'Educación básica'))>0)
                      <li><a href="{{ route( 'asignarnotas', ['id' => $listasecciones->id]) }}">Ingresar calificaciones</a></li> 
                      <li><a href="{{route('asignarponderacioncompetencia', ['id' => $listasecciones->id])}}">Ingresar competencias ciudadanas</a></li>
                       <li><a href="{{route('periodorefuerzonotas', ['id' => $listasecciones->id,'modulo' => 'admin'])}}">Refuerzo académico</a></li>

                      @endif
                                       
                    
                    <li><a href="{{route('tomarasistencia_view',['id' => $listasecciones->id])}}">Tomar asistencia</a></li>

                     @if(strlen(strstr($listasecciones->seccion_grado->nivel_educativo,'Educación básica'))>0)

                    <li> <a href="{{ route('cuadroFinal.show',  $listasecciones->id) }}">Cuadro Final</a> </li>
                    <li class="divider"></li>
                    <!--li><a onclick="seleccionarperiodo({{$listasecciones->id}});" id="verBoleta_{{$listasecciones->id}}" href="#">Ver boleta de notas</a></li-->
                     <li><a href="{{route('reporteBoleta',$listasecciones->id)}}" target="__blank">Ver boleta de notas</a></li>
                     @endif
                     <li><a id="matriculaxseccion" href="{{ route( 'docentesnominadeestudiantes_pdf',  $listasecciones->id) }}" target="__blank">Ver alumnos matriculados</a></li>
                  <li><a id="horariodeclase" href="{{ route( 'horariosdeclases_pdf', $listasecciones->id) }}"  target="__blank">Ver horario de clases</a>
                  </li>

                    @if(strlen(strstr($listasecciones->seccion_grado->nivel_educativo,'Educación parvularia'))>0)
                          <li class="divider"></li>
                           <li><a href="{{ route( 'cerrarSeccionParvularia', $listasecciones->id) }}">Cerrar sección 
      <span class="pull-right-container">
      <small class="label pull-right bg-red">Parvularia</small>
      </span>
                          </a></li> 

                        @endif

                  </ul>
          </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
          <form action="#" id="selectPeriodo" method="post">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">BOLETAS DE CALIFICACIONES</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Periodo</label>
                                  <select class="form-control" name="periodo" id="periodo">
                                      @foreach ($periodos as $item)
                                          <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Generar boletas</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                  </div>
                  </div>
              </div>
          </form>
      </div>


          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>


</div>
@endsection
@section('script')
  <script type="text/javascript">
    var seccion_id;//la declaro global 

    function seleccionarperiodo(idseccion)
    {
 seccion_id= idseccion; // table row ID 
$("#modal").modal()
    }

    $(document).ready(function() {
   

        $("#selectPeriodo").submit(function(e) {
            e.preventDefault();
            $('#modal').modal('hide');
            var valores = $(this).serializeArray();
            //window.open("reporteBoleta/"+seccion_id+"/"+valores[0].value,'__blank')
            window.open("reporteBoleta/"+seccion_id,'__blank')
          
        })
    })
  </script>
@endsection
