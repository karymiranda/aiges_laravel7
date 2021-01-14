@extends('admin.menuprincipal')
@section('tittle', 'Administración Académica/Matrícula/Actualizar Matrícula')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ACTUALIZAR MATRICULA</Strong></h3>
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

@foreach($datos->estudiante_seccion as $matricula) 
                 {!! Form::open(['route'=>['actualizarmatricula',$datos->id,$matricula->pivot->id,$seccion->id], 'method'=>'PUT','class'=>'form-horizontal']) !!}
                 <input type="hidden" name="estudiante_id" id="estudiante_id" value="{{$datos->id}}" >
<div class="hidden">
<input type="text" name="seccionselected" id="seccionselected" value="{{old('seccionselected')}}">  
</div>
       
                <div class="form-group">                                           
                    {!! Form::label('lblfec', 'Fecha de matrícula',['class'=>'col-sm-4 control-label']) !!}
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
                <select id="anio" class="form-control">
                  <option value="{{$matricula->pivot->anio}}">{{$matricula->pivot->anio}}</option>
                </select>
              </div>
          </div>


  <div class="form-group">
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
                {!! Form::label('no', 'Nuevo ingreso',['class'=>'control-label']) !!}
          <input type="radio" name="v_nuevoingresoSN" class="col control-label" value="SI" <?php if($matricula->pivot->v_nuevoingresoSN=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'Antiguo ingreso',['class'=>'control-label']) !!}
          <input type="radio" name="v_nuevoingresoSN" class="col control-label" value="NO" <?php if($matricula->pivot->v_nuevoingresoSN=="NO"){ ?> checked="checked" <?php } ?> > 
            </div>                        
        </div>



           <div class="form-group">
          {!! Form::label('lbcertificado', 'Presentó certificado',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
                {!! Form::label('no', 'SI',['class'=>'control-label']) !!}
          <input type="radio" name="certificadoRadios" class="col control-label" value="SI" <?php if($matricula->pivot->v_presentocertificadoSN=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
          <input type="radio" name="certificadoRadios" class="col control-label" value="NO" <?php if($matricula->pivot->v_presentocertificadoSN=="NO"){ ?> checked="checked" <?php } ?> > 
            </div>                        
        </div>

               
                <div class="form-group">                                           
                      {!! Form::label('exp', 'Estudiante',['class'=>'col-sm-4 control-label']) !!} 
                <div class="col-sm-5">                                       
                  {!! Form::text('expediente',$datos->v_expediente,['class'=>'form-control pull-right','id'=>'expediente','placeholder'=>'Número de expediente','required','readonly']) !!}        
                                                </div>
                    </div>

                 <div class="form-group">
                                                 {!! Form::label('nie', 'NIE',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('NIE',$datos->v_nie,['class'=>'form-control pull-right','placeholder'=>'Número de identificación del estudiante','id'=>'nie','readonly']) !!}
                                                </div>
                                                
                                                
                </div><!--fin form group-->
              
            <div class="form-group">                                           
                                                {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('txtnombres',$datos->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres','required','id'=>'nombres','readonly']) !!}
                                                </div>
                                                 </div>

                 <div class="form-group">

                                                {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('txtapellidos',$datos->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos','required','id'=>'apellidos','readonly']) !!}
                                                </div>
                </div>

          <div class="form-group">
          {!! Form::label('', 'Matricula',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
                {!! Form::label('no', 'Inicial',['class'=>'control-label']) !!}
          <input type="radio" name="matriculaRadios" class="col control-label" value="1" <?php if($matricula->pivot->matricula=="1"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'repitencia',['class'=>'control-label']) !!}
          <input type="radio" name="matriculaRadios" class="col control-label" value="2" <?php if($matricula->pivot->matricula=="2"){ ?> checked="checked" <?php } ?> > 
            </div>                        
        </div>
               
                 <div class="form-group">                                           
                        {!! Form::label('lbgrado', 'Grado',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
       {!! Form::select('grado_id',$grados, $seccion->grado_id,['class'=>'form-control','id'=>'grado_id','placeholder'=>'Seleccione','required'])!!}
                          </div>
                           </div>

                 <div class="form-group">
                           {!! Form::label('lbseccion', 'Sección',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                {!! Form::select('seccion_id',$listasecciones,$seccion->id,['class'=>'form-control','id'=>'seccion_id','required'])!!}
                       </div>
              </div>
           
                 <div class="form-group">                                           
                        {!! Form::label('lbturno', 'Turno',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                          {!! Form::text('turno',$seccion->seccion_turno->turno,['class'=>'form-control pull-right','placeholder'=>'Turno','required','id'=>'turno_id','readonly']) !!}
                       </div>
                        </div>

                 <div class="form-group">
                       {!! Form::label('lbasesor', 'Asesor de sección',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                       {!! Form::text('asesor',$seccion->seccion_empleado->v_nombres.' '.   $seccion->seccion_empleado->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','id'=>'asesor_id','readonly']) !!}
                                                </div>
                </div>
             
                <div class="form-group">                                           
                                                {!! Form::label('exppadre', 'Matriculado por',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">                                             
                                                <div class="input-group input-group">
                                                  {!! Form::text('familiar_exp',$matricula->pivot->familiar_exp,['class'=>'form-control pull-right','placeholder'=>'Número de expediente padre de familia','required','id'=>'expedientefamiliar','readonly']) !!}                                                  
                                                      <span class="input-group-btn">
                                                        <a  class="btn btn-primary"
                                                        id="btnfamiliares" <?php if($matricula->pivot->modalidad=="Online"){ ?> disabled <?php } ?> >Buscar</a>
                                                      </span>
                                                </div>
                                                </div>
                                                 </div>

                 <div class="form-group">
          {!! Form::label('nombre', 'Nombre ',['class'=>'col-sm-4 control-label']) !!}      
                                         <div class="col-sm-5">
          {!! Form::text('familiar_nombre',$matricula->pivot->familiar_nombre,['class'=>'form-control pull-right','placeholder'=>'Padre de familia','id'=>'nombrefamiliar','readonly']) !!}
               </div>                                            
                </div><!--fin form group-->
             
                                      
            <div class="form-group">
              {!! Form::label('lbtraslado', 'Traslado',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
          {!! Form::label('lbsi', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="trasladoRadios" class="col control-label" id="trasladoRadiosSI" value="SI" <?php if($matricula->pivot->v_trasladoSN=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
          <input type="radio" name="trasladoRadios" class="col control-label" id="trasladoRadiosNO" value="NO" <?php if($matricula->pivot->v_trasladoSN=="NO"){ ?> checked="checked" <?php } ?> > 
 
            </div>    
 </div>

                 <div class="form-group">
                {!! Form::label('lbcentroescorigen', 'Trasladado del Centro Escolar ',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                <input type="text" name="txtcentroorigen" class="form-control pull-right" placeholder="Centro escolar de origen" value="{{$matricula->pivot->v_centroescolarorigen}}" id="centroescolarorigen" <?php if($matricula->pivot->v_trasladoSN=="NO"){ ?> disabled <?php } ?>>             </div>

            </div>           
         
            <div class="form-group">                                           
               {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
               <!--input type="textarea" name="txtobservaciones" class="form-control pull-right" placeholder="Observaciones" value="{{$matricula->pivot->v_observaciones}}" id="txtobservaciones" <?php if($matricula->pivot->v_trasladoSN=="NO"){ ?> disabled <?php } ?>-->

              <input type="textarea" name="txtobservaciones" class="form-control pull-right" placeholder="Observaciones" value="{{$matricula->pivot->v_observaciones}}" id="txtobservaciones">
                                                </div>
                </div>

         <div class="form-group">
            {!! Form::label('lbmodalidad', 'Modalidad de matrícula',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
          <span class="label label-warning">{{$matricula->pivot->modalidad}}</span>
          </div>    
             
             @endforeach                                                  
          </div> 
             <div class="box-footer" align="right">                
              {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
                  <a href="{{route('listadematriculados')}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->




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
              <table class="table table-bordered table-striped" id="tablaBusqueda">
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


function seleccionfamiliar(id,expediente,nombre,apellido)
{
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
document.getElementById("centroescolarorigen").value = "";
//document.getElementById("txtobservaciones").value = ""; 
});


$('#grado_id').on('change', function(e){
var id=$(this).val();
if($('#grado_id').val()!=0)//no ha seleccionado ningun grado llene normal
{
$('#seccion_id').empty();
$('#seccion_id').append('<option value="'+ '0' +'" id="seccion_id">'+ "Seleccione" +'</option>');
$('#turno_id').val(""); 
$('#asesor_id').val("") 
 $.ajax({
        url:"{{url("admin/secciones/id")}}".replace("id",id),//utilice replace ("id",id) para que me reconociera el valor de id en la ruta que estoy llamando
        method:"GET",
        dataType: 'json',
        success:function(data){
        $.each(data, function(key, value) {          
//aca voy armando de nuevo el evento del select grado
var cupodisponible=value.cupo_maximo-value.cuposocupados;
if(cupodisponible!=0)
  {
$('#seccion_id').append('<option value="'+ value.id +'"0 id="seccion_id">'+ value.seccion + ' - ' + cupodisponible +' Cupos disponibles  ' +'</option>');
  }
  }); 
 }
 });//cierro $.ajax
}//cierro if
else//cuando no ha seleccionado ningun grado limpieme todo
{
$('#seccion_id').empty();
$('#seccion_id').append('<option value="'+ '0' +'" id="seccion_id">'+ "Seleccione" +'</option>');
$('#turno_id').val(""); 
$('#asesor_id').val("") 
}
});//fin secciones por grado


$('#seccion_id').on('change', function(e){
var id=$(this).val();
$('#seccionselected').val(id);
if($('#seccion_id').val()!=0)//si ha seleccionado una seccion entonces lleneme turno y asesor
{

 $.ajax({
        url:"{{url("admin/turnos/id")}}".replace("id",id),//utilice replace ("id",id) para que me reconociera el valor de id en la ruta que estoy llamando
        method:"GET",
        dataType: 'json',
        success:function(data){
        $.each(data, function(key, value) {
        $('#turno_id').val(value.seccion_turno.turno); 
$('#asesor_id').val(value.seccion_empleado.v_nombres + " "+ value.seccion_empleado.v_apellidos );     
 }); 
 }
 });//cierro $.ajax
}
else//sino ha seleccionado una seccion entonces limpieme los campos turno y asesor
{
$('#turno_id').val(""); 
$('#asesor_id').val("")
}
});//fin turno por seccion

//ELEGIR UN FAMILIAR DE UNA LISTA A PARTIR DEL ID ESTUDIANTE
$('#btnfamiliares').on('click', function(e){
  if($('#expediente').val()!="")//si no ha seleccionado un estudiante no abre el modal familiares
  { 
    var table=$('#tablaBusqueda').DataTable();
    table.destroy();         
    $('#tablaBusqueda tbody').empty();

var id=$('#estudiante_id').val();//saco el id del estudiante para buscar solo sus familiares
   $.ajax({
        url:"{{url("admin/familiaresporestudiante/id")}}".replace("id",id),//utilice replace ("id",id) para que me reconociera el valor de id en la ruta que estoy llamando
        method:"GET",
        dataType: 'json',
        success:function(data){
        $.each(data, function(key, value) {
             
$('#tablaBusqueda').append('<tr><td>' + value.expediente + '</td><td>' + value.nombres +" "+ value.apellidos + '</td><td>' + value.dui +  '</td><td>' + '<a href="#" class="btn btn-warning" onclick="seleccionfamiliar('+value.id+",'"+value.expediente+"'"+",'"+value.nombres+"'"+",'"+value.apellidos+"'"+');" data-dismiss="modal" ><i class="fa fa-check"></i></a>' +'</td></tr>'); 
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

 }
 });//cierro $.ajax

 
 //$('#tablaBusqueda').append('</tbody>');
 //cierro el tbody de la tabla despues de agregarle todas las rows nuevas
 $('#modal-familiares').modal('show');
}//fin del if
});

});


</script>

@endsection

