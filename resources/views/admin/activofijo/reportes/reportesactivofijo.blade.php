@extends('admin.menuprincipal')
@section('tittle','Administración Activo Fijo/ Reportes')
@section('content')


<div class="box box-primary ">
            <div class="col-sm-12" align="center">
              <h2><label class="text-primary">REPORTES ACTIVO FIJO</label></h2>
 </div> 

             <div class="box-body">
          {!! Form::open(['id'=>'formulariorpt','class'=>'form-horizontal','name'=>'formulariorpt']) !!}
           
             <div class="form-group">
                {!! Form::label('', 'Reportes',['class'=>'col-sm-1 control-label']) !!}
               <div class="col-sm-2" id="filtros1">
                 {!! Form::select('reporte_id',['1'=>'Listado de bienes','2'=>'Catálogo de clasificación','3'=>'Traslados'],null,['class'=>'form-control','id'=>'reporte_id','required'])!!}
                </div>


                {!! Form::label('', 'Categoria',['class'=>'col-sm-1 control-label']) !!}
               <div class="col-sm-3" id="filtros3">
                 {!! Form::select('categoria',$cuentas,null,['class'=>'form-control','placeholder'=>'Todas','id'=>'categoria'])!!}
                </div>

                {!! Form::label('', 'Estado del activo',['class'=>'col-sm-1 control-label','id'=>'labelestado']) !!}
               <div class="col-sm-3" id="filtros2">
                 {!! Form::select('estado',['0'=>'Todos ','1'=>'Cargados','2'=>'Descargados [fuera de uso]','3'=>'Trasladados'],null,['class'=>'form-control','id'=>'estado','required'])!!}
                </div>

                <div class="col-sm-1" id="btnbuscar">
                 <a href="#" class="btn btn-primary" id="btnbuscar"><i class="fa fa-search"></i> Buscar</a>

                </div>


            </div>
 {!! Form::close() !!}

    <div class="col-sm-12"align="center">
     <div class="form-group"> 
     <a href="#" title="Exportar Excel" class="btn btn-primary" id="referencia"><i class="fa fa-file-pdf-o"></i> Generar reporte</a>
     <a href="#" class="btn btn-success" id="btngenerarexcel"><i class="fa fa-download"></i> Generar Excel</a>
    </div>
    </div><!--fin col sm12-->

</div>

<div class="form-group">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                <tr> 
                  <th>No.</th> 
                  <th>Código </th>
                  <th>Descripción</th>
                  <th>Fecha de adquisición</th>
                  <th>Ubicación</th> 
                  <th>Estado</th>                          
                  <th>¿Trasladado?</th>
                 
                </tr></thead>
                <tbody id="body">
              
              </tbody>
            </table>
            </div>
       </div>
           </div>


@endsection

@section('script')
<script type="text/javascript">

$('#referencia').on('click', function(e){
var reporte_id=$('#reporte_id').val();
switch (reporte_id){
      case '1':
     // alert('bienes');
   $('#formulariorpt').attr("method",'post');
    $('#formulariorpt').attr("target",'_blank');
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
   $('#formulariorpt').attr("action",'listadoactivofijo_pdf'); 
    $('#formulariorpt').submit();
       break;

       case '2':
    $('#formulariorpt').attr("method",'POST');     
    $('#formulariorpt').attr("target",'_blank');
     $('#formulariorpt').attr("action", "catalogoactivofijo_pdf");  
    $('#formulariorpt').submit();
      break;

      case '3':
     $('#formulariorpt').attr("method",'POST');         
    $('#formulariorpt').attr("target",'_blank');
     $('#formulariorpt').attr("action", "trasladosactivofijo_pdf");  
     $('#formulariorpt').submit();
      break;

      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }

 });

///////////////////////
$('#btngenerarexcel').on('click', function(e){
  var reporte_id=$('#reporte_id').val();
var estado=$('#estado option:selected').val();
var categoria=$('#categoria option:selected').val();

if(categoria==''){categoria=0;}

  switch (reporte_id){
      case '1':
      $('#btngenerarexcel').attr("href", "/aiges/public/index.php/admin/exportListadoactivofijo_excel/"+categoria+"/"+estado); 
      break;
      
      /*case '2':
      $('#btngenerarexcel').attr("href", "/aiges/public/index.php/admin/exportActivosdescargados_excel"); 
      break;*/

       case '2':
      $('#btngenerarexcel').attr("href", "/aiges/public/index.php/admin/exportcatalogoactivos_excel/"+categoria+"/"+estado); 
      break; 

      case '3':
      $('#btngenerarexcel').attr("href", "/aiges/public/index.php/admin/exportrasladosactivos_excel/"+categoria+"/"+estado); 
      break;

      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }
});


///////////////////////  
  $('#reporte_id').on('change', function(){
  var reporte_id=$(this).val();
    switch (reporte_id)
    {
      case '1'://
      document.getElementById("estado").disabled = false;
      $('#estado').empty();
     document.getElementById('labelestado').innerHTML= 'Estado del activo';
      $('#estado').append('<option value="'+ '0' +'">'+ "Todos" +'</option>');
      $('#estado').append('<option value="'+ '1' +'">'+ "Cargados" +'</option>');
      $('#estado').append('<option value="'+ '2' +'">'+ "Descargados [fuera de uso]" +'</option>'); 
      $('#estado').append('<option value="'+ '3' +'">'+ "Trasladados" +'</option>');
           break;
//////////////////////////////
      case '2':
      $('#estado').empty();
      document.getElementById("estado").disabled = true;
 
    break;
/////////////////////////////
      case '3':
      document.getElementById("estado").disabled = false;
      $('#estado').empty();
      $('#estado').append('<option value="'+ '0' +'">'+ "Todos" +'</option>');
      $('#estado').append('<option value="'+ '1' +'">'+ "Préstamo" +'</option>'); 
      $('#estado').append('<option value="'+ '2' +'">'+ "Permanente" +'</option>');
      document.getElementById('labelestado').innerHTML= 'Tipo traslado';
      break;
    }
  });

/////////////////////////////////////////////////////

  $('#btnbuscar').on('click',function(e)
  { 
  var reporte_id=$('#reporte_id').val();
  var table=$('#tablaBusqueda').DataTable().destroy();
  $('#tablaBusqueda thead').empty(); 
  $('#tablaBusqueda tbody').empty();
  //var table = document.getElementById("tablaBusqueda");
    switch (reporte_id)
   {
    case '1'://listado     
  $('#tablaBusqueda thead').append('<tr role="row"><th>' + '<b>No</b>' + '</th><th>' + '<b>Código</b>' + '</th><th>' + '<b>Descripción</b>' +  '</th><th>' +'<b>Fecha de adquisición</b>'+'</th><th>' + '<b>Ubicación</b>' + '</th><th>' + '<b>Estado</b>' +  '</th><th>' +'<b>¿Trasladado?</b>'+'</th></tr>'); 
 
        $.ajax({
        type: 'POST',
        url: 'consultalistabienes',
        dataType: 'json',
        data: {
      '_token': $('input[name=_token]').val(),
      'categoria': $('select[name=categoria]').val(),
      'estado': $('select[name=estado]').val()
        }, 
    success: function(data){ 
    $.each(data, function(key, value)
     {
      var estado;
      var traslado;
      if(value.v_estado==1){estado='Activo';}else{estado='Descargado';}
      if(value.v_trasladadoSN=='S'){traslado='Si';}else{traslado='No';}

$('#tablaBusqueda').append('<tr id="'+value.id+'"><td>'+key+1 + '</td><td>' + value.v_codigoactivo + '</td><td>'+ value.v_nombre + '</td><td>' + value.f_fecha_adquisicion  + '</td><td>' + value.v_ubicacion + '</td><td>'+ estado + '</td><td>'+ traslado + '</td></tr>'); 
    });

propiedadestabla();
    }//success
});//fin ajax 
    break;

case '2'://catalogo

$('#tablaBusqueda thead').append('<tr role="row"><th>' + '<b>No</b>' + '</th><th>' + '<b>Código cuenta</b>' + '</th><th>' + '<b>Nombre cuenta</b>'+'</th></tr>'); 

         $.ajax({
        type: 'POST',
        url: 'consultacatalogo',
        dataType: 'json',
        data: {
      '_token': $('input[name=_token]').val(),
      'categoria': $('select[name=categoria]').val()
        }, 
    success: function(data){ 
    $.each(data, function(key, value) {
document.getElementById("body").innerHTML += '<tr id="'+value.id+'"><td>'+key+1 + '</td><td>' + value.v_codigocuenta + '</td><td>'+ value.v_nombrecuenta + '</td></tr>'; 
    });
    propiedadestabla();
    }//success
});//fin ajax    
    break;
 
case '3'://traslado
 $('#tablaBusqueda thead').append('<tr role="row"><th>' + '<b>No</b>' + '</th><th>' + '<b>Fecha de préstamo</b>' + '</th><th>' + '<b>Código de activo</b>' +  '</th><th>' +'<b><b>Descripción</b></b>'+'</th><th>' + '<b>Tipo de traslado</b>' + '</th><th>' + '<b>Destino</b>' +  '</th><th>' +'<b>Enviado por</b>' +  '</th><th>' +'<b>Recibido por</b>'+'</th></tr>');

        $.ajax({
        type: 'POST',
        url: 'consultatrasladosactivo',
        dataType: 'json',
        data: {
      '_token': $('input[name=_token]').val(),
      'categoria': $('select[name=categoria]').val(),
      'tipotraslado': $('select[name=estado]').val()
        }, 
    success: function(data){ 
    $.each(data, function(key, value) {

$('#tablaBusqueda').append('<tr id="'+value.id+'"><td>'+key+1 +'</td><td>'+ value.f_fechatraslado + '</td><td>'+ value.activofijo.v_codigoactivo  + '</td><td>' + value.activofijo.v_nombre  + '</td><td>'+ value.tipotraslado.v_descripcion +'</td><td>' +  value.destino.nombre_institucion + '</td><td>'+ value.v_personaautoriza +'</td><td>' +value.v_personarecibe + '</td></tr>'); 

    });
    propiedadestabla();
    }//success
});//fin ajax

    break;
   }

  });

   function propiedadestabla()
   {
table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 20,
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
   }
</script>
@endsection





















