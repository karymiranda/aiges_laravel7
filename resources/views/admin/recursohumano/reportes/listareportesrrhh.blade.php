@extends('admin.menuprincipal')
@section('tittle','Administración RRHH/ Reportes')
@section('content')


<div class="box box-primary">
   <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">REPORTES RECURSO HUMANO</label></h2>
    </div>
 
             <div class="box-body">
          {!! Form::open(['route'=>'listapermisosrh','id'=>'formulariorpt','class'=>'form-horizontal','target'=>'blank']) !!}
             
             <div class="form-group">
                {!! Form::label('', 'Reportes',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('reporte_id',['1'=>'Nómina recurso humano','2'=>'Permisos e incapacidades','3'=>'Asistencia  ','4'=>'Horario de clases'],null,['class'=>'form-control','id'=>'reporte_id','required'])!!}
                </div>
            </div>


    <div class="col-sm-12"align="center">
     <div class="form-group"> 
   <a href="#" class="btn btn-primary" id="referencia"><i class="fa fa-file-pdf-o"></i> Generar PDF</a> 
  <a href="#" class="btn btn-success" id="btngenerarexcel"><i class="fa fa-download"></i> Generar Excel</a>



    </div>
    </div><!--fin col sm12-->

{!! Form::close() !!}
 </div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalfiltromes">
          <form id="rptpermisos" class="form-horizontal">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">REPORTE PERMISOS E INCAPACIDADES</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
    
<div class="form-group">
        <label class="col-sm-2 control-label">Año</label>
      <div class="col-sm-10">
  <select class="form-control" id="anio" name="anio">
           @for ($i = 0; $i <= 5; $i++)
           <option value="{{ $anioarray[$i] }}">{{ $anioarray[$i] }}
           </option>
           @endfor                   
  </select>       
</div>
</div>


       <div class="form-group">
       <label class="col-sm-2 control-label">Mes</label>
 <div class="col-sm-10">
  <select class="form-control" id="mes" name="mes">
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
                        <a href="#" id="permisos" target="_blank" class="btn btn-primary">Generar PDF</a>
                         
                          <button type="button" 
                              class="btn btn-default " data-dismiss="modal">Cerrar</button>
                          
                      </div>
             
                  </div>
                  </div>
                  </form> 
              </div>




<div class="modal fade" tabindex="-1" role="dialog" id="modalfiltromesexcel">
          <form id="rptpermisosexcel" class="form-horizontal">
            @csrf
          <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header success">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">REPORTE PERMISOS E INCAPACIDADES</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
    
<div class="form-group">
        <label class="col-sm-2 control-label">Año</label>
      <div class="col-sm-10">
  <select class="form-control" id="anioexcel" name="anio">
           @for ($i = 0; $i <= 5; $i++)
           <option value="{{ $anioarray[$i] }}">{{ $anioarray[$i] }}
           </option>
           @endfor                   
  </select>       
</div>
</div>


       <div class="form-group">
        <label class="col-sm-2 control-label">Mes</label>
 <div class="col-sm-10">
  <select class="form-control" id="mesexcel" name="mesexcel">
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
                        <a href="#" id="permisosexcel" target="_blank" class="btn btn-success">Generar Excel</a>
                         
                          <button type="button" 
                              class="btn btn-default " data-dismiss="modal">Cerrar</button>
                          
                      </div>
             
                  </div>
                  </div>
                  </form> 
              </div>


<div class="modal fade" tabindex="-1" role="dialog" id="modalfiltrorptasistencia">
          <form method="POST" id="rptAsistenciarh">
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
        <label class="col-sm-2 control-label">Año</label>
 <div class="col-sm-10">
  <select class="form-control" id="anioAA" name="anioAA">
           @for ($i = 0; $i <= 5; $i++)
           <option value="{{ $anioarray[$i] }}">{{ $anioarray[$i] }}</option>@endfor                   
      </select>       
</div>

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
         
                      <div class="modal-footer">
                          <input type="button" class="btn btn-primary" name="" id="btnasistencia" value="Generar PDF"></input> 
                          <button type="button" 
                              class="btn btn-default " data-dismiss="modal">Cerrar</button>
                          
                      </div>
             
                  </div>
                  </div>
                  </form> 
              </div>
 </div>
<div class="modal fade" tabindex="-2" role="dialog" id="modalfiltrorptasistenciaexcel">
          <form method="POST" id="rptAsistenciaexcel">
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
        <label class="col-sm-2 control-label">Año</label>
 <div class="col-sm-10">
  <select class="form-control" id="anioAs" name="anioAs">
           @for ($i = 0; $i <= 5; $i++)
           <option value="{{ $anioarray[$i] }}">{{ $anioarray[$i] }}</option>@endfor                   
      </select>       
</div>

 <label class="col-sm-2 control-label">Mes</label>
 <div class="col-sm-10">
  <select class="form-control" id="mesasistenciaexcel" name="mesasistenciaexcel">
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
         
                      <div class="modal-footer">
                         <a href="#" id="btnasistenciaexcel" target="_blank" class="btn btn-success">Generar Excel</a>
                          <button type="button" 
                              class="btn btn-default " data-dismiss="modal">Cerrar</button>
                          
                      </div>
             
                  </div>
                  </div>
                  </form> 
              </div>
  </div>

<div class="modal fade" tabindex="-2" role="dialog" id="modaldocenteshorario">
          <form method="POST" id="rptHorarioclases">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">HORARIO DE CLASES</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
       
 <div class="form-group">
        <label class="col-sm-2 control-label">Año</label>
      <div class="col-sm-10">
  <select class="form-control" id="anioHC" name="anioHC">
           @for ($i = 0; $i <= 5; $i++)
           <option value="{{ $anioarray[$i] }}">{{ $anioarray[$i] }}
           </option>
           @endfor                   
  </select>       
</div>
</div> 
 <div class="form-group">
    <label class="col-sm-2 control-label">Docentes</label>
 <div class="col-sm-10">
  <select class="form-control" id="docente_id" name="docente_id">
           @foreach ($listadocentes as $value)
           <option value="{{ $value->id }}">{{ $value->v_nombres }} {{ $value->v_apellidos }}</option>@endforeach                   
      </select>       
</div>

           </div>
           </div>
         
                      <div class="modal-footer">
                          <input type="button" class="btn btn-primary" name="" id="btnhorarioclases" value="Generar pdf"></input> 
                          <button type="button" 
                              class="btn btn-default " data-dismiss="modal">Cerrar</button>
                          
                      </div>
             
                  </div>
                  </div>
                  </form> 
              </div>
   </div>
 
@endsection

@section('script')
<script>
  $('#btnasistencia').on('click', function(e){//asistencia
  e.preventDefault(); 
var mes=$('#mesasistencia option:selected').val();
var anioAA=$('#anioAA option:selected').val();
$('#modalfiltrorptasistencia').modal('hide');
$('#rptAsistenciarh').attr("method",'POST');
$('#rptAsistenciarh').attr("target",'__blank');
//$('#rptAsistenciarh').attr("action",'reporteAsistenciarrhh/'+mes+'/pdf');
$('#rptAsistenciarh').attr("action",'asistenciamensualrh/'+mes+'/'+anioAA+'/pdf');    
 $('#rptAsistenciarh').submit(); 
}); 


 $('#btnasistenciaexcel').on('click', function(e){
  $('#modalfiltrorptasistenciaexcel').modal('hide');
var anioAs=$('#anioAs option:selected').val();
var mes=$('#mesasistenciaexcel option:selected').val();
$('#btnasistenciaexcel').attr("href",'/aiges/public/index.php/admin/rptasistenciaexcelrrhh/'+mes+'/'+anioAs+'/excel'); 
});

$('#permisosexcel').on('click', function(e){
$('#modalfiltromesexcel').modal('hide');
var anio=$('#anioexcel option:selected').val();
var mes=$('#mesexcel option:selected').val();
$('#permisosexcel').attr("href",'/aiges/public/index.php/admin/rptpermisosexcelrrhh/'+mes+'/'+anio+'/excel');  
});

$('#btnhorarioclases').on('click', function(e){
$('#modaldocenteshorario').modal('hide');
var docente=$('#docente_id option:selected').val();
var anioHC=$('#anioHC option:selected').val();
$('#rptHorarioclases').attr("method",'POST');
$('#rptHorarioclases').attr("target",'__blank');
$('#rptHorarioclases').attr("action",'horarioclasesrrhh/'+docente+'/'+anioHC+'/pdf');    
 $('#rptHorarioclases').submit(); 
});




$('#permisos').on('click', function(e){
$('#modalfiltromes').modal('hide');
var anio=$('#anio option:selected').val();
var mes=$('#mes option:selected').val();
$('#permisos').attr("href",'/aiges/public/index.php/admin/rptpermisosrrhh/'+mes+'/'+anio+'/pdf');  
});

$('#btngenerarexcel').on('click', function(e){
  var reporte_id=$('#reporte_id').val();

  switch (reporte_id){
      case '1':
      $('#btngenerarexcel').attr("href", "exportRrhh"); 
      break;
      
      case '2':
      $("#modalfiltromesexcel").modal('show');
      break;

      case '3':      
      $("#modalfiltrorptasistenciaexcel").modal('show');
      break;


      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }

});

$('#referencia').on('click', function(e){
var reporte_id=$('#reporte_id').val();
switch (reporte_id){
      case '1':
     $('#formulariorpt').attr("method",'GET');
     $('#formulariorpt').attr("action", "nominarhpdf");      
     $('#formulariorpt').submit();
      break;      
      case '2':
      $("#modalfiltromes").modal('show');
      break;

      case '3':
      $("#modalfiltrorptasistencia").modal('show');
      break;

       case '4':
      $("#modaldocenteshorario").modal('show');
      break;

      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }

 });

</script>
@endsection






















