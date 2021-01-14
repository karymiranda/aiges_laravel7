@extends('admin.menuprincipal')
@section('tittle','Docentes/Gestión Académica/Secciones/Ingreso de Calificaciones')
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
    <div class="col-sm-4">
      <h2 class="box-title"><strong>CALIFICACIONES</strong></h2>
    </div>
    <div class="col-sm-8" align="right"></div>
  </div>
  <div class="box-body">
    <div class="col-sm-6 col-sm-offset-3">
      <table class="table table-bordered table-striped">
        <thead>
          <th>ID</th>
          <th>NIE</th>
          <th>Nombre del alumno</th>
          <th width='100'>Calificación</th>
          <th >Acción</th>
        </thead>
        <tbody>
          @foreach($notas->notas as $key => $row)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$row->alumno->v_nie}}</td>
              <td>{{$row->alumno->v_apellidos}} {{ $row->alumno->v_nombres }}</td>
              <td class="text-center">
               {{ $row->calificacion }}
              </td>
              <td class="text-center">
                <a href="{{ route('editarNotasStudentTeacher', [
                  'id'  => $row->id,
                  'nota_id' => $notas->id
                ]) }}" class="btn btn-primary" >Editar</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>  
  </div>
   <div class="box-footer" align="right">
   <a href="{{route('misseccionesteacher')}}" class="btn btn-default">Regresar</a>
</div>
</div>
@endsection

