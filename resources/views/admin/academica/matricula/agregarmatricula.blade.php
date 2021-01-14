@extends('admin.menuprincipal')
@section('tittle', 'Administración Académica/Matrícula/Registrar Matrícula')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
               <div class="col-sm-6">
              <h3 class="box-title"><Strong>REGISTRAR MATRICULA</Strong></h3>
              </div>
            <!--div class="col-sm-6" align="right">  
              <a href="{{route('listaexpedientes')}}" target="_blank" class="btn btn-success">Consultar Expediente de estudiante</a> 
            </div-->
          </div>
            <!-- /.box-header -->
            <!-- form start -->
 @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif 
              <div class="box-body">

                 {!! Form::open(['route'=>'guardarmatricula', 'method'=>'POST','class'=>'form-horizontal']) !!}
                 <input type="hidden" name="estudiante_id" id="estudiante_id" >
                 <input type="hidden" name="familiar_id" id="familiar_id" >
<div class="hidden">
<input type="text" name="seccionselected" id="seccionselected" value="{{old('seccionselected')}}">  
</div>
             
                <div class="form-group">                                           
                                                {!! Form::label('lblfec', 'Fecha de matrícula *',['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-5">

                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" value="{{$fecha}}" name="fecha" id="fecha"  class="form-control pull-right nac" data-mask required="true" class="form-control pull-right" required="true">
                                </div>
                                </div>
               
 </div>


              <div class="form-group">
                 {!! Form::label('periodo', 'Año académico ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                {!! Form::select('anio',$anios, null,['class'=>'form-control','id'=>'anio'])!!}
              </div>
          </div>


       <div class="form-group">
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
          {!! Form::label('lbsi', 'Nuevo ingreso',['class'=>'col- control-label']) !!}
          {!! Form::radio('v_nuevoingresoSN','SI',false, ['class'=>'flat-red'])!!}
          {!! Form::label('lbno', 'Antiguo ingreso',['class'=>'control-label']) !!}
          {!! Form::radio('v_nuevoingresoSN','NO',true, ['class'=>'flat-red'])!!}
            </div>                        
        </div>

       <div class="form-group">
          {!! Form::label('lbcertificado', 'Presentó certificado ',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
          {!! Form::label('lbsi', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('certificadoRadios','SI',true, ['class'=>'flat-red'])!!}
          {!! Form::label('lbno', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('certificadoRadios','NO',false, ['class'=>'flat-red'])!!}
            </div>                        
        </div>

               
                <div class="form-group">                                           
                                                {!! Form::label('exp', 'Estudiante *',['class'=>'col-sm-4 control-label']) !!} 
                                               <div class="col-sm-5">                                             
                                                <div class="input-group input-group">
                                                  {!! Form::text('expediente',null,['class'=>'form-control pull-right','id'=>'expediente','placeholder'=>'Número de expediente','required','readonly']) !!}                                                  
                                                      <span class="input-group-btn">
                                                        <a href="#" class="btn btn-primary"  id="btnestudiante">Buscar</a>
                                                      </span>
                        <span class="input-group-btn">
                        <a class="btn btn-primary" ><i class="fa fa-plus"></i></a>
                                                      </span>
                                                </div>
                                                </div>
                                                 </div>

                 <div class="form-group">

                                                 {!! Form::label('nie', 'NIE',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('NIE',null,['class'=>'form-control pull-right','placeholder'=>'Número de identificación del estudiante','id'=>'nie','readonly']) !!}
                                                </div>
                                                
                                                
                </div><!--fin form group-->
              
            <div class="form-group">                                           
                                                {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('txtnombres',null,['class'=>'form-control pull-right','placeholder'=>'Nombres','required','id'=>'nombres','readonly']) !!}
                                                </div>
                                                 </div>

                 <div class="form-group">

                                                {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('txtapellidos',null,['class'=>'form-control pull-right','placeholder'=>'Apellidos','required','id'=>'apellidos','readonly']) !!}
                                                </div>
                </div>

               
       <div class="form-group">
        {!! Form::label('', 'Matricula ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::label('lbsi', 'Inicial',['class'=>'col- control-label']) !!}
          {!! Form::radio('matriculaRadios','1',true, ['class'=>'flat-red'])!!}
          {!! Form::label('lbno', 'repitencia',['class'=>'control-label']) !!}
          {!! Form::radio('matriculaRadios','2',false, ['class'=>'flat-red'])!!}
            </div>                        
        </div>

                 <div class="form-group">                                           
                        {!! Form::label('lbgrado', 'Grado *',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
       {!! Form::select('grado_id',$grados, null,['class'=>'form-control','id'=>'grado_id','placeholder'=>'Seleccione','required'])!!}
                          </div>
                           </div>

                

                 <div class="form-group">

                           {!! Form::label('lbseccion', 'Sección *',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                {!! Form::select('seccion_id',[''=>'Seleccione'],null,['class'=>'form-control','id'=>'seccion_id','required'])!!}
                       </div>
              </div>
           
                 <div class="form-group">                                           
                        {!! Form::label('lbturno', 'Turno ',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                          {!! Form::text('turno',null,['class'=>'form-control pull-right','placeholder'=>'Turno','required','id'=>'turno_id','readonly']) !!}
                       </div>
                        </div>

                 <div class="form-group">

                       {!! Form::label('lbasesor', 'Asesor de sección ',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('asesor',null,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','id'=>'asesor_id','readonly']) !!}
                                                </div>
                </div>
             
                <div class="form-group">                                           
                                                {!! Form::label('exppadre', 'Matriculado por *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">                         
                                                <div class="input-group input-group">
                                                  {!! Form::text('familiar_exp',null,['class'=>'form-control pull-right','placeholder'=>'Número de expediente padre de familia','required','id'=>'expedientefamiliar','readonly']) !!}   

                                                      <span class="input-group-btn">
                                                        <a  class="btn btn-primary"
                                                        id="btnfamiliares">Buscar</a>
                                                      </span>
                        <span class="input-group-btn">
                        <a  class="btn btn-primary" target="_blank" href="{{ route('agregarfamiliar') }}" title="Registrar Familiar"><i class="fa fa-plus"></i></a>
                                                      </span>
                                                </div>
                                                </div>
                                                 </div>

                 <div class="form-group">

                                                 {!! Form::label('nombre', 'Nombre  ',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('familiar_nombre',null,['class'=>'form-control pull-right','placeholder'=>'Padre de familia','id'=>'nombrefamiliar','readonly']) !!}
                                                </div>
                                                
                                                
                </div><!--fin form group-->
             
                                      
            <div class="form-group">
              {!! Form::label('lbtraslado', 'Traslado',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
          {!! Form::label('lbsi', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('trasladoRadios','SI',false, ['class'=>'col- control-label','id'=>'trasladoRadiosSI'])!!}
          {!! Form::label('lbno', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('trasladoRadios','NO',true,['class'=>'col- control-label','id'=>'trasladoRadiosNO'])!!}
            </div>    

 </div>

                 <div class="form-group">
                {!! Form::label('lbcentroescorigen', 'Trasladado del Centro Escolar ',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                
                {!! Form::text('txtcentroorigen',null,['class'=>'form-control pull-right','placeholder'=>'Centro escolar de origen','id'=>'centroescolarorigen','disabled']) !!}               
                                                </div>

            </div>           
         
            <div class="form-group">                                           
                                                {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
              {!! Form::textarea('txtobservaciones',null,['class'=>'form-control pull-right','rows'=>'2','id'=>'txtobservaciones','placeholder'=>'Observaciones']) !!}
                                                </div>
                </div>
             
                                                               
          </div> 
             <div class="box-footer" align="right">                
              {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
                  <a href="{{route('listadematriculados')}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->


<div class="modal fade" id="modal-primary">
          <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-horizontal" method="GET">
                <div class="modal-header primary">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">ESTUDIANTES PENDIENTES DE MATRICULAR</h4>
                </div>
              <div class="modal-body">           
   <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                  <th>No</th>
                  <th>NOMBRE COMPLETO</th> 
                  <th>NIE</th>  
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

<!--MODAL PARA MOSTRAR FAMILIARES  -->
          <div class="modal fade" id="modal-familiares">
          <div class="modal-dialog">
            <div class="modal-content">
               <form class="form-horizontal" method="GET">
              <div class="modal-header primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">FAMILIARES</h4>
              </div>
              <div class="modal-body">           
   <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusquedaauxiliar">
                <thead>
                  <th>EXPEDIENTE</th>
                  <th>NOMBRE COMPLETO</th> 
                  <th>DUI</th>  
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
 
 </div>
@endsection
@section('script')
<script>

function seleccion(id,expediente,nombres,apellidos,nie)
{
 // alert("emtr"+id+expediente+nombres+apellidos+nie);
  document.getElementById("estudiante_id").value=""+id;
    document.getElementById("expediente").value=""+expediente;
    document.getElementById("nombres").value=""+nombres;
    document.getElementById("apellidos").value=""+apellidos;
    document.getElementById("nie").value=""+nie;
    
    //guardar en un hidden el idcuenta
}

function seleccionfamiliar(id,expediente,nombre,apellido)
{
//alert('entra familiares '+id + nombre + expediente);
    document.getElementById("familiar_id").value=""+id;
    document.getElementById("expedientefamiliar").value=""+expediente;
    document.getElementById("nombrefamiliar").value=""+nombre+" "+apellido;
}

$(document).ready(function(){
$('#trasladoRadiosSI').on('click', function(e){   
document.getElementById("centroescolarorigen").disabled = false; 
//document.getElementById("txtobservaciones").disabled=false; 
 });
 $('#trasladoRadiosNO').on('click', function(e){   
document.getElementById("centroescolarorigen").disabled = true; 
//document.getElementById("txtobservaciones").disabled= true; 
});
/////////////PARA MANTENER LA SECCION ELEGIDA AL RECARGAR FORMULARIO POR VALIDACION/////////////////////////
if($('#grado_id').val()!=0)//no ha seleccionado ningun grado llene normal
{
var id=$("#grado_id option:selected").val();
$('#seccion_id').empty();
$('#seccion_id').append('<option value="'+ '0' +'" id="seccion_id">'+ "Seleccione" +'</option>');
$.get('secciones/'+id,function(secciones){//'secciones' es el nombre de la ruta 
$(secciones).each(function (key,value){
  var cupodisponible=value.cupo_maximo-value.cuposocupados;
 // alert(cupodisponible);
if(cupodisponible!=0)
  {
if($('#seccionselected').val()!=value.id){ 
  //si la seccion a agregar no la misma que estaba seleccionada antes de validar solo agrega al selec0
$('#seccion_id').append('<option value="'+ value.id +'" id="seccion_id">'+ value.seccion + ' - ' + cupodisponible +' Cupos disponibles  ' +'</option>');
}//fin seccionselected
else
{//si la seccion a agregar es la misma que estaba seleccionada antes de validar, entonces pongala selected=true y mantenga la opcion
$('#seccion_id').append('<option value="'+ value.id +'" id="seccion_id" selected>'+ value.seccion + ' - ' + cupodisponible +' Cupos disponibles  ' +'</option>');
}
  }
  });//de la ruta
});//
}
////////////////////////FIN//////////////////////////////////////////////////

$('#grado_id').on('change', function(e){
var id=$(this).val();
if($('#grado_id').val()!=0)//no ha seleccionado ningun grado llene normal
{
$('#seccion_id').empty();
$('#seccion_id').append('<option value="'+ '0' +'" id="seccion_id">'+ "Seleccione" +'</option>');
$('#turno_id').val(""); 
$('#asesor_id').val("") 
$.get('secciones/'+id,function(secciones){//'secciones' es el nombre de la ruta 
$(secciones).each(function (key,value){
  var cupodisponible=value.cupo_maximo-value.cuposocupados;
 // alert(cupodisponible);
if(cupodisponible!=0)
  {
$('#seccion_id').append('<option value="'+ value.id +'" id="seccion_id">'+ value.seccion + ' - ' + cupodisponible +' Cupos disponibles  ' +'</option>');
  }
  });
});
}//fin if grado !=0
else
{
$('#seccion_id').empty();
$('#seccion_id').append('<option value="'+ '0' +'" id="seccion_id">'+ "Seleccione" +'</option>');
$('#turno_id').val(""); 
$('#asesor_id').val("") 
}
});//fin secciones por grado


$('#seccion_id').on('change', function(e){
$('#seccionselected').val(id);
var id=$('#seccion_id').val();
if($('#seccion_id').val()!=0)//no ha seleccionado ningun grado llene normal
{
$.get('turnos/'+id,function(turnos){
  $(turnos).each(function (key,value){
// $('#cupo_maximo').val(value.cupo_maximo);
$('#turno_id').val(value.seccion_turno.turno); 
$('#asesor_id').val(value.seccion_empleado.v_nombres + " "+ value.seccion_empleado.v_apellidos ); 
  });
});
}
else
{
$('#turno_id').val(""); 
$('#asesor_id').val("")
}
});//fin turno por seccion

 //ELEGIR UN FAMILIAR DE UNA LISTA A PARTIR DEL ID ESTUDIANTE
$('#btnfamiliares').on('click', function(e){
  if($('#expediente').val()!="")//si no ha seleccionado un estudiante no abre el modal familiares
  {
  //alert('entra btn familiares');  
var id=$('#estudiante_id').val();//saco el id del estudiante para buscar solo sus familiares
var table=$('#tablaBusquedaauxiliar').DataTable();
table.destroy();
   $('#tablaBusquedaauxiliar tbody').empty();//elimina la informacion de la tabla para recargar la info
$.get('familiaresporestudiante/'+id,function(familiares){   
  $(familiares).each(function (key,value){
    if(value.dui!=null){
 $('#tablaBusquedaauxiliar').append('<tr><td>' + value.expediente + '</td><td>' + value.nombres +" "+ value.apellidos + '</td><td>' + value.dui +  '</td><td>' + '<a href="#" class="btn btn-warning" onclick="seleccionfamiliar('+value.id+",'"+value.expediente+"'"+",'"+value.nombres+"'"+",'"+value.apellidos+"'"+');" data-dismiss="modal" ><i class="fa fa-check"></i></a>' +'</td></tr>');
}else
{
  $('#tablaBusquedaauxiliar').append('<tr><td>' + value.expediente + '</td><td>' + value.nombres +" "+ value.apellidos + '</td><td>' + "---" +  '</td><td>' + '<a href="#" class="btn btn-warning" onclick="seleccionfamiliar('+value.id+",'"+value.expediente+"'"+",'"+value.nombres+"'"+",'"+value.apellidos+"'"+');" data-dismiss="modal" ><i class="fa fa-check"></i></a>' +'</td></tr>'); 
}
 });
  
  table=$('#tablaBusquedaauxiliar').DataTable(
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

});
 //$('#tablaBusquedaauxiliar').append('</tbody;//cierro el tbody de la tabla despues de agregarle todas las rows nuevas
 $('#modal-familiares').modal('show');
}//fin del if
});
});



$('#btnestudiante').on('click', function(e){
  if($('#anio').val()!="")
  {  
var anio=$('#anio option:selected').val();
var table=$('#tablaBusqueda').DataTable();
table.destroy();
   $('#tablaBusqueda tbody').empty();
$.get('matriculaestudianteanio/'+anio,function(estudiantes){   
  $(estudiantes).each(function (key,value){
  
  if(value.nie!=null){
  $('#tablaBusqueda').append('<tr><td>' + value.v_expediente + '</td><td>' + value.v_nombres +" "+ value.v_apellidos + '</td><td>'+ value.v_nie+ '</td><td>' + '<a href="#" class="btn btn-success" onclick="seleccion('+value.id+",'"+value.v_expediente+"'"+",'"+value.v_nombres+"'"+",'"+value.v_apellidos+"'"+",'"+value.v_nie+"'"+');" data-dismiss="modal" title="Seleccionar para matricular"><i class="fa fa-check"></i></a>'
 +'</td></tr>'); 

}

 if(value.nie==null){
  $('#tablaBusqueda').append('<tr><td>' + value.v_expediente + '</td><td>' + value.v_nombres +" "+ value.v_apellidos + '</td><td>'+ '---'+ '</td><td>' + '<a href="#" class="btn btn-success" onclick="seleccion('+value.id+",'"+value.v_expediente+"'"+",'"+value.v_nombres+"'"+",'"+value.v_apellidos+"'"+",'"+value.v_nie+"'"+');" data-dismiss="modal" title="Seleccionar para matricular"><i class="fa fa-check"></i></a>'
 +'</td></tr>'); 
}

 });
  table=$('#tablaBusqueda').DataTable(
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
 //$('#tablaBusqueda').append('</tbody;//cierro el tbody de la tabla despues de agregarle todas las rows nuevas
 $('#modal-primary').modal('show');
}//fin del if
});


</script>

@endsection

