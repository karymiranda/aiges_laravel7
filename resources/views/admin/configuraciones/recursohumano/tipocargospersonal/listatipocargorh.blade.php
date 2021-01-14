@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Recurso Humano')
@section('content')
<div class="box box-primary">
  <div class="box-header">
    <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">CARGOS PERSONAL</label></h2>
    </div>
    <div class="col-sm-12" align="right">            
      <a href="{{ route('creartipocargorh') }}" class="btn btn-primary">Agregar cargo</a>
    </div>
  </div>

  <!-- /.box-header -->
  <!-- /.box-body -->
  <div class="box-body" align="center">
     <table class="table table-bordered table-striped" id="tablaBusqueda" data-toggle="dataTable" data-form="deleteForm" style="width: 75%">
      <thead>
        <th>CODIGO</th>
        <th>CARGO</th>                  
        <th>ACCIONES</th>
      </thead>
      <tbody>
        @foreach($cargos as $key => $cargo)        
          <tr> 
            <td>{{ $key+1 }}</td>
            <td>{{ $cargo->v_descripcion }}</td>                 
            <td>
              <a href="{{ route('editartipocargorh',$cargo->id) }}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#cargo_{{$cargo->id}}">
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="cargo_{{$cargo->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea deshabilitar el cargo {{$cargo->v_descripcion}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('eliminartipocargorh',$cargo->id)}}">
                        <input type="hidden" name="id" value="{{$cargo->id}}">
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