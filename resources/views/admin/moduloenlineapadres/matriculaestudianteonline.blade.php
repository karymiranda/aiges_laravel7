@extends('admin.menuprincipal')
@section('tittle', 'Padres de Familia /Matrícula en línea')
@section('content')


<div class="col-md-12">
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
  {!! Form::open(['route'=>'guardarsolicitudpadresmatricula', 'method'=>'POST','class'=>'form-horizontal']) !!}
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
             
<div class="form-group">  
   {!! Form::label('', 'Año académico',['class'=>'col-sm-4 control-label']) !!}
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
                                  
           <select name="grado_id" id="grado_id" placeholder="Seleccione" required="true" class="form-control">     
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
                          {!! Form::text('turno_id',null,['class'=>'form-control pull-right','placeholder'=>'Turno','id'=>'turno_id','readonly']) !!}
                       </div>
                       </div><!--fin form group-->
                 <div class="form-group">

                       {!! Form::label('lbasesor', 'Asesor',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                    {!! Form::text('asesor_id',null,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','readonly','id'=>'asesor_id']) !!}
                                                </div>
                </div>               
                                               
              </div><!--finaliza box body-->      
                
              <div class="box-footer" align="right">                
                 {!! Form::submit('Enviar',['class'=>'btn btn-primary ']) !!}
                  <a href="{{ route('estudiantes_familiares',Auth::user()->familiar->id) }}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
          </div>
          </div>
@endsection

@section('script')
<script>
  $(document).ready(function(){
if($('#grado_id').val()!=0)//no ha seleccionado ningun grado llene normal
{
var id=$("#grado_id option:selected").val();
$('#seccion_id').empty();
$('#seccion_id').append('<option value="'+ '0' +'" id="seccion_id">'+ "Seleccione" +'</option>');
$('#turno_id').val(""); 
$('#asesor_id').val("");
 $.ajax({
        url:"{{url("admin/seccionmatricula/id")}}".replace("id",id),//utilice replace ("id",id) para que me reconociera el valor de id en la ruta que estoy llamando
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



$('#seccion_id').on('change', function(e){
var id=$(this).val();
//$('#seccionselected').val(id);
if($('#seccion_id').val()!=0)//si ha seleccionado una seccion entonces lleneme turno y asesor
{

 $.ajax({
        url:"{{url("admin/turnomatriculaonline/id")}}".replace("id",id),//utilice replace ("id",id) para que me reconociera el valor de id en la ruta que estoy llamando
        method:"GET",
        dataType: 'json',
        success:function(data){
        $.each(data, function(key, value) {
          if(value.seccion_turno!=null){
        $('#turno_id').val(value.seccion_turno.turno);}

        if(value.seccion_empleado!=null){
$('#asesor_id').val(value.seccion_empleado.v_nombres + " "+ value.seccion_empleado.v_apellidos );
}     
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