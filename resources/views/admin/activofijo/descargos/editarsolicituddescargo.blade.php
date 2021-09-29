@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Editar solicitud de descargo')
@section('content')

<div class="box box-primary">
  <div class="box-header">
   <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">MODIFICAR SOLICITUD DE DESCARGO</label></h2>
        <hr></hr>
   </div>


<div class="box-body">

{!! Form::open(['route'=>'agregaritemsolicituddescarga', 'method'=>'POST','class'=>'form-horizontal','id'=>'formulario']) !!}
 {{ csrf_field() }}
 <input type="hidden" name="id" id="id" value="{{$solicitud->id}}" >
<div class="form-group">                          
          {!! Form::label('lbid', 'Número de solicitud *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('numsolicitud',$solicitud->numsolicitud,['class'=>'form-control pull-right','id'=>'solicitud','placeholder'=>'Solicitud','readonly','required']) !!}
          </div>
    </div><!--fin form group-->

    <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de solicitud *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechasolicitud',$solicitud->f_fechasolicitud,['class'=>'form-control pull-right calendario','data-mask'=>'','placeholder'=>'Fecha de solicitud','required','disabled']) !!}
            </div> 
    </div>
     </div>
  	
    <div class="form-group">
              {!! Form::label('estado', 'Estado de solicitud',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-4">
            <?php 
            if($solicitud->estado=='PENDIENTE'){
         echo" <span class='label label-warning'>PENDIENTE</span>";
            }else{
          echo"<span class='label label-success'>DESCARGADO</span>";
            }
            ?>            
          </div>
    </div>


<div class="form-group">                                           
           {!! Form::label('exp', 'Código activo *',['class'=>'col-sm-4 control-label']) !!} 
           <div class="col-sm-4">                                             
           <div class="input-group input-group">
           {!! Form::text('codigo',null,['class'=>'form-control pull-right','id'=>'codigoactivo','placeholder'=>'Código','required']) !!}                                                  
          <span class="input-group-btn">
         <a href="#" class="btn btn-primary"  id="btnbuscar">Buscar</a>
         </span>
          </div>
        </div>
    </div>

        <div class="form-group">                          
          {!! Form::label('lbcuenta', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('descripcion',null,['class'=>'form-control pull-right','id'=>'descripcionactivo','placeholder'=>'Descripción','required']) !!}
          </div>
    </div><!--fin form group-->

    <div class="form-group">                          
          {!! Form::label('lbcuenta', 'Valor $',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('d_valor',null,['class'=>'form-control pull-right','id'=>'valoractivo','placeholder'=>'Valor de activo','required']) !!}
          </div>
    </div><!--fin form group-->


              <div class="form-group">
                 {!! Form::label('motivodescargo', 'Motivo descargo * ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::select('motivodescargo',$tipodescargo, null,['class'=>'form-control','id'=>'motivodescargo'])!!}
                </div>
                </div>

    <div class="col-sm-12" align="center">            
 {!! Form::submit('Agregar',['class'=>'btn btn-primary ']) !!} 
    </div>



</div>
</div>


  <hr>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead>
      	<th>ID</th>
        <th>CÓDIGO ACTIVO</th>
        <th>DESCRIPCIÓN</th> 
        <th>MOTIVO DESCARGO</th>
        <th>VALOR</th> 
        <th>ACCIONES</th>                                  
      </thead>
      <tbody>
        <?php $sum=0;  ?>
         @foreach($res as $value)
          @foreach($value->descargo_detalle as $item)
        <tr>            
          <td>{{$item->id}}</td>
          <td>{{$item->v_codigoactivo}}</td>
          <td>{{$item->v_nombre}}</td>
          <td>
             {!! Form::select('niveleducativo',$motivo, $item->pivot->tipodescargo_id,['class'=>'form-control','disabled'])!!}
          </td>
<td>$ {{$item->d_valor}}</td>
<td>
<a class="btn btn-danger" data-toggle="modal" title="Eliminar de la lista" data-target="#familiar_{{$item->id}}">
      <i class="fa fa-close"></i>
      </a>    
      <div class="modal fade" id="familiar_{{$item->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Confirmar Eliminación</h4>
                      </div><!-- finaliza div modal header danger-->
                      <div class="modal-body">
              <p>¿Está seguro de eliminar el activo {{$item->v_nombre}}  de la solicitud de descargo?</p>
                      </div><!-- finaliza div modal body-->
        <div class="modal-footer">
         <form method="POST" action="{{route('eliminaritemsolicituddescarga')}}" id="form_eliminar">
         @csrf
         <input type="hidden" name="activofijo_id" value="{{$item->id}}"/>  
         <input type="hidden" name="solicitud_id" value="{{$solicitud->id}}" />

         <input type="submit" value="Eliminar" class="btn btn-sm btn-danger delete-btn"/>                               
         <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal"/>Cancelar
                          </button>
        </form>
       </div><!-- finaliza div modal footer-->
      </div><!-- finaliza div modal content-->
      </div><!-- finaliza siv modal dialog-->
    </div> <!-- finaliza div modal fade-->
    </td> 
 <?php $sum=$sum+$item->d_valor;  ?>
        </tr> 
           @endforeach
         @endforeach
      </tbody>
      <tfoot>
      <tr>
           <td></td>
           <td></td>
            <td></td>
           <td><b>MONTO TOTAL</b></td>
            <td><b> $ <?php echo" $sum";  ?> </b></td>
            <td></td>
        </tr>
        </tfoot>
    </table>
  </div>
  <!-- /.box-body -->

 <div class="box-footer" align="right"> 
    <a href="{{route('lista-solicitudes-descarga')}}" id="btnModificar"  class="btn btn-primary">Actualizar</a>
    <a href="{{route('lista-solicitudes-descarga')}}" id="btnCancelar" class="btn btn-default">Regresar</a>
  </div>
{!! Form::close() !!}
</div>


<div class="modal fade" id="modal-activos">
          <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-horizontal" method="GET">
                <div class="modal-header primary">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">ACTIVO FIJO</h4>
                </div>
              <div class="modal-body">           
   <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusquedaauxiliar">
                <thead>
                  <th>No</th>
                  <th>CÓDIGO</th> 
                  <th>DESCRIPCIÓN</th>  
                  <th>ACCIONES</th>                                                               
              </thead>
              <tbody>
               
              </tbody>
            </table>
          </div>
        </div>
          </form>
        </div>                
     </div>
     </div> 

<!-- /.modal-dialog -->     


@endsection
 @section('script')
<script type="text/javascript">
  function seleccion(id,v_codigoactivo,v_nombre,d_valor)
{
    document.getElementById("id").value=""+id;
    document.getElementById("codigoactivo").value=""+v_codigoactivo;
    document.getElementById("descripcionactivo").value=""+v_nombre;
    document.getElementById("valoractivo").value=""+d_valor;
}

$(document).ready(function() 
{
$('#btnbuscar').on('click', function()
{
var table=$('#tablaBusquedaauxiliar').DataTable();
table.destroy();
$('#tablaBusquedaauxiliar tbody').empty();
$.get('/admin/listaactivos',function(activos)
{   
  $(activos).each(function (key,value)
  {
$('#tablaBusquedaauxiliar').append('<tr><td>' + key+1 + '</td><td>' + value.v_codigoactivo + '</td><td>' + value.v_nombre +  '</td><td>' + '<a href="#" class="btn btn-success" onclick="seleccion('+value.id+",'"+value.v_codigoactivo+"','"+value.v_nombre+"','"+value.d_valor+"'"+');" data-dismiss="modal" title="Seleccionar"><i class="fa fa-check"></i></a>'+' </td></tr>');
  });


table=$('#tablaBusquedaauxiliar').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 10,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  });

});
});


  var t = $('#tablaBusqueda').DataTable();

    var counter = 1;
  /*$('#btnagregaractivo').on( 'click', function () { 

    if( $('#codigoactivo').val()=="" ||  $('#descripcionactivo').val()=="")
    {
      //alert('Datos incompletos');
    } 
    else{ 


}//fin else
    } );*/
 
  $('#btnbuscar').on('click',function(e){
     $('#modal-activos').modal('show');
  });
  });
</script>
@endsection