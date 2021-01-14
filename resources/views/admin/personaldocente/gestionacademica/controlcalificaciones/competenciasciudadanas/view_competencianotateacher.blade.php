@extends('admin.menuprincipal')
@section('tittle','Docentes/ Competencias Ciudadanas')
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
      <h2 class="box-title"><strong>COMPETENCIAS CIUDADANAS</strong></h2>
    </div>


  <div class="box-body">
    <div class="col-xs-12">
      <table class="table table-bordered table-striped" id="tablaAsistencia">
        <thead>
          <th>ID</th>
          <th>NIE</th>
          <th>Nombre del alumno</th>
          <th width='100'>Criterio 1</th>
          <th width='100'>Criterio 2</th>
          <th width='100'>Criterio 3</th>
          <th width='100'>Criterio 4</th>
          <th width='100'>Criterio 5</th>
          <th width='100'>Accion</th>
        </thead>
        <tbody>
          @foreach($students as $key => $row)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$row->v_nie}}</td>
              <td>{{$row->v_apellidos}} {{ $row->v_nombres }}</td>
              <td class="text-center">{{$row->criterio_1}}</td>
              <td class="text-center">{{$row->criterio_2}}</td>
              <td class="text-center">{{$row->criterio_3}}</td>
              <td class="text-center">{{$row->criterio_4}}</td>
              <td class="text-center">{{$row->criterio_5}}</td>
              <td class="text-center">
                <a href="{{route('editCompetenciateacher',[$row->id,$id,$periodo])}}" class="btn btn-primary" >Editar</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>  
  </div>
   <div class="box-footer" align="right">
    <a href="{{route('missecciones_teacher')}}" class="btn btn-default">Regresar</a>
</div>
</div>
@endsection

