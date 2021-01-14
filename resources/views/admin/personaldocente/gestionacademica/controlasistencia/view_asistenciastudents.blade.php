@extends('admin.menuprincipal')
@section('tittle','Personal Docente/Asistencia')
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
      <div class="col-sm-4">
        <h2 class="box-title"><strong> ASISTENCIA ESTUDIANTES</strong></h2>
      </div>
    </div>
  <form action="guardarasistenciasteacher" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="periodoactivo_id" value="{{ $params['periodoactivo_id'] }}" />
    <input type="hidden" name="seccion_id" value="{{ $params['seccion_id'] }}" />
    <input type="hidden" name="fecha" value="{{ $params['fecha'] }}" />
    
    <div class="box-body">

<!--div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i></h4>
                Asistencia ha sido agregada.
              </div-->

  

      <div class="col-sm-10 col-sm-offset-1">
        <table class="table table-bordered table-striped" id="tablaAsistencia">
          <thead>
            <th>ID</th>
            <th>NIE</th>
            <th>Nombre del alumno</th>
            <th>Fecha</th>
            <th align="center">¿Faltó?</th>
             <th align="center">Motivo </th>
              <th align="center">Observación</th>
          </thead>
          <tbody>

            @foreach($students as $key => $student)
              <tr id="$tudent->id">
                <td>{{$key + 1}}</td>
                <td>{{$student->v_nie}}</td>
                <td>{{$student->v_apellidos}} {{ $student->v_nombres }}</td>
                 <th>{{$params['fecha']}}</th>
                <td align="center">
              <input type="hidden" name="ids[]" value="{{ $student->estudiante_id }}" />    <input type="checkbox" name="falto[{{ $student->estudiante_id }}]" id="{{ $student->estudiante_id }}" data-toggle="modal" data-target="">           
            
              </td>
              <td>{!! Form::select('justificacion[]',['Sin justificar'=>'Sin Justificar','Socioeconómico'=>'Socioeconómico','Enfermedad'=>'Enfermedad','Otros'=>'Otros'],null,['class'=>'form-control '])!!}</td>
              <td>{!! Form::text('observacion[]',null,['class'=>'form-control ','placeholder'=>'Observaciones'])!!} </td>
 
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>  
    </div>
    <div class="box-footer" align="right">

      <input class="btn btn-primary" type="submit" value="Guardar">
      <a href="{{route('marcarasistencia_view')}}" class="btn btn-default">finalizar</a>
    </div>
  </form>
</div>
@endsection