@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Traslados')
@section('content')

<div class="box box-primary">
  <div class="box-header">
   <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">TRASLADOS ACTIVO FIJO</label></h2>
              </div>
    <div class="col-sm-12 " align="right">          
      <a href="{{route('creartraslado')}}" class="btn btn-primary">Registrar Traslado</a>
    </div>
  </div>
  <hr>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead>
        <th>CODIGO</th>
        <th>CLASIFICACION</th> 
        <th>FECHA TRASLADO</th>
        <th>INSTITUCION</th>                                   
        <th>MOTIVO TRASLADO</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>
        @foreach($traslados as $traslado)
        <tr>            
          <td>{{ $traslado->activofijo->v_codigoactivo }}</td>
          <td>{{ $traslado->activofijo->cuentacatalogo->v_nombrecuenta }}</td>
          <td>{{ $traslado->f_fechatraslado }}</td>
          <td>{{ $traslado->destino->nombre_institucion }}</td>
          <td>{{ $traslado->tipotraslado->v_descripcion }}</td>
          <td>                    
            <a href="{{ route('verdetalletraslado',$traslado->id) }}" title="Ver" class="btn btn-primary" ><i class="fa fa-eye"></i></a>
            <a href="{{ route('editartraslado',$traslado->id) }}" title="Actualizar" class="btn btn-success"><i class="fa fa-edit"></i></a>
            <a href="{{ route('crearretorno',$traslado->id) }}" title="Retornar" class="btn btn-warning"><i class="fa fa-reply"></i></a>
            <a class="btn btn-danger" data-toggle="modal" title="Eliminar" data-target="#tras_{{$traslado->id}}">
              <i class="fa fa-close"></i>
            </a>
            <div class="modal fade" id="tras_{{$traslado->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header danger">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">CONFIRMAR ELIMINACION</h4>
                  </div>
                  <div class="modal-body">
                    <p>¿Esta seguro, desea eliminar el traslado del activo {{$traslado->activofijo->v_codigoactivo}}?</p>
                  </div>
                  <div class="modal-footer">
                    <form method="GET" action="{{ route('eliminartraslado',$traslado->id) }}">
                      <input type="hidden" name="id" value="{{$traslado->id}}">
                      <input type="submit" value="Eliminar" class="btn btn-sm btn-danger delete-btn">
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
  <!-- /.box-body -->
</div>
@endsection