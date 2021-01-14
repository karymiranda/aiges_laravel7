@extends('admin.menuprincipal')
@section('tittle', 'Estudiante /Matrícula en línea')
@section('content')

<div class="col-md-4">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body">
              <h3 class="profile-username text-center">INDICACIONES</h3>
              <ul class="list-group list-group-unbordered">
                 <li class="list-group-item">
                  <div class="callout callout-info">Si su nombre en la solicitud de matricula o en el registro académico es diferente al de su partida de nacimiento deberá tramitar el correspondiente cambio de nombre en la administración académica del Centro Educativo.</div>
                  <div class="callout callout-info"> Para no tener contratiempos con el proceso de inscripción en línea deberá contar con la documentación  reglamentaria completa y actualizada en su expediente académico.</div>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-list"></i> Pasos a seguir</b> 
                </li> 
                <li class="list-group-item">
                  <b> Paso No.1: Completar el formulario solicitud de  matrícula.</b>
                  <b><br><i class="fa fa-check"></i> Seleccionar la sección en la cual desea matricularse</b><br><i class="fa fa-check"></i><b>Enviar solicitud</b>
                </li> 
                <li class="list-group-item">
                  <b> Paso No.2: Imprimir comprobante de matrícula en linea.</b>
                   </li> 
                  <li class="list-group-item"> 
                  <b> Despues de haber completado los pasos anteriores usted quedará matriculado en el Centro Educativo. </b>
                     </li>                      
                  <li class="list-group-item">
                   <div class="callout callout-warning"> <b>
                  Si se presentasen excepciones con su proceso de inscripción, será notificado por correo electrónico o por teléfono. </b></div>
                </li>             
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  </div>


<div class="col-md-8">
<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>SOLICITUD DE MATRICULA</Strong></h3>
            </div>
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
  {!! Form::open(['route'=>'guardarsolicitudmatriculaonline', 'method'=>'POST','class'=>'form-horizontal']) !!}
   <input type="hidden" name="estudiante_id" id="estudiante_id" value="{{$datosestudiante->id}}">
<div class="hidden">
<input type="text" name="seccionselected" id="seccionselected" value="{{old('seccionselected')}}">  
</div>

                <div class="form-group">                  
               {!! Form::label('fecha', 'Fecha de solicitud',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-5"> 
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>   
                  </div>
                  <input type="text" name="f_fechamatricula" value="{{$fecha}}" readonly="true" class="form-control pull-right nac" data-mask required="true" class="form-control pull-right">
              </div> 
              </div>             
              </div><!--fin form group-->
             
 <div class="form-group">    {!! Form::label('', 'Año académico',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-5"> 
        <select class="form-control" id="anio" name="anio">
           <option value="{{ $anio }}">{{ $anio }}</option>                   
      </select> 

      </div>
       </div><!--fin form group-->

    <div class="form-group">                                           
      {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-5">                                             
     {!! Form::text('v_expediente',$datosestudiante->v_expediente,['class'=>'form-control pull-right','placeholder'=>'Número de expediente','readonly']) !!}
      </div>
       </div><!--fin form group-->
             


          <div class="form-group">

                {!! Form::label('nie', 'NIE',['class'=>'col-sm-4 control-label']) !!}
                  <div class="col-sm-5">
                  {!! Form::text('v_nie',$datosestudiante->v_nie,['class'=>'form-control pull-right','placeholder'=>'Número de identificación del estudiante','readonly']) !!}
                   </div>                                               
                                                
                </div><!--fin form group-->
          
                       
            <div class="form-group">                                           
           {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-5">
          {!! Form::text('v_nombres',$datosestudiante->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres','readonly','required']) !!}
           </div>
            </div><!--fin form group-->
                 <div class="form-group">
                     {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
                  <div class="col-sm-5">                                                {!! Form::text('v_apellidos',$datosestudiante->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos','required','readonly']) !!}
                                                </div>
                </div>
             
                 <div class="form-group">                                           
                        {!! Form::label('lbgrado', 'Grado',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                        
           <select name="grado_id" id="grado_id" placeholder="Seleccione" required="true" class="form-control" value>     
              

           <option value="{{ $grados->id }}">
                {{ $grados->grado }} 
              </option>
                   
          </select>  
                          </div>
                          </div><!--fin form group-->
             
                <div class="form-group">
                          {!! Form::label('lbseccion', 'Sección',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                         {!! Form::select('seccion_id',[''=>'Seleccione'], null,['class'=>'form-control','id'=>'seccion_id','required'])!!}
                       </div>
              </div>
          
             
                 <div class="form-group">                                           
                        {!! Form::label('lbturno', 'Turno',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                          {!! Form::text('turno_id',null,['class'=>'form-control pull-right','placeholder'=>'Turno','required','id'=>'turno_id','readonly']) !!}
                       </div>
                       </div><!--fin form group-->
                 <div class="form-group">

                       {!! Form::label('lbasesor', 'Asesor',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                    {!! Form::text('asesor_id',null,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','required','readonly','id'=>'asesor_id']) !!}
                                                </div>
                </div>               
                                               
              </div><!--finaliza box body-->      
                
              <div class="box-footer" align="right">                
                 {!! Form::submit('Enviar',['class'=>'btn btn-primary ']) !!}
                  <a href="{{route('listasecciones')}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
          </div>
          </div>
@endsection

@section('script')
<script>
  $(document).ready(function(){
 
/////////////PARA MANTENER LA SECCION ELEGIDA AL RECARGAR FORMULARIO POR VALIDACION/////////////////////////
if($('#grado_id').val()!=0)//no ha seleccionado ningun grado llene normal
{
var id=$("#grado_id option:selected").val();
$('#seccion_id').empty();
$('#seccion_id').append('<option value="'+ '0' +'" id="seccion_id">'+ "Seleccione" +'</option>');
$.get('seccionesonline/'+id,function(secciones){//'secciones' es el nombre de la ruta 
$(secciones).each(function (key,value){
  var cupodisponible=value.cupo_maximo-value.cuposocupados;

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
$('#asesor_id').val("");
 $.ajax({
        url:"{{url("seccionesonline/id")}}".replace("id",id),//utilice replace ("id",id) para que me reconociera el valor de id en la ruta que estoy llamando
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
        url:"{{url("admin/turnosonline/id")}}".replace("id",id),//utilice replace ("id",id) para que me reconociera el valor de id en la ruta que estoy llamando
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

  });//fin document ready function

</script>

@endsection

