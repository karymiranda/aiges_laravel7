@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Activo Fijo')
@section('content')
<div class="box box-primary">
  <div class="box-header">
   <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">INSTITUCIONES DESTINO</label></h2>
    </div>
    <div class="col-sm-12" align="right">            
      <a href="{{ route('crearinstitucion') }}" class="btn btn-primary">Agregar institución</a>
    </div>
  </div>
  <!--hr-->
  <!-- /.box-header -->
  <!-- /.box-body -->
  <div class="box-body" align="center">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead>
        <th>CODIGO</th>
        <th>NOMBRE</th>                  
        <th>DIRECCION</th>
        <th>TELEFONO</th>                  
        <th>ACCIONES</th>
      </thead>
      <tbody>
        @foreach($instituciones as $institucion)
          <tr> 
            <td>{{ $institucion->codigo_institucion }}</td>
            <td>{{ $institucion->nombre_institucion }}</td>                 
            <td>{{ $institucion->direccion }}</td>
            <td>{{ $institucion->telefono }}</td>                 
            <td>
              <a href="{{ route('verinstitucion',$institucion->id) }}" title="Ver" class="btn btn-primary" ><i class="fa fa-eye"></i></a>
              <a href="{{ route('editarinstitucion',$institucion->id) }}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#inst_{{$institucion->id}}">
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="inst_{{$institucion->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea deshabilitar la institución {{$institucion->nombre_institucion}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('eliminarinstitucion',$institucion->id)}}">
                        <input type="hidden" name="id" value="{{$institucion->id}}">
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