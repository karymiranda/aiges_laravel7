@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Bono Escolar/Ciclos Contable')
@section('content')
<div class="box box-primary">
            <div class="box-header">
               <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">PERIODOS CONTABLES</label></h2>
              </div>
    {!! Form::open(['route'=>'registrarperiodocontable', 'method'=>'GET', 'class'=>'form-horizontal','id'=>'formulario']) !!}
    <input type="hidden" id="mostrarboton" value="{{$mostrarboton}}">
              <div class="col-sm-12" align="right">         
                <a href="#" class="btn btn-primary" id="btnnuevo">Registrar periodo</a>
          </div>
      </div>
  {!! Form::close() !!}
  <HR>
  <div hidden="true" class="alert alert-danger alert-dismissible" role="alert" id="errores">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <ul>
    
  </ul>
  </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" align="center">
              <table class="table table-bordered table-striped" id="tablaBusqueda" style="width: 75%">
                <thead>  
                  <th>DESCRIPCION PERIODO CONTABLE</th>
                  <th>AÑO</th>                 
                  <th>ESTADO</th>                       
                  <th>ACCIONES</th>
                </thead>
                <tbody>
                 @foreach($ciclos as $ciclos)
                <tr>  
                 <td>{{$ciclos->nombre}}</td>        
                 <td>{{$ciclos->anio}}</td> 
               
                 @if($ciclos->estado=='1')
                  <td><span class="label label-success">VIGENTE</span></td>
                 @else
                  <td><span class="label label-warning">CERRADO</span></td>
                 @endif                 
                 <td>
        <a href="#" class="btn btn-primary" disabled="true"><i class="fa fa-eye"></i></a>
        <a href="{{route('editarperiodocontable',$ciclos->id)}}" class="btn btn-success" title="Editar"><i class="fa fa-edit"></i></a>                    
      <!--a  href="#" class="btn btn-danger"  disabled="true"><i class="fa fa-close"></i></a-->
             
              @if($ciclos->estado=='1')
              <a  href="#" class="btn btn-danger" title="Cerrar ciclo contable" data-toggle="modal" data-target="#ciclos_{{$ciclos->id}}"><i class="fa fa-calendar-times-o"></i></a>
              <div class="modal fade" id="ciclos_{{$ciclos->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea <b>CERRAR</b> el  {{$ciclos->nombre}}?</p>
                    </div>
                    <div class="modal-footer">
                 <form method="GET" action="{{route('cerrarperiodocontable')}}" id="formclausurar">

                        <input type="hidden" name="id" value="{{$ciclos->id}}">
                        <input type="submit" value="Aceptar" id="btnclausurarciclo" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                 </form>
                    </div>
                  </div>
                </div>
              </div>
               @endif

<!--
              @if($ciclos->estado=='0')
              <a  href="#" class="btn btn-info" title="Activar ciclo" data-toggle="modal" data-target="#reactivarciclos_{{$ciclos->id}}"><i class="fa fa-arrow-up"></i></a>
              <div class="modal fade" id="reactivarciclos_{{$ciclos->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header info">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea establecer como <b>ciclo activo</b> el  {{$ciclos->nombre}}?</p>
                    </div>
                    <div class="modal-footer">
                 <form method="GET" action="{{route('definircicloacademicoactivo',$ciclos->id)}}" id="formreactivarciclo">
                        <input type="hidden" name="id" value="{{$ciclos->id}}">
                        <input type="submit" value="Aceptar" id="btnreactivarciclo" class="btn btn-sm btn-info delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                 </form>
                    </div>
                  </div>
                </div>
              </div>
               @endif 
             
   -->            
                 
                 </td> 
                 </tr>
                 @endforeach()             
                </tbody>               
              </table>
            </div>
            
          </div>
@endsection
@section('script')
<script>
  

 $('#btnnuevo').on('click', function(e){
if($('#mostrarboton').val()!=0)
{
   $('#errores').removeAttr('hidden');
   $('#errores').append("<li>Para agregar un nuevo ciclo contable debe cerrar el ciclo activo.</li>");
}
else 
{
  $('#formulario').submit();
}
  });
</script>
@endsection

