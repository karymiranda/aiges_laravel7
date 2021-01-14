@extends('admin.menuprincipal')
@section('tittle','Docentes/Gestión Académica/Secciones/Ingreso de Calificaciones')
@section('content')
<div class="box box-primary box-solid">
   <div class="box-header with-border">
              <h2 class="box-title"><strong>AGREGAR CALIFICACIONES</strong></h2>
  </div> 
  <!--div class="box-header with-border">
  <h2 class="box-tittle"><strong>AGREGAR CALIFICACIONES </strong></h2>   
   </div-->
 
  <form action="{{route('addSaveNotateacher')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="periodo" value="{{ $params['periodo'] }}" />
    <input type="hidden" name="materia" value="{{ $params['materia'] }}" />
    <input type="hidden" name="evaluacion" value="{{ $params['evaluacion'] }}" />
    <input type="hidden" name="seccion_id" value="{{ $params['seccion_id'] }}" />
    
    <div class="box-body">
      <div class="col-sm-6 col-sm-offset-3">
        <table class="table table-bordered table-striped" id="tablaAsistencia">
          <thead>
            <th>ID</th>
            <th>NIE</th>
            <th>Nombre del alumno</th>
            <th width='100'></th>
          </thead>
          <tbody>
            @foreach($students as $key => $student)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$student->v_nie}}</td>
                <td>{{$student->v_apellidos}} {{ $student->v_nombres }}</td>
                <td>
                  <input type="hidden" name="nies[]" value="{{ $student->estudiante_id }}" />
                  <input required step="any" max="10" min="0"
                    type="number" name="notas[]" id="nota[]" class="form-control" />
                </td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>  
    </div>
    <div class="box-footer" align="right">                
      <input class="btn btn-primary" type="submit" value="Guardar">
      <a href="{{route('misseccionesteacher')}}" class="btn btn-default">Cancelar</a>
    </div>
  </form>
</div>
@endsection