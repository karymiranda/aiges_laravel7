@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Secciones')
@section('content')
<div class="box col-sm-6 col-sm-offset-3" style="overflow: auto;width:50%;">
  <div class="box-header">
    <div class="col-sm-4">
      <h2 class="box-title"><strong>EDITAR CALIFICACIONES</strong></h2>
    </div>
    <div class="col-sm-8" align="right"></div>
  </div>
  <div class="box-body"> 
    <form action="{{route('updatenotas')}}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{ $item->id }}" />
      <input type="hidden" name="seccion_id" value="{{ $nota_id }}" />
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
                cols="5" rows="3">{{ $item->observaciones }}</textarea>
            </td>
          </tr>
          <tr >
            <td class="text-center" colspan="2">
              <a href="{{route('viewNotas', $nota_id)}}" class="btn btn-default pull-left">Cancelar</a>
              <button type="submit" class="btn btn-primary pull-right">Editar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form> 
  </div>
</div>
@endsection