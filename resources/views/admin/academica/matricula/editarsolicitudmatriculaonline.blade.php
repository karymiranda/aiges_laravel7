@extends('admin.menuprincipal')
@section('tittle', 'Administración Académica/Matrícula/Solicitudes en Linea')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header">
              <h3 class="box-title"><Strong>ACTUALIZAR SOLICITUD MATRICULA</Strong></h3>
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
                 {!! Form::open(['route'=>['actualizarmatriculaonline',$datos->id,$matricula->pivot->id,$matricula->pivot->seccion_id], 'method'=>'PUT','class'=>'form-horizontal']) !!}
                 <input type="hidden" name="estudiante_id" id="estudiante_id" value="{{$datos->id}}" >
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
                  {!! Form::text('txtfecha',$fecha,['class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>'Fecha de solicitud de inscripción','readonly']) !!}
              </div> 
              </div> 
 </div> 
<div class="form-group"> 
              {!! Form::label('estado', 'Estado de solicitud',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-5">
           {!! Form::label('lbfsi', 'Pendiente',['class'=>'col- control-label']) !!}         
          <input type="radio" name="v_estadomatricula" class="flat-red" value="Pendiente" <?php if($matricula->pivot->v_estadomatricula="pendiente"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lbno', 'Aprobada',['class'=>'control-label']) !!}
          <input type="radio" name="v_estadomatricula" class="flat-red" value="Aprobada" <?php if($matricula->pivot->v_estadomatricula=="aprobada"){ ?> checked="checked" <?php } ?> >
           </div>
          </div><!--fin form group-->
            

               
                <div class="form-group">                                           
                      {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!} 
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
                        {!! Form::label('lbgrado', 'Grado',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
       {!! Form::select('grado_id',$grados, $matricula->grado_id,['class'=>'form-control','id'=>'grado_id','placeholder'=>'Seleccione','required'])!!}
                          </div>

                           </div> 
<div class="form-group">

                           {!! Form::label('lbseccion', 'Sección',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                {!! Form::select('seccion_id',$listasecciones,$matricula->seccion,['class'=>'form-control','id'=>'seccion_id','required'])!!}
                       </div>
              </div>
           
                 <div class="form-group">                                           
                        {!! Form::label('lbturno', 'Turno',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                          {!! Form::text('turno',$matricula->seccion_turno->turno,['class'=>'form-control pull-right','placeholder'=>'Turno','required','id'=>'turno_id','readonly']) !!}
                       </div>
 </div> 
<div class="form-group">
                       {!! Form::label('lbasesor', 'Asesor de sección',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
      
 @if($matricula->seccion_empleado!=null)
      {!! Form::text('asesor',$matricula->seccion_empleado->v_nombres.' '.$matricula->seccion_empleado->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','id'=>'asesor_id','readonly']) !!}
                @else
                    {!! Form::text('asesor',null,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','readonly']) !!}
           @endif


                                                </div>
                </div>
                <hr><h5 align="center">MATRICULADO POR</h5><hr>
                <div class="form-group">                                           
                                                {!! Form::label('exppadre', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
                                  <div class="col-sm-5">
                                  <input type="text" class="form-control pull-right" name="familiar_exp" value="{{$matricula->pivot->familiar_exp}}" id="expedientefamiliar" readonly="true" <?php if($matricula->pivot->familiar_exp==null){ ?> placeholder="No Aplica" <?php } ?>  <?php if($matricula->pivot->familiar_exp!=null){ ?> placeholder="Expediente del familiar" <?php } ?>> 
                                                                                              
                                                </div>
                                                 </div> 
<div class="form-group">
          {!! Form::label('nombre', 'Nombre del pariente ',['class'=>'col-sm-4 control-label']) !!}      
                                         <div class="col-sm-5">
             <input type="text" class="form-control pull-right" name="familiar_nombre" value="{{$matricula->pivot->familiar_nombre}}" id="nombrefamiliar" readonly="true" <?php if($matricula->pivot->familiar_nombre==null){ ?> placeholder="No Aplica" <?php } ?>  <?php if($matricula->pivot->familiar_nombre!=null){ ?> placeholder="Nombre del familiar" <?php } ?>>
             </div>                               
                                                
                </div><!--fin form group-->
           
             
             @endforeach                                                  
          </div> 
             <div class="box-footer" align="right">                
              {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
                  <a href="{{route('listasolicitudesmatricula')}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->

 
 </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
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
});
});//fin turno por seccion

</script>

@endsection

