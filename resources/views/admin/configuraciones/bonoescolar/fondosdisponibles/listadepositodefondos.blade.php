@extends('admin.menuprincipal')
@section('tittle','Configuraciones/ Bono escolar/ Fondos')
@section('content')

<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">FONDO DISPONIBLE</label></h2>
              </div>
    {!! Form::open(['route'=>'registrarfondo', 'method'=>'GET', 'class'=>'form-horizontal','id'=>'formulario']) !!}
    <input type="hidden" id="mostrarboton" value="{{$mostrarboton}}">
              <div class="col-sm-12 " align="right">        
             <a  class="btn btn-primary" id="btnnuevo">Registrar Monto</a>
                 </div>
            </div>
  <div hidden="true" class="alert alert-danger alert-dismissible" role="alert" id="errores">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <ul>
    
  </ul>
  </div>  
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                <tr>                 
                <th>CUENTA #</th>
                 <th>DESCRIPCION</th> 
                 <th>MONTO</th>                                
                 <th>ESTATUS</th>
                 <th>ACCIONES</th>
                </tr></thead>
                <tbody>
          @foreach($datos as $datos)                   
                <tr>  
                 <td>{{$datos->numero_cuenta}}</td> 
                 <td>{{$datos->descripcion}}</td>
                 <td>{{$datos->monto_disponible}}</td>                 
                 <td>{{$datos->estatus}}</td>
                 <td>
                   <a href="" class="btn btn-primary" disabled="true"><i class="fa fa-eye"></i></a>
                    <a href="{{route('editarregistrodefondo',$datos->id)}}"  title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>                   
        <a class="btn btn-danger" data-toggle="modal"  title="Eliminar" data-target="#ingreso_{{$datos->id}}">
            <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="ingreso_{{$datos->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title ">Confirmar Eliminación</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea eliminar el registro {{$datos->descripcion}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('eliminarregistrodefondo',$datos->id)}}">
                        <input type="submit" value="Eliminar" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                 
  <?php if($datos->estatus=="ACTIVO"){
  ?> 
  <a class="btn btn-warning" title="Liquidar fondo" data-toggle="modal" data-target="#modalliquidar"><i class="fa fa-level-down" ></i></a>
              <div class="modal fade" id="modalliquidar">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Confirmar Acción</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea liquidar {{$datos->descripcion}}?.</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('liquidarfondo',$datos->id)}}">
                        <input type="submit" value="Liquidar" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
  <?php } ?>    </td>
               </tr>             
          @endforeach
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
@endsection
@section('script')
<script>
  $('#btnnuevo').on('click', function(e){
if($('#mostrarboton').val()!=0)
{
   $('#errores').removeAttr('hidden');
   $('#errores').append("<li>Para agregar un nuevo fondo debe liquidar el fondo activo.</li>");
}
else 
{
  $('#formulario').submit();
}
  });



</script>
@endsection
