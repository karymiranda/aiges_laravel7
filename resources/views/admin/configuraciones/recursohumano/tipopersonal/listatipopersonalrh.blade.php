@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Recurso Humano')
@section('content')
<div class="box box-primary">
  <div class="box-header">
     <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">CLASIFICACION DE PERSONAL</label></h2>
    </div>
    <div class="col-sm-12" align="right">            
      <a href="{{ route('creartipopersonalrh') }}" class="btn btn-primary">Agregar clasificación</a>
    </div>
  </div>
<!-- /.box-header -->
  <div class="box-body" align="center">
    <table class="table table-bordered table-striped" id="tablaBusqueda" style="width: 75%">
      <thead>
        <th>CODIGO</th>
        <th>TIPO PERSONAL</th>                  
        <th>ACCIONES</th>
      </thead>
      <tbody>
        @foreach($tipos as $key => $tipo)
        <tr> 
          <td>{{ $key+1 }}</td>
          <td>{{ $tipo->v_tipopersonal }}</td>                 
          <td>
            <a href="{{ route('editartipopersonalrh',$tipo->id) }}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#tipo_{{$tipo->id}}">
              <i class="fa fa-close"></i>
            </a>
            <div class="modal fade" id="tipo_{{$tipo->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header danger">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">CONFIRMAR ACCION </h4>
                  </div>
                  <div class="modal-body">
                    <p>¿Está seguro, desea deshabilitar el tipo personal {{$tipo->v_tipopersonal}}?</p>
                  </div>
                  <div class="modal-footer">
                    <form method="GET" action="{{route('eliminartipopersonalrh',$tipo->id)}}">
                      <input type="hidden" name="id" value="{{$tipo->id}}">
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
<!-- /.box-body -->
@endsection