@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Calificaciones/Control de Evaluaciones')
@section('content')
 
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>CONTROL DE EVALUACIONES</Strong></h3>
            </div>         
            
     @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

 <div hidden="true" class="alert alert-danger alert-dismissible" role="alert" id="errores">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <ul></ul>

    </div>
       
              <div class="box-body" >
              {!! Form::open(['route'=>'listaevaluacionesperiodo', 'method'=>'GET', 'class'=>'form-horizontal','id'=>'formulario']) !!}

              <input type="hidden" name="ideliminar" id="ideliminar" value="">
              <input type="hidden" name="nombreeliminar" id="nombreeliminar" value="">
                <input type="hidden" name="idedit" id="idedit">                
              <input type="hidden" name="porcentajeanterior" id="porcentajeanterior">

 <div class="form-group"> 
              {!! Form::label('nombre','Periodo',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::select('periodoevaluacion_id',$periodosevaluacion,null,['class'=>'form-control','required','placeholder'=>'Seleccione','id'=>'periodo_id'])!!}
                </div>
                <div class="col-sm-4">
                <a class="btn btn-primary" id="btnagregar">Agregar</a>
                </div>                                                                          
                </div>
                                                              
   <!-- /.box-header -->
            <div class="box-body table-responsive" align="center">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                  <th>CODIGO EVALUACION</th>
                   <th>NOMBRE EVALUACION</th>
                   <th>PONDERACION %</th>                  
                  <th>ACCIONES</th>
                </thead>
                <tbody> 
                    
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
              </div>  
                
    <div class="box-footer" align="right">   
    <a href="{{route('listaevaluacionesperiodo')}}" class="btn btn-primary">Finalizar</a> 
    <a  href="{{route('listaevaluacionesperiodo')}}" class="btn btn-default">Cancelar</a>
   </div>
     {!! Form::close() !!} 
     </div>

     <!-- /.box-footer -->
<div class="modal fade" id="modal-agregar">
          <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-horizontal" method="POST" id="formulario-modal">
    <div hidden="true" class="alert alert-danger" role="alert" id="errores">
    <ul></ul>
    </div>
                <div class="modal-header primary">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">REGISTRAR EVALUACION</h4>
                </div>

    <div hidden="true" class="alert alert-danger alert-dismissible" role="alert" id="erroresguardar"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <ul></ul>
    </div>

    <div class="modal-body">           
              <div class="form-group">                                          
                {!! Form::label('codigo', 'Código evaluación ',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-6">
                  {!! Form::text('codigo_eval',null,['class'=>'form-control pull-right','placeholder'=>'Código evaluación','required','id'=>'codigo_eval']) !!}
                </div>
              </div>
              <div class="form-group">  
                 {!! Form::label('codigo', 'Nombre evaluación ',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-6">
                  {!! Form::text('nombre',null,['class'=>'form-control pull-right','placeholder'=>'Nombre evaluación','required','id'=>'nombre']) !!}
                </div>
              </div>

              <div class="form-group">                                         
              {!! Form::label('', 'Ponderación',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('d_porcentajeActividad',['10'=>'10%','15'=>'15%','20'=>'20%','25'=>'25%','30'=>'30%','35'=>'35%','40'=>'40%','45'=>'45%','50'=>'50%'],null,['class'=>'form-control','id'=>'d_porcentajeActividad'])!!}
              </div>        
              </div>
            </div>
            <div class="box-footer" align="right">
        <button type="button" class="btn btn-sm btn-primary" id="btn-accion">Guardar</button>
        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>                
     </div>
     </div> 

<!-- /.modal-dialog -->

 <div class="modal fade" id="modal-eliminar">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ELIMINACION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea eliminar la evaluación ?</p>
                    </div>
                    <div class="modal-footer">
                    <form method="GET" action="#">                   
                        <input type="button" value="Eliminar" class="btn btn-sm btn-danger delete-btn" id="btn-eliminar" data-dismiss="modal"> 
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>                                 
<!-- /.modal-dialog -->        


@endsection
@section('script')
<script>

$(document).on('click','#btn-accion',function(){
if($('#btn-accion').text()=="Guardar")
{
$.ajax({
      type: 'POST',
      url: 'guardarevaluacionesperiodo',
      data: {
      '_token': $('input[name=_token]').val(),
        'periodoevaluacion_id': $('select[name=periodoevaluacion_id]').val(),
        'codigo_eval': $('input[name=codigo_eval]').val(),
        'nombre': $('input[name=nombre]').val(),
        'd_porcentajeActividad': $('select[name=d_porcentajeActividad]').val()
      }, 
      success: function(data){    
       if ((data.errors)) {
          $('#erroresguardar').removeAttr('hidden');
          $('#erroresguardar').append("<li>"+ data.errors.codigo_eval+"</li>");
          $('#erroresguardar').append("<li>"+ data.errors.nombre+"</li>");
        } else {    
       if(data.d_porcentajeActividad!=110){//EL % ACUM ES MENOR A 100

         $('#tablaBusqueda').append('<tr id="'+data.id+'"><td>' + data.codigo_eval + '</td><td>' + data.nombre +'</td><td>'+ data.d_porcentajeActividad + '</td><td>' + '<a href="#" class="btn btn-success" onclick="seleccioneditar('+data.id+",'"+data.codigo_eval+"'"+",'"+data.nombre+"'"+",'"+data.d_porcentajeActividad+"'"+');"><i class="fa fa-edit"></i></a>' + " "+ '<a href="#" class="btn btn-danger" onclick="seleccioneliminar('+data.id+",'"+data.nombre+"'"+');"><i class="fa fa-close"></i></a>' +'</td></tr>'); 
        
       }
       else{
$('#erroresguardar').removeAttr('hidden');
$('#erroresguardar').append("<li>No se pudo guardar la evaluación ya que la ponderación de todas las evaluaciones para ésta asignatura sobrepasan el 100%</li>");

       }
     }
      },
    });//fin de ajax
    $('#codigo_eval').val('');
    $('#nombre').val('');
}


if($('#btn-accion').text()=="Actualizar")
{
//alert('EDITAR');
$.ajax({
      type: 'POST',
      url: 'actualizarevaluacionesperiodo',
      data: {
      '_token': $('input[name=_token]').val(),
        'id': $('input[name=idedit]').val(),
        'porcentajeanterior': $('input[name=porcentajeanterior]').val(),
        'codigo_eval': $('input[name=codigo_eval]').val(),
        'nombre': $('input[name=nombre]').val(),
        'd_porcentajeActividad': $('select[name=d_porcentajeActividad]').val()
      },
      success: function(data){ 
       if ((data.errors)) {
          $('#erroresguardar').removeAttr('hidden');
          $('#erroresguardar').append("<li>"+ data.errors.codigo_eval+"</li>");
          $('#erroresguardar').append("<li>"+ data.errors.nombre+"</li>");
        } else {       
          //$('#errores').remove();
          if(data.d_porcentajeActividad<=100){
          $('#' + data.id).replaceWith('<tr id="'+data.id+'"><td>' + data.codigo_eval + '</td><td>' + data.nombre +'</td><td>'+ data.d_porcentajeActividad + '</td><td>' + '<a href="#" class="btn btn-success" onclick="seleccioneditar('+data.id+",'"+data.codigo_eval+"'"+",'"+data.nombre+"'"+",'"+data.d_porcentajeActividad+"'"+');"><i class="fa fa-edit"></i></a>' + " "+ '<a href="#" class="btn btn-danger" onclick="seleccioneliminar('+data.id+",'"+data.nombre+"'"+');"><i class="fa fa-close"></i></a>' +'</td></tr>');


        }
        else
        {
          $('#erroresguardar').removeAttr('hidden');
          $('#erroresguardar').append("<li>No se pudo actualizar la evaluación ya que la ponderación de todas las evaluaciones para ésta asignatura sobrepasan el 100%</li>");
        }
      }
      },
    });//fin ajax
    $('#codigo_eval').val('');
    $('#nombre').val(''); 
}
});

$('#btnagregar').on('click', function(e){
if($('#periodo_id').val()!=0)
{
$('#codigo_eval').val('');
$('#nombre').val('');
$('.modal-title').text('REGISTRAR EVALUACION');
$('.title').html($(this).data('title')); 
 $('#btn-accion').text('Guardar');
$('#modal-agregar').modal('show');
}
});


  function seleccioneditar(id,codigo_eval,nombre,d_porcentajeActividad)
  {
  document.getElementById("idedit").value=""+id;
  document.getElementById("nombre").value=""+nombre;
  document.getElementById("codigo_eval").value=""+codigo_eval;  
  document.getElementById("d_porcentajeActividad").value=""+d_porcentajeActividad;
  document.getElementById("porcentajeanterior").value=""+d_porcentajeActividad;
 $('.modal-title').text('ACTUALIZAR EVALUACION');
 $('.title').html($(this).data('title'));
  $('#btn-accion').text('Actualizar'); 
$('#modal-agregar').modal('show');
}


  $('#periodo_id').on('change', function(e){
   if($('#periodo_id').val()!=0)
   {    
var id=$('#periodo_id').val();
 $.ajax({
      type: 'POST',
      url: 'listadoevaluaciones/'+id,
      dataType: 'json',
      data: {
      '_token': $('input[name=_token]').val()
      },
      success: function(data){
    var table=$('#tablaBusqueda').DataTable();
    table.destroy();         
    $('#tablaBusqueda tbody').empty();

    $.each(data, function(key, value) {       

$('#tablaBusqueda').append('<tr id="'+value.id+'"><td>' + value.codigo_eval + '</td><td>' + value.nombre +'</td><td>'+ value.d_porcentajeActividad + '</td><td>' + '<a href="#" class="btn btn-success" onclick="seleccioneditar('+value.id+",'"+value.codigo_eval+"'"+",'"+value.nombre+"'"+",'"+value.d_porcentajeActividad+"'"+');"><i class="fa fa-edit"></i></a>' + " "+ '<a href="#" class="btn btn-danger" onclick="seleccioneliminar('+value.id+",'"+value.nombre+"'"+');" ><i class="fa fa-close"></i></a>' +'</td></tr>'); 

        });
        table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 5,
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
      },
    });

   }
   else
   {
//si ha seleccionado la opcion  0 del select entonces limpieme la tabla      
    $('#tablaBusqueda tbody').empty();
   }
  });



  function seleccioneliminar(id,nombre)
   {
document.getElementById("ideliminar").value=""+id;
document.getElementById("nombreeliminar").value=""+nombre;
 $('.modal-title').text('CONFIRMAR ELIMINACION');
 $('.title').html($(this).data('title'));
$('#modal-eliminar').modal('show');
   }
$(document).on('click','#btn-eliminar',function()
{
var id=$('#ideliminar').val();
$.ajax({
    type: 'POST',
    url: 'eliminarevaluacionesperiodo/'+id,
    data: { 
    '_token': $('input[name=_token]').val()     
    },
    success: function(data){
        if(data==0)
        { 
      $("#" + id).remove();//elimina la fina de la tabla 
        }
      else
      {
$('#errores').removeAttr('hidden');
$('#errores').append("<li>No se puede completar la acción. Existen registros de calificaciones activos para ésta evaluación.</li>");
      } 
    } 
  }); 
 
});


</script>
@endsection