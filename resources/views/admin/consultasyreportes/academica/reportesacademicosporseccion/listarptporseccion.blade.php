@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Reportes')
@section('content')

<div class="box box-primary ">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">REPORTES ADMINISTRACION ACADEMICA</label></h2>
              </div>
 </div>
          <div class="box-body">
          {!! Form::open(['id'=>'formulariorpt','class'=>'form-horizontal','target'=>'blank']) !!}

 <div class="form-group">
                 {!! Form::label('rubro', 'Año lectivo',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-4">                  
                 {!! Form::select('periodo_id',$anioslectivos,null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'periodoactivo_id','required'])!!} 
                </div>
 </div>
            <div class="form-group">
                {!! Form::label('rubro', 'Grado/Sección',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('seccion_id',[],null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'seccion_id','required'])!!}
                </div>
            </div>

             <div class="form-group">
                {!! Form::label('', 'Reportes',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">


                {!! Form::select('reporte_id',['1'=>'Nómina de estudiantes','2'=>'Nómina de padres de familia','3'=>'Horario de clases','4'=>'Exportar asistencias','5'=>'Exportar calificaciones','6'=>'Registro de evaluación del rendimiento escolar - asignatura','7'=>'Boletas de calificaciones','8'=>'Cuadro final de evaluaciones','9'=>'Certificados'],null,['class'=>'form-control','id'=>'reporte_id','required'])!!}                

                 
                </div>
            </div>

      <div class="col-sm-12"align="center">
     <div class="form-group"> 
  <a href="#" class="btn btn-primary" id="btngenerarreporte"><i class="fa fa-file-pdf-o"></i> Generar PDF</a> 
  <a href="#" class="btn btn-success" id="btngenerarexcel"><i class="fa fa-download"></i> Generar Excel</a> 

           </div>
          </div><!--fin col sm12-->
</div>

  <div class="modal fade " tabindex="-1" role="dialog" id="modal">
          <form action="#" id="selectPeriodo">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">SELECCIONE PERIODO</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1" class="col-sm-2">Periodo</label>
                                  <select class="form-control" name="periodo" id="periodo">
                                      @foreach ($periodos as $item)
                                          <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">                         
                           <input type="button" class="btn btn-primary" name="" id="btnperiodo" value="Generar boletas"></input> <button type="button" 
                              class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>



<div class="modal fade" tabindex="-2" role="dialog" id="modalfiltrorptasistenciaexcel">
          <form  id="rptAsistenciaexcel">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header success">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">REPORTE ASISTENCIA</h4>
                      </div>
        <div class="modal-body">
        <div class="box-body">
       
       <div class="form-group">
        <label class="col-sm-2 control-label">Período</label>
        <div class="col-sm-10">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" value="" name="f_asistencia" id="f_asistenciaexcel" placeholder="Seleccione un rango de fechas para inciar la búsqueda" class="form-control pull-right rangoPast" readonly="true" required="true">
          </div> 
        </div> 
        </div>

           </div>
           </div>
         
   <div class="modal-footer">                        
   <!--input type="button" class="btn btn-success" name="" id="btnasistenciaexcel" value="Exportar"></input-->
   <a href="#" title="Generar Excel" class="btn btn-success" id="btnasistenciaexcel">Generar Excel</a>
   <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                      </div>
              </div>
                  </div>
                  </form> 
              </div>



       <div class="modal fade" tabindex="-1" role="dialog" id="modalcalificacionesexcel">
          <form action="#" id="calificacionesexcel">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">EXPORTAR CALIFICACIONES</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
                            
                             <div class="form-group">
                                  <label class="col-sm-2" for="exampleInputEmail1">Periodo</label>
                                   <div class="col-sm-10">
                                  <select class="form-control" name="periodo_notasexcel" id="periodo_notasexcel">
                                      @foreach ($periodos as $item)
                                          <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                      @endforeach
                                  </select>
                              </div>
                      </div>

                              <div class="form-group">
                                  <label class="col-sm-2" for="exampleInputEmail1">Asignatura</label>
                                  <div class="col-sm-10">
                                  <select class="form-control" name="asignatura_notasexcel" id="asignatura_notasexcel">
                                      @foreach ($asignaturas as $asignatura)
                                          <option value="{{ $asignatura->id }}">{{ $asignatura->asignatura }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
     <a href="#" title="Generar Excel" class="btn btn-success" id="btnnotasexcel">Generar Excel</a>
      <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>


 <div class="modal fade" tabindex="-1" role="dialog" id="modalrendimientoescolar">
          <form action="#" id="Rendimientoescolar">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">RENDIMIENTO ESCOLAR</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
                            
                              <div class="form-group">
                                  <label class="col-sm-2" for="exampleInputEmail1">Asignatura</label>
                                  <div class="col-sm-10">
                                  <select class="form-control" name="asignatura" id="asignatura">
                                      @foreach ($asignaturas as $asignatura)
                                          <option value="{{ $asignatura->id }}">{{ $asignatura->asignatura }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
        
        <input type="button" name="" class="btn btn-primary" id="btnrendimientoescolar" value="Generar PDF"></input>
        <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
          <form action="#" id="selectPeriodo">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">BOLETA DE CALIFICACIONES</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Periodo</label>
                                  <select class="form-control" name="periodo" id="periodo">
                                      @foreach ($periodos as $item)
                                          <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">                          
                           <input type="button" class="btn btn-primary" name="" id="btnperiodo" value="Generar boletas"></input>
                           <button type="button" 
                              class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>


<div class="modal fade" tabindex="-2" role="dialog" id="modalcertificados">
          <form  id="rptcertificados">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">CERTIFICADOS</h4>
                      </div>
        <div class="modal-body">
        <div class="box-body">
       
       <div class="form-group">
        <label class="col-sm-2 control-label">Formato</label>
        <div class="col-sm-10">
          
<select id="formatocertificados" class="form-control">
  <option value="1" disabled="true">Educación parvularia</option>
  <option value="2">Primer y segundo ciclo de educación básica</option>
  <option value="3">Tercer ciclo de educación básica (7° y 8°)</option>
  <option value="4">Tercer ciclo de educación básica (9°)</option>
</select>

        </div> 
        </div>

           </div>
           </div>
         
   <div class="modal-footer">   
   <a href="#" title="Generar archivo pdf" class="btn btn-primary" id="btncertificados">Generar Certificados</a>
   <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                      </div>
              </div>
                  </div>
                  </form> 
              </div>







       <div class="modal fade" tabindex="-1" role="dialog" id="modalfiltrorptasistencia">
          <form method="POST" id="rptAsistencia">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">REPORTE ASISTENCIA</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
       
       <div class="form-group">
    
 <label class="col-sm-2 control-label">Mes</label>
 <div class="col-sm-10">
  <select class="form-control" id="mesasistencia" name="mesasistencia">
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>
                  
                  </select>       
</div>
        </div>

           </div>
           </div>
         
                      <div class="modal-footer">
                          <input type="button" class="btn btn-primary" name="" id="btnasistencia" value="Generar PDF"></input> 
                          <button type="button" 
                              class="btn btn-default " data-dismiss="modal">Cerrar</button>
                          
                      </div>
             
                  </div>
                  </div>
                  </form> 
              </div>


 {!! Form::close() !!}
            </div>

@endsection
@section('script')
<script>  
/*
$('#btnperiodo').on('click',function(e) {
            e.preventDefault();
 $('#modal').modal('hide');
  var id=$('#seccion_id option:selected').val();   
 var periodo_id=$("#periodo option:selected").val();
$('#formulariorpt').attr("method",'get');
$('#formulariorpt').attr("action",'reporteBoleta/'+id+'/'+periodo_id);  //solucionar problema con la definicion de la ruta    
 $('#formulariorpt').submit();        
        });*/
    
 $('#btncertificados').on('click', function(e){//asistencia
  e.preventDefault();
  var seccion_id=$('#seccion_id option:selected').val();   
 var formato=$("#formatocertificados option:selected").val();

$('#modalcertificados').modal('hide');
$('#rptcertificados').attr("method",'POST');
$('#rptcertificados').attr("target",'__blank');
$('#rptcertificados').attr("action",'certificados/'+seccion_id+'/'+formato);
$('#rptcertificados').submit(); 
}); 


  $('#btnasistencia').on('click', function(e){//asistencia
  e.preventDefault();
  var id=$('#seccion_id option:selected').val();   
 var periodo_id=$("#periodoactivo_id option:selected").val();

$('#modalfiltrorptasistencia').modal('hide');
$('#rptAsistencia').attr("method",'POST');
$('#rptAsistencia').attr("target",'__blank');
$('#rptAsistencia').attr("action",'reporteAsistenciamensual/'+id+'/'+periodo_id); 
//$('#rptAsistencia').attr("action",'reporteAsistencia/'+id+'/'+periodo_id); 
 $('#rptAsistencia').submit(); 
}); 


$('#btnrendimientoescolar').on('click', function(e){//rendimiento escolar por materia
  e.preventDefault();
var idmateria=$('#asignatura').val();
//alert(idmateria);
  var id=$('#seccion_id option:selected').val(); 
$('#modalrendimientoescolar').modal('hide');
$('#Rendimientoescolar').attr("method",'GET');
$('#Rendimientoescolar').attr("target",'__blank');
$('#Rendimientoescolar').attr("action",'cuadrorendimientoescolar_pdf/'+id+'/'+idmateria+'/view'); 
 $('#Rendimientoescolar').submit(); 
}); 


  $('#btnasistenciaexcel').on('click', function(e){//asistencia
var fecha=$('#f_asistenciaexcel').val(); 
var rangofechas = fecha.split(" - ");//separo las fechas para mandarlas
var fechadesde = rangofechas[0].split('/').reverse().join('-');
var fechahasta = rangofechas[1].split('/').reverse().join('-');
 var id=$('#seccion_id option:selected').val(); 
$('#modalfiltrorptasistenciaexcel').modal('hide');
$('#btnasistenciaexcel').attr("href",'/aiges/public/index.php/admin/asistencia/'+fechadesde+'/'+fechahasta+'/'+id+'/excel');
}); 


  $('#btnnotasexcel').on('click', function(e){//asistencia
var periodo=$("#periodo_notasexcel option:selected").val(); 
var asignatura=$("#asignatura_notasexcel option:selected").val();
$('#modalcalificacionesexcel').modal('hide');
 var id=$('#seccion_id option:selected').val(); 
$('#btnnotasexcel').attr("href",'/aiges/public/index.php/admin/calificacionesexcel/'+id+'/'+periodo+'/'+asignatura+'/excel');
}); 


  $('#btngenerarreporte').on('click', function(e){
    var id=$("#seccion_id option:selected").val();
    var reporte_id=$("#reporte_id option:selected").val();
   //alert(reporte_id);
    if(id!=null && id!='')//id seccion debe tener informacion sino no dejara hacer submit
    {
    switch (reporte_id){
      case '1': 
     $('#formulariorpt').attr("method",'POST');
     $('#formulariorpt').attr("target",'_blank');      
     $('#formulariorpt').attr("action", "nominadeestudiantes_pdf");      
     $('#formulariorpt').submit(); 
      break;
      case '2':
      $('#formulariorpt').attr("method",'POST');
     $('#formulariorpt').attr("action", "nominadepadresdefamilia_pdf");      
     $('#formulariorpt').submit();
      break;
      case '3':
     $('#formulariorpt').attr("method",'GET');
     $('#formulariorpt').attr("action",'horariosdeclases_pdf/'+id+'/acadrpt');      
     $('#formulariorpt').submit(); 
      
      break;
      case '4':
      $("#modalfiltrorptasistencia").modal('show');
      break;
      case '5'://asistencia b


      break;
       case '6'://rendimiento escolar
        $("#modalrendimientoescolar").modal('show');//registro de evaluacion del rendimiento escolar por asignatura
      break;

      case '7':
$('#formulariorpt').attr("method",'get');
//$('#formulariorpt').attr("action",'reporteBoleta/'+id+'/'+periodo_id);  
$('#formulariorpt').attr("action",'reporteBoleta/'+id); 
$('#formulariorpt').submit();

 //$("#modal").modal('show');//boleta de calificaciones por periodo


      break;
    
   case '8'://rendimiento escolar
      $('#formulariorpt').attr("method",'GET');
      $('#formulariorpt').attr("target",'__blank');
      $('#formulariorpt').attr("action",'../cuadro_final/'+id);      
      $('#formulariorpt').submit();
      break;

      case '9'://certificados
      $("#modalcertificados").modal('show');
      break;
      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }
    }
 
    });


  $('#btngenerarexcel').on('click', function(e){

 var id=$("#seccion_id option:selected").val();   
 var periodo_id=$("#periodoactivo_id option:selected").val();
 var reporte_id=$("#reporte_id option:selected").val(); 
// alert(reporte_id);

if(id!=null && id!='')//id seccion debe tener informacion sino no dejara hacer submit
    {   
 switch (reporte_id)
    {
      case '1':
$('#btngenerarexcel').attr("href",'/aiges/public/index.php/admin/formato_nominaestudiantesExcel/'+id+'/excel');
      break;
      case '2':  
$('#btngenerarexcel').attr("href",'/aiges/public/index.php/admin/nominafamiliaresExcel/'+id+'/excel');
      break;
      case '4':
  $("#modalfiltrorptasistenciaexcel").modal('show');
      break;
       case '5':
  $("#modalcalificacionesexcel").modal('show');
      break;

 case '6':
  $("#modalrendimientoescolar").modal('show');//registro de evaluacion del rendimiento escolar por asignatura
      break;

      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }
  }
  });//btn excel



$('#periodoactivo_id').on('change', function(e){ 
  if($('#periodoactivo_id').val()!='')
  {

$('#seccion_id').empty();
//inicia ajax
 $.ajax({
      type: 'POST',
      url: 'listadoseccionesporaniolectivo',
      dataType: 'json',
      data: {
      '_token': $('input[name=_token]').val(),
      'periodo_id': $('select[name=periodo_id]').val()
      },
      success: function(data){
       $.each(data, function(key, value) {  
$('#seccion_id').append('<option value="'+value.id+'" >'+value.grado+'</option>');
        });

  }
});//fin ajax

$('#periodo').empty();
 $.ajax({
      type: 'POST',
      url: 'periodoevaluacionporaniolectivo',
      dataType: 'json',
      data: {
      '_token': $('input[name=_token]').val(),
      'periodo_id': $('select[name=periodo_id]').val()
      },
      success: function(data){
       $.each(data, function(key, value) {  
$('#periodo').append('<option value="'+value.id+'" >'+value.descripcion+'</option>');
        });

  }
});//fin ajax

 $('#periodo_notasexcel').empty();
 $.ajax({
      type: 'POST',
      url: 'periodoevaluacionporaniolectivo',
      dataType: 'json',
      data: {
      '_token': $('input[name=_token]').val(),
      'periodo_id': $('select[name=periodo_id]').val()
      },
      success: function(data){
       $.each(data, function(key, value) {  
$('#periodo_notasexcel').append('<option value="'+value.id+'" >'+value.descripcion+'</option>');
        });

  }
});//fin ajax


}//cierro if 
});//onchange

</script>
@endsection
