@extends('admin.menuprincipal')
@section('tittle','Activo Fijo/Reportes')
@section('content')

<div class="box box-primary ">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">REPORTES ACTIVO FIJO</label></h2>
              </div>
 </div>
          <div class="box-body">
          {!! Form::open(['id'=>'formulariorpt','class'=>'form-horizontal','target'=>'blank']) !!}

              <div class="form-group">
                {!! Form::label('', 'Reportes',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">


                {!! Form::select('reporte_id',['1'=>'Formulario de mobiliario y equipo AF-8','2'=>'Formulario de traslado de bienes AF-9 ','3'=>'Formulario de descargo de mobiliario y equipo AF-10 ','4'=>'Historial Depreciación de activo fijo','5'=>'Impresión etiqueta de activo fijo'],null,['class'=>'form-control','id'=>'reporte_id','required'])!!}                

                 
                </div>
<a href="#" class="btn btn-primary" id="btngenerarreporte"><i class="fa fa-file-pdf-o"></i> Generar PDF</a>

            </div>
</div>



 <div class="modal fade" tabindex="-2" role="dialog" id="modalF8">
          <form  id="frmF8">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">FORMULARIO DE MOBILIARIO Y EQUIPO</h4>
                      </div>
        <div class="modal-body">
        <div class="box-body">

       <div class="form-group">
        <p>Muestra la lista de bienes que han sido cargados al inventario de activo fijo institucional en el periodo seleccionado.</p>
       </div>

       <div class="form-group">
        <label class="col-sm-2 control-label">Período</label>
        <div class="col-sm-10">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" value="" name="f_permisos" id="f_periodocargaAF" placeholder="Seleccione un rango de fechas para inciar la búsqueda" class="form-control pull-right rangoPast" readonly="true" required="true">
          </div> 
        </div> 
        </div>
        
           </div>
           </div>
         
   <div class="modal-footer">                        
   <a href="#" title="Iniciar búsqueda" class="btn btn-primary" id="btnf8" target="_blank">Buscar</a>
   <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                      </div>
              </div>
                </div>
          </form> 
       </div>


<div class="modal fade" tabindex="-2" role="dialog" id="modalF9">
          <form  id="frmF9">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">TRASLADO DE BIENES</h4>
                      </div>
        <div class="modal-body">
        <div class="box-body">

       <div class="form-group">
       
        </div>
       <div class="form-group">
        <label class="col-sm-4 control-label">Bienes Trasladados</label>
        
        <div class="col-sm-8">
          <select class="form-control" name="traslado" id="traslado">
                                      @foreach ($traslados as $traslado)
                                          <option value="{{ $traslado->id }}">{{ $traslado->activofijo->v_codigoactivo }} {{ $traslado->activofijo->v_nombre }}</option>
                                      @endforeach
           </select>               
                </div>
        </div>
        
           </div>
           </div>
         
   <div class="modal-footer">                        
   <a href="#" title="Iniciar búsqueda" class="btn btn-primary" id="btnf9" target="_blank">Buscar</a>
   <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                      </div>
              </div>
                </div>
          </form> 
       </div>




<div class="modal fade" tabindex="-2" role="dialog" id="modalF12">
          <form  id="frmF12">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">FORMULARIO DE DESCARGO DE MOBILIARIO Y EQUIPO</h4>
                      </div>
        <div class="modal-body">
        <div class="box-body">

       <div class="form-group">
        <p>Lista de solicitudes para descargo de activo fijo ingresados en el sistema.</p>
        </div>
       <div class="form-group">
        <label class="col-sm-4 control-label">Solicitudes de descargo</label>
        
        <div class="col-sm-6">
          <select class="form-control" name="solicitud" id="solicitud">
                                      @foreach ($solicitudes as $item)
                                          <option value="{{ $item->id }}">{{ $item->numsolicitud }}</option>
                                      @endforeach
           </select>               
                </div>
        </div>
        
           </div>
           </div>
         
   <div class="modal-footer">                        
   <a href="#" title="Iniciar búsqueda" class="btn btn-primary" id="btnf12" target="_blank">Buscar</a>
   <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                      </div>
              </div>
                </div>
          </form> 
       </div>


<div class="box-footer" align="right">                 
<a href="{{route('activofijo')}}" id="btnCancelar" class="btn btn-default">Regresar</a>          
</div>
 {!! Form::close() !!}
            </div>

@endsection
@section('script')
<script>


  $('#btngenerarreporte').on('click', function(e){
    
    var id=$("#reporte_id option:selected").val();
    var reporte_id=$("#reporte_id option:selected").val();

   switch (reporte_id){
      case '1': 
    $("#modalF8").modal('show');
      break; 

     case '2': 
     //traslados af9
     $("#modalF9").modal('show');
     //$('#btngenerarreporte').attr("target", "_blank" );
    //$('#btngenerarreporte').attr("href",'trasladosAF9');
    
      break; 

      case '3': 
    $("#modalF12").modal('show');
      break; 

       case '4': 
       $('#btngenerarreporte').attr("target", "_blank" );
       $('#btngenerarreporte').attr("href",'rptdepreciacionAF');
      break;

       case '5': 
       $('#btngenerarreporte').attr("target", "_blank" );
      $('#btngenerarreporte').attr("href",'imprimiretiqueta');
     
    //$("#modalF12").modal('show');
      break;
}//fin switch
});

$('#btnf8').on('click', function(e){
var fecha=$('#f_periodocargaAF').val(); 
var rangofechas = fecha.split(" - ");
var fechadesde = rangofechas[0].split('/').reverse().join('-');
var fechahasta = rangofechas[1].split('/').reverse().join('-');

$('#modalF8').modal('hide');
$('#btnf8').attr("href",'reporteF8/'+fechadesde+'/'+fechahasta);   
});


$('#btnf12').on('click', function(e){
var solicitud=$('#solicitud').val(); 
$('#modalF12').modal('hide');
$('#btnf12').attr("href",'imprimirsolicituddescarga/'+solicitud);
});

$('#btnf9').on('click', function(e){
var traslado=$('#traslado').val(); 
$('#modalF9').modal('hide');
$('#btnf9').attr("href",'trasladosAF9/'+traslado);
});
</script>
@endsection
