@extends('admin.menuprincipal')
@section('tittle','Docentes/Secciones')
@section('content')


<div class="box">
  <div class="box-header">
    <div class="col-sm-4">
      <h2 class="box-title"><strong>SECCIONES</strong></h2>
    </div>
  </div>
  <hr>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead>
        <th>GRADO</th>
        <th>SECCION</th>
        <th>TURNO</th>
        <th>ASESOR</th>
        <th>CUPO MAXIMO</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>
         @if(!$listasecciones->isEmpty()) 
        @foreach($listasecciones as $listasecciones)
        <tr>
          <td>{{$listasecciones->seccion_grado->grado}}</td>
          <td>{{$listasecciones->seccion}}</td>
          <td>{{$listasecciones->seccion_turno->turno}}</td>
          <td>{{$listasecciones->seccion_empleado->v_nombres}} {{$listasecciones->seccion_empleado->v_apellidos}}</td>
          <td>{{$listasecciones->cupo_maximo}}</td>
          <td>
           <a href="{{ route( 'asignarnotas', ['id' => $listasecciones->id]) }}" title="Calificaciones" class="btn btn-primary" ><i
                class="fa fa-calculator"></i></a>
           <a href="#" title="Competencias ciudadanas" class="btn btn-success"><i
                class="fa fa-legal"></i></a>
            <a href="{{route('listaasistencias')}}" title="Asistencia" class="btn btn-info"><i
                class="fa fa-check-square-o"></i></a>

            <div class="btn-group">
                  <button type="button" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i></button>
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" title="Reportes">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a id="verBoleta" href="#">Boleta de notas</a></li>
                     <li><a id="matriculaxseccion" href="#" target="__blank">Alumnos matriculados</a></li>
                  <li><a id="horariodeclase" href="#"  target="__blank">Horario de clases</a></li>
                  </ul>
          </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
          <form action="#" id="selectPeriodo">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Seleccione periodo</h4>
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
                          <button type="button" 
                              class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Ver</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>


          </td>
        </tr>
        @endforeach
         @endif
      </tbody>
    </table>
  </div>


</div>
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
        $("#verBoleta").click(function(e) {
            $("#modal").modal()
        })

        $("#selectPeriodo").submit(function(e) {
            e.preventDefault();
            $('#modal').modal('hide');
            var valores = $(this).serializeArray();            
            window.open("/reportes/notas/boleta/<?php echo $listasecciones ?>/" + valores[0].value,'__blank')
        })
    })
  </script>
@endsection
