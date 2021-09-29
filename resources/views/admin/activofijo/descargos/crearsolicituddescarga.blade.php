@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Crear solicitud de descargo')
@section('content')

<div class="box box-primary">
  <div class="box-header">
   <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">SOLICITUD DE DESCARGO ACTIVO FIJO</label></h2>
        <hr></hr>
   </div>


<div class="box-body">

{!! Form::open(['route'=>'lista-solicitudes-descarga', 'method'=>'GET','class'=>'form-horizontal','id'=>'formulario']) !!}
 {{ csrf_field() }}
 <input type="hidden" name="id[]" id="id" >
 <input type="hidden" name="motivodescargo[]" id="motivo" >
<div class="form-group">                          
          {!! Form::label('lbid', 'Número de solicitud *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('txtsolicitud',$correlativo,['class'=>'form-control pull-right','id'=>'solicitud','placeholder'=>'Solicitud','readonly','required']) !!}
          </div>
    </div><!--fin form group-->

    <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de solicitud *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechasolicitud',$fecha,['class'=>'form-control pull-right calendario','data-mask'=>'','placeholder'=>'Fecha de solicitud','required']) !!}
            </div> 
    </div>
     </div>

  <div class="form-group">                                           
           {!! Form::label('exp', 'Código activo *',['class'=>'col-sm-4 control-label']) !!} 
           <div class="col-sm-4">                                             
           <div class="input-group input-group">
           {!! Form::text('codigo',null,['class'=>'form-control pull-right','id'=>'codigoactivo','placeholder'=>'Código','required','readonly']) !!}                                                  
          <span class="input-group-btn">
         <a href="#" class="btn btn-primary"  id="btnbuscar">Buscar</a>
         </span>
          </div>
        </div>
    </div>

      	<div class="form-group">                          
          {!! Form::label('lbcuenta', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('descripcion',null,['class'=>'form-control pull-right','id'=>'descripcionactivo','placeholder'=>'Descripción','readonly']) !!}
          </div>
		</div><!--fin form group-->


              <div class="form-group">
                 {!! Form::label('motivodescargo', 'Motivo descargo * ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::select('motivodescargo',$tipodescargo, null,['class'=>'form-control','id'=>'motivodescargo'])!!}
                </div>
                </div>

    <div class="col-sm-12" align="center">            
<a href="#" class="btn btn-primary" id="btnagregaractivo"><i class="fa fa-file-pdf-o"></i> Agregar</a> 
    </div>

    </div>
  </div>


  <hr>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead>
      	<th>ID</th>
        <th>CÓDIGO</th>
        <th>DESCRIPCIÓN</th>                                        
        <th>MOTIVO DESCARGO</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->

  <div class="box-footer" align="right">               
    <a href="#" id="btnGuardar"  class="btn btn-primary">Guardar</a>
    <a href="{{route('lista-solicitudes-descarga')}}" id="btnCancelar" class="btn btn-default">Cancelar</a>
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

function borrarsel(id)
  {
$("#"+id).remove();
  }

$('#btnGuardar').on('click', function(e){

  var contenido=[];
  e.preventDefault();
  var codigoarray=[];


  $('#tablaBusqueda tbody tr').each(function(idx,fila){
    codigoarray.push({1:fila.children[0].innerHTML,2:fila.children[1].innerHTML,3:fila.children[3].innerText});

  });
 
 $.ajax({
            url: "guardarsolicituddescargo",
            type: "post",
            dataType: 'json',
            data: {
              '_token': $('input[name=_token]').val(),
              'array': JSON.stringify(codigoarray),
              'numsolicitud':$('input[name=txtsolicitud]').val(),
              'f_fechasolicitud':$('input[name=f_fechasolicitud]').val()
            },
            success: function(data){
//window.location.reload();
//window.location='/aiges/public/index.php/admin/listasolicitudesdescarga';
window.location='/admin/listasolicitudesdescarga';
        },
        })  
});

  function seleccion(id,v_codigoactivo,v_nombre)
{
    document.getElementById("id").value=""+id;
    document.getElementById("codigoactivo").value=""+v_codigoactivo;
    document.getElementById("descripcionactivo").value=""+v_nombre;
}

$(document).ready(function() 
{
$('#btnbuscar').on('click', function()
{
var table=$('#tablaBusquedaauxiliar').DataTable();
table.destroy();
$('#tablaBusquedaauxiliar tbody').empty();

$.get('listaactivos',function(activos)
{   
  $(activos).each(function (key,value)
  {
$('#tablaBusquedaauxiliar').append('<tr><td>' + key+1 + '</td><td>' + value.v_codigoactivo + '</td><td>' + value.v_nombre +  '</td><td>' + '<a href="#" class="btn btn-success" onclick="seleccion('+value.id+",'"+value.v_codigoactivo+"','"+value.v_nombre+"'"+');" data-dismiss="modal" title="Seleccionar"><i class="fa fa-check"></i></a>'+' </td></tr>');
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
  $('#btnagregaractivo').on( 'click', function () {  
    if( $('#codigoactivo').val()=="" ||  $('#descripcionactivo').val()=="")
    {
      //alert('Datos incompletos');
    } 
    else{ 
document.getElementById("btnGuardar").disabled=false;
var idaf=document.getElementById("id").value;
        t.row.add( [
            document.getElementById("id").value,
            document.getElementById("codigoactivo").value,
            document.getElementById("descripcionactivo").value,
            //$("#motivodescargo option:selected").text(),
            '<select name="motivo"><option value='+$("#motivodescargo option:selected").val()+'>'+$("#motivodescargo option:selected").text()+'</option></selec>',
            '<a class="btn btn-danger"  title="Eliminar de la lista" onclick="borrarsel('+idaf+')"><i class="fa fa-close"></i></a>'
        ] ).node().id = idaf;
        t.draw( false );   
        counter++;
     document.getElementById("codigoactivo").value="";
     document.getElementById("descripcionactivo").value="";

}//fin else
    } );
 
  $('#btnbuscar').on('click',function(e){
     $('#modal-activos').modal('show');
  });
  });
</script>
@endsection