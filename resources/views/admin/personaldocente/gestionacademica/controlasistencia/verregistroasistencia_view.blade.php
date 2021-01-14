@extends('admin.menuprincipal')
@section('tittle','Personal Docente/Asistencia')
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
        <h2 class="box-title"><strong>DETALLE ASISTENCIA ESTUDIANTIL</strong></h2>  
      
    </div>
  <form action="#" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="periodo" value="{{ $params['periodoactivo_id'] }}" />
    <input type="hidden" name="seccion_id" value="{{ $params['seccion_id'] }}" />
    <input type="hidden" name="f_fecha" value="{{ $params['fecha'] }}" />
    
    <div class="box-body">

<!--div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                
                Asistencia ha sido agregada.
              </div-->



      <div class="col-sm-10 col-sm-offset-1">
        <table class="table table-bordered table-striped" id="tablaAsistencia">
          <thead>
            <th>ID</th>
            <th>NIE</th>
            <th>Nombre del alumno</th>
            <th>Fecha</th>
            <th align="center">Asistió</th>
            <th align="center">Justificación</th>
             <th align="center">Observaciones </th>
              <!--th align="center">Observación</th-->
          </thead>
          <tbody>
            @foreach($students as $key => $student)
              <tr id="$tudent->id">
                <td>{{$key + 1}}</td>
                <td>{{$student->v_nie}}</td>
                <td>{{$student->v_apellidos}} {{ $student->v_nombres }}</td>
                 <th>{{$params['fecha']}}</th>
                 @if($asistencia[$key]->v_asistenciaSN=='S')
                <td align="center"><span class="label label-success"> <i class="fa fa-check"></i></span></td>               
              <td>---</td>
              <td>---</td>
                @endif

                @if($asistencia[$key]->v_asistenciaSN=='N')
              <td align="center"><span class="label label-danger"><i class="fa fa-close"></i></span></td>               
              <td>{{$asistencia[$key]->justificacion}}</td>
              <td>{{$asistencia[$key]->observacion}}</td>
                @endif
            
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>  
    </div>
    <div class="box-footer" align="right"> 
      <a href="{{route('marcarasistencia_view')}}" class="btn btn-default">regresar</a>
    </div>
  </form>
</div>
@endsection