@extends('admin.menuprincipal')
<?php
if($modulo=='admin'){$titulo='Administración Académica/Estudiantes/Calificaciones';}

if($modulo=='docentes'){$titulo='Personal Docente / Ingreso Individual de Calificaciones';}
?> 
@section('tittle',$titulo)
@section('content')
<div class="box box-primary col-sm-6 col-sm-offset-3" style="overflow: auto;width:50%;">
  <div class="box-header">
    <div class="col-sm-4">
      <h2 class="box-title"><strong>EDITAR CALIFICACIONES</strong></h2>
    </div>
    <div class="col-sm-8" align="right"></div>
  </div>
  <div class="box-body">
    <form action="{{ route('updatenotessingleadmin')}}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{ $item->id }}" />
      <input type="hidden" name="seccion_id" value="{{ $nota_id }}" />
      <input type="hidden" name="estudiante_id" value="{{ $item->alumno->id }}" />
      <input type="hidden" name="modulo" value="{{$modulo}}" />
      
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <td>NIE: </td>
            <td>
              <input type="text" class="form-control"
                name="nie" id="nie" disabled value={{ $item->alumno->v_nie }} />
            </td>
          </tr>
          <tr>
            <td>Nombre: </td>
            <td>
              <input type="text" name="nombres" 
                id="nombres" disabled class="form-control"
                value="{{ $item->alumno->v_nombres."  ".$item->alumno->v_apellidos }} " />
            </td>
          </tr>

          <tr>
            <td>Nota actual: </td>
            <td>
              <input type="text" name="nombres" 
                id="nombres" disabled class="form-control"
                value="{{ $item->calificacion }} " />
            </td>
          </tr>

          <tr>
            <td>Nueva nota: </td>
            <td>
              <input required step="any" max="10" min="1" placeholder="Nueva nota"
                type="number" name="notaUpdate" id="notaUpdate" class="form-control" />
            </td>
          </tr>

          <tr>
            <td>Observaciones: </td> 
            <td>
              <textarea name="observaciones" class="form-control"
                id="observaciones" placeholder="Observaciones (requeridas)" 
                cols="5" rows="3" required="true">{{ $item->observaciones }}</textarea>
            </td>
          </tr>
          <tr >
            <td  colspan="2">         
              <a href="{{route('listnotessingleadmin',[$item->alumno->id,$modulo])}}" class="btn btn-default pull-right ">Cancelar</a>
              <button type="submit" class="btn btn-primary pull-right ">Actualizar</button> 
                  
            </td>
          </tr>
        </tbody>
      </table>
    </form> 
  </div>
</div>
@endsection

