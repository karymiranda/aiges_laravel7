@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Recurso Humano')
@section('content')
<div class="box box-primary">
  <div class="box-header">
     <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">ESPECIALIDADES </label></h2>
    </div>
    <div class="col-sm-12" align="right">            
      <a href="{{ route('crearespecialidadrh') }}" class="btn btn-primary">Agregar especialidad</a>
    </div>
  </div>
  <hr>
  <!-- /.box-header -->
  <!-- /.box-body -->
  <div class="box-body" align="center">
    <table class="table table-bordered table-striped" style="width: 75%" id="tablaBusqueda">
      <thead>
        <th>CODIGO</th>
        <th>ESPECIALIDAD</th>                  
        <th>ACCIONES</th>
      </thead>
      <tbody>
        @foreach($especialidades as $especialidad)
          <tr> 
            <td>{{ $especialidad->id }}</td>
            <td>{{ $especialidad->v_especialidad }}</td>                 
            <td>
              <a href="{{ route('editarespecialidadrh',$especialidad->id) }}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#espe_{{$especialidad->id}}">
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="espe_{{$especialidad->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea deshabilitar la especialidad {{$especialidad->v_especialidad}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('eliminarespecialidadrh',$especialidad->id)}}">
                        <input type="hidden" name="id" value="{{$especialidad->id}}">
                        <input type="submit" value="Deshabilitar" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>  
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection