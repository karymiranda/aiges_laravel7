@extends('admin.menuprincipal')
@section('tittle','Administración académica')
@section('content')
<div class="box box-primary">
  <div class="box-header">
    <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">HORARIOS DE CLASES {{$anio}}</label></h2>
    </div>
    <div class="col-sm-12" align="right">            
      <a href="{{ route('crearhorariosclase') }}" class="btn btn-primary">Registrar horario</a>
    </div>
  </div>
  <hr>
  <!-- /.box-header -->
  <!-- /.box-body -->
  <div class="box-body" align="center">
    <table class="table table-bordered table-striped" style="width: 80%" id="tablaBusqueda">
      <thead>
        <th>GRADO</th>
        <th>SECCION</th>
        <th>TURNO</th>                  
        <th>ENCARGADO</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>
        @foreach($secciones as $seccion)
        <tr>
          <td>{{ $seccion->seccion_grado->grado }}</td>
          <td>{{ $seccion->seccion }}</td>
          <td>{{ $seccion->seccion_turno->turno }}</td>
          <td>{{ $seccion->seccion_empleado->v_nombres .' '. $seccion->seccion_empleado->v_apellidos}}</td>
          <td>
            <a href="{{route('verhorariosclase',$seccion->id)}}" title="Ver" class="btn btn-info"><i class="fa fa-eye"></i></a>
            <a href="{{route('editarhorariosclase',$seccion->id)}}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger" data-toggle="modal" title="Eliminar" data-target="#hora">
              <i class="fa fa-close"></i>
            </a>
            <div class="modal fade" id="hora">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header danger">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Confirmar Eliminar</h4>
                  </div>
                  <div class="modal-body">
                    <p>¿Esta seguro, desea eliminar el horario de clases de {{$seccion->seccion_grado->grado.' '.$seccion->seccion}}?</p>
                  </div>
                  <div class="modal-footer">
                    <form method="GET" action="{{route('eliminarhorariosclase',$seccion->id)}}">
                      <input type="submit" value="Eliminar" class="btn btn-sm btn-danger delete-btn">                               
                      <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
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
                  <li><a id="horariodeclase" href="{{ route( 'horariosdeclases_pdf', ['id' => $seccion->id]) }}"  target="__blank">Generar PDF </a></li>
                  </ul>
          </div>

          </td>          
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection