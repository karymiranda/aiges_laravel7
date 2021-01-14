@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Catálogo de cuentas')
@section('content')

  <div class="box box-primary">
    <div class="box-header">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">CATALOGO DE CODIFICACION ACTIVO FIJO</label></h2>
              </div>
      <div class="col-sm-12" align="right">          
        <a href="{{route('crearcatalogoactivo')}}" class="btn btn-primary">Registrar cuenta</a>
      </div>
    </div>
                      
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>CODIGO</th>
          <th>TIPO DE BIEN</th> 
          <th>NIVEL</th>
           <!--th>TIPO CUENTA</th>
            <th>TIPO SALDO</th-->
          <th>ACCIONES</th>
        </thead>
        <tbody>
          @foreach($cuentas as $cuenta)          
            <tr>            
              <td>{{ $cuenta->v_codigocuenta }}</td>
              <td>{{ $cuenta->v_nombrecuenta }}</td>
              <td>{{ $cuenta->v_nivel }}</td>
              <!--td>{{ $cuenta->clasificacioncuentacatalogo->v_tipocuenta }}</td>
              <td>{{ $cuenta->v_tiposaldo }}</td-->
              <td>                    
                <a href="{{route('editarcatalogoactivo',$cuenta->id)}}" title="Actualizar" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#cuenta_{{$cuenta->id}}">
                  <i class="fa fa-close"></i>
                </a>
                <div class="modal fade" id="cuenta_{{$cuenta->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">CONFIRMAR ACCION</h4>
                      </div>
                      <div class="modal-body">
                        <p>¿Esta seguro, desea deshabilitar la cuenta {{$cuenta->v_nombrecuenta}}?</p>
                        <p><b>Nota: Para deshabilitar la cuenta debe hacer antes el descargo de los activos que estuviesen relacionados</b></p>
                      </div>
                      <div class="modal-footer">
                        <form method="GET" action="{{route('eliminarcatalogoactivo',$cuenta->id)}}">
                          <input type="hidden" name="id" value="{{$cuenta->id}}">
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
    <!-- /.box-body --> 
  </div>
@endsection