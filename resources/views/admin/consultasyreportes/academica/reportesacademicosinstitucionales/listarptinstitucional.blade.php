@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Consultas y Reportes')
@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">REPORTES INSTITUCIONALES</label></h2>
              </div>
            </div> 

             <div class="box-body">
              {!! Form::open(['method'=>'GET','id'=>'formulariorpt','class'=>'form-horizontal','target'=>'blank']) !!}

             <div class="form-group">
                {!! Form::label('', 'Reportes',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
            {!! Form::select('reporte_id',['1'=>'Nómina de estudiantes activos','2'=>'Nómina de padres de familia','3'=>'Estadística matrícula escolar anual','4'=>'Historial decenal matrícula escolar'],null,['class'=>'form-control','id'=>'reporte_id','required'])!!}
                </div>
            </div>

      <div class="col-sm-12"align="center">
     <div class="form-group"> 
  <a href="#" class="btn btn-primary" id="btngenerarreporte"><i class="fa fa-file-pdf-o"></i> Generar PDF</a> 
  <a href="#" class="btn btn-success" id="btngenerarexcel"><i class="fa fa-download"></i> Generar Excel</a> 

           </div>
          </div><!--fin col sm12-->
</div>
           
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
          <form action="#" id="selectPeriodo">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Seleccione periodo</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Periodo</label>
                                  <select class="form-control" name="periodo" id="periodo">
                                     
                                          
                                    
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" 
                              class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Ver</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>
          
       <div class="modal fade " tabindex="-1" role="dialog" id="modalaniomatricula">
          <form action="#" id="selectaniomatricula">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">MATRICULA ESCOLAR</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1" class="col-sm-4">Año escolar</label>
                                  <div class="col-sm-8">
          {!! Form::select('anio',$anioslectivos, null,['class'=>'form-control','id'=>'anio','placeholder'=>'Seleccione','required'])!!}
                                   </div>

                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">                         
                           <input type="button" class="btn btn-primary" name="" id="btnaniomatricula" value="Ver reporte"></input> <button type="button" 
                              class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>



            <div class="box-footer" align="right" >           
           </div>
 {!! Form::close() !!}
            </div>
@endsection
@section('script')
<script>

$('#btnaniomatricula').on('click', function(e){//asistencia
  e.preventDefault();
  var anio=$('#anio option:selected').val(); 
  
$('#modalaniomatricula').modal('hide');
$('#selectaniomatricula').attr("method",'GET');
$('#selectaniomatricula').attr("target",'__blank');
$('#selectaniomatricula').attr("action",'estadisticamatriculaescolarCE_pdf/'+anio+'/viewrpt'); 
//$('#rptAsistencia').attr("action",'reporteAsistencia/'+id+'/'+periodo_id); 
 $('#selectaniomatricula').submit(); 
}); 


$('#btngenerarreporte').on('click', function(e){
    var reporte_id=$('#reporte_id').val();
    switch (reporte_id){
      case '1':      
     $('#formulariorpt').attr("action", "nominaestudiantesactivosCE_pdf");      
     $('#formulariorpt').submit(); 
      break;
      case '2':
     $('#formulariorpt').attr("action", "nominafamiliaresactivosCE_pdf");      
     $('#formulariorpt').submit();    
      break;
      case '3':
      $("#modalaniomatricula").modal('show');
      break;
      case '4':
     $('#formulariorpt').attr("action","historialmatriculaescolarCE_pdf");      
     $('#formulariorpt').submit(); 
      break;
      
      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }
 
    });
</script>
@endsection
