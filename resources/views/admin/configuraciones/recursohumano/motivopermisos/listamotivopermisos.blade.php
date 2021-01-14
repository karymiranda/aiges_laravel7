@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Recurso Humano')
@section('content')
<div class="box box-primary">
  <div class="box-header">
     <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">MOTIVO PERMISOS</label></h2>
    </div>
    <div class="col-sm-12" align="right">            
      <a href="{{ route('crearmotivopermisosrh') }}" class="btn btn-primary">Registrar motivo</a>
    </div>
  </div>
  <hr>
<!-- /.box-header -->
  <div class="box-body" align="center">
    <table class="table table-bordered table-striped" id="tablaBusqueda" style="width: 75%">
      <thead>
        <th>CODIGO</th>
        <th>MOTIVO</th>
        <th>MAXIMO DIAS MENSUAL</th> 
        <th>MAXIMO DIAS ANUAL</th> 
        <th>OBSERVACIONES</th>         
        <th>ACCIONES</th>
      </thead>
      <tbody>
      @foreach($motivoPermisos as $key => $value)
      <tr>
        <td>{{$key+1}}</td>
        <td>{{$value->v_motivo}}</td>
        <td>{{$value->i_maximodiasanual}}</td>        
        <td>{{$value->i_maximodiasmensual}}</td>        
        <td>{{$value->v_observaciones}}</td>
        <td>
            <a href="{{ route('editartipopermisosrh',$value->id) }}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#value_{{$value->id}}">
              <i class="fa fa-close"></i>
            </a>
            <div class="modal fade" id="value_{{$value->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header danger">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">CONFIRMAR ACCION</h4>
                  </div>
                  <div class="modal-body">
                    <p>¿Está seguro, desea deshabilitar el motivo {{$value->v_motivo}}?</p>
                  </div>
                  <div class="modal-footer">
                    <form method="GET" action="{{route('eliminartipopermisosrh',$value->id)}}">
                      <input type="hidden" name="id" value="{{$value->id}}">
                      <input type="submit" value="Deshabilitar" class="btn btn-sm btn-danger delete-btn">                               
                      <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
      </tr>
      @endforeach       
      </tbody>
    </table>
  </div>
</div>
<!-- /.box-body -->
@endsection