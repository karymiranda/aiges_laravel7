@extends('admin.menuprincipal')
<?php
if($modulo=='admin'){$titulo='Administración Académica/Estudiantes/ Competencias Ciudadanas';}

if($modulo=='docentes'){$titulo='Personal Docente / Mis Secciones / Competencias Ciudadanas';}
?> 
@section('tittle',$titulo)
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
    <h2 class="box-title"> CALIFICAR  COMPETENCIA </h2>
    <label class="text-white"></label>
  </div>
  <form action="{{route('addSaveCompetenciasingleadmin')}}" method="POST">
    {{ csrf_field() }}
<input type="hidden" name="modulo" value="{{$modulo}}">
    <div class="box-body">

<div class="col-xs-6 col-sm-offset-3">
<table class="table table-bordered table-striped">
          <thead>
            <th>Criterio</th>
            <th>Descripción</th>
          </thead>
          <tbody>
             @foreach($comp as $key => $comp)
            <tr>
                <td>Criterio {{$key + 1}}</td>
                <td>{{$comp->competencia}}</td>
            </tr>
           @endforeach
          </tbody>
</table>
</div>
      <div class="col-xs-12">
        <table class="table table-bordered table-striped" id="">
          <thead>
            <th>NIE</th>
            <th>Nombre del alumno</th>
            <th width='100'>Criterio 1</th>
            <th width='100'>Criterio 2</th>
            <th width='100'>Criterio 3</th>
            <th width='100'>Criterio 4</th>
            <th width='100'>Criterio 5</th>
          </thead>
          <tbody>
           <tr>
                
                <td>{{$students->v_nie}}</td>
                <td>{{$students->v_apellidos}} {{ $students->v_nombres }}</td>
                @foreach($criterios as $key)
                <td>
                  <select name="cr1[]" id="cr1[]" class="form-control" required>
                    
                    <option value="E">E</option>	
                    <option value="MB">MB</option>
                    <option value="B">B</option>
                  </select>
                </td>
                @endforeach
              </tr>
          </tbody>
        </table>
      </div>  
    </div>
    <div class="box-footer" align="right">
      <input type="hidden" name="seccion" value="{{ $params['seccion_id'] }}">
      <input type="hidden" name="periodo" value="{{ $params['periodo'] }}">
       <input type="hidden" name="estudiante_id" value="{{ $params['estudiante_id'] }}">
      <input class="btn btn-primary" type="submit" value="Guardar">

<?php
if($modulo=='admin'){?>
  <a href="{{route('listaexpedientes')}}" class="btn btn-default">Cancelar</a>
    <?php } ?>

<?php
if($modulo=='docentes'){?>
  <a href="{{route('nominadeestudiantes',$params['seccion_id'])}}" class="btn btn-default">Cancelar</a>
<?php } ?> 



    </div>
  </form>
</div>
@endsection