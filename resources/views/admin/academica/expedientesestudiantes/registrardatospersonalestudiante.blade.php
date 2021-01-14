@extends('admin.menuprincipal')
@section('tittle','Administracion Académica/Registro Estudiantil/Creación de Expediente/Datos Personales')
@section('content') 

<div class="box box-primary box-solid">
            <div class="box-header">
              <div class="col-sm-12">
                <h2 class="box-title"><Strong>DATOS PERSONALES</Strong></h2>
              </div> 
              </div>             

@if($errors->any())
<div class="alert-danger" role="alert">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="box-body">
                 {!! Form::open(['route'=>'guardardatospersonalesestudiante', 'method'=>'POST','class'=>'form-horizontal']) !!}
<div class="hidden">
<input type="text" name="muniselected" id="muniselected" value="{{old('muniselected')}}">
<input type="text" name="caseselected" id="caseselected" value="{{old('caseselected')}}">  
</div>
      
                        
       <div class="form-group">                                           
                                                {!! Form::label('exp', 'Expediente *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_expediente',$expediente,['class'=>'form-control pull-right','placeholder'=>'Número de expediente','required','readonly']) !!}
                                                </div>
                                                
      </div>

                  <div class="form-group">                                           
                                   {!! Form::label('nie', 'NIE',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                   <input type="text" name="v_nie" value="{{ old('v_nie') }}" class="form-control pull-right" placeholder="Número de identificación del estudiante">
                                              </div>
                                                
                </div>

               

                 <div class="form-group">                                           
                                                {!! Form::label('nombres', 'Nombres *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_nombres',null,['class'=>'form-control pull-right','placeholder'=>'Nombres segun partida de nacimiento','required']) !!}
                                                </div>
                </div>

                 <div class="form-group">                                           
                                                {!! Form::label('apellidos', 'Apellidos *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_apellidos',null,['class'=>'form-control pull-right','placeholder'=>'Apellidos segun partida de nacimiento','required']) !!}
                                                </div>
                </div>

          <div class="form-group">
          {!! Form::label('genero', 'Género *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::label('lbfemenino', 'Femenino',['class'=>'col- control-label']) !!}
          {!! Form::radio('v_genero','Femenino',true, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('lbmasculino', 'Masculino',['class'=>'control-label']) !!}
          {!! Form::radio('v_genero','Masculino',false, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
          </div>

                 <div class="form-group">                                           
                                                {!! Form::label('lblfec', 'Fecha de nacimiento *',['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-5">

                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
            <input type="text" name="f_fnacimiento" id="nac" value="{{old('f_fnacimiento')}}" onblur="calcular(this,'edad')" onchange="calcular(this,'edad')" class="form-control pull-right nac" data-mask required="true" class="form-control pull-right">
                                </div>
                                </div>
                              </div>
                             <div class="form-group"> 
                {!! Form::label('lbedad', 'Edad *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                  <input type="text" name="txtedad" class="form-control pull-right" id="edad" placeholder="Años" value="{{old('txtedad')}}" readonly="true">
                                                </div>

                                               
              </div>              
                <div class="form-group">                                           
                                                {!! Form::label('direccion', 'Dirección *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::textarea('v_direccion',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','required']) !!}
                                                </div>
                </div>
                
        <div class="form-group">                                           
                        {!! Form::label('lbldepto', 'Departamento de nacimiento *',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
          {!! Form::select('departamento_id',$departamentos, null,['class'=>'form-control','id'=>'departamentos','placeholder'=>'Seleccione','required'])!!}
                        </div>

              </div>

                <div class="form-group">
                {!! Form::label('lbmunici', 'Municipio de nacimiento ',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
              {!! Form::select('municipio_id',['0'=>'Seleccione'], null,['class'=>'form-control','id'=>'municipio_id','required'])!!}
                                                </div>

                                               
          </div>
            
           <div class="form-group">                                           
                        {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" name="v_telCasa" value="{{ old('v_telCasa') }}" class="form-control tel" placeholder="9999-9999" data-mask>
                          </div>
                        </div>

              </div>              
                <div class="form-group">
                {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-5">
                            <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" name="v_telCelular" value="{{ old('v_telCelular') }}" class="form-control tel" placeholder="9999-9999" data-mask>
                          </div>
                        </div>                                               
          </div>



          <div class="form-group">                                           
         {!! Form::label('lbcorreo', 'Correo electrónico',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
           <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-envelope"></i>
            </div>
            <input type="text" name="v_correo" value="{{ old('v_correo') }}" class="form-control pull-right" placeholder="ejemplo@gmail.com">
          </div>
                                                </div>
                </div>

                    
<hr>
<h4 align="center">SITUACION FAMILIAR</h4><hr>
                <div class="form-group">                                           
                                                {!! Form::label('cantfam', 'Miembros ',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('i_catFamiliares',null,['class'=>'form-control pull-right','placeholder'=>'Número de miembros que conforman su núcleo familiar']) !!}
                                                </div>
                </div>

                 
                <div class="form-group">                                           
                                                {!! Form::label('convivecon', 'Convive con *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::select('v_viveCon',['Padre y madre'=>'Padre y madre','Madre'=>'Madre','Padre'=>'Padre','Familiares'=>'Familiares','Otros'=>'Otros'], null,['class'=>'form-control'])!!}
                                                </div>
                </div>

            <div class="form-group">   

                                                {!! Form::label('depende', 'Económicamente depende de *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::select('v_dependeDe',['Padre y madre'=>'Padre y madre','Padre'=>'Padre','Madre'=>'Madre','Otros'=>'Otros'], null,['class'=>'form-control'])!!}
                                                </div>
                </div> 

      <hr>
      <h4 align="center">SITUACION ECLESIAL</h4>
     

     <div class="col-sm-12">
                  <div class="form-group"> 
                    {!! Form::label('lbeclesial', '¿Con qué sacramentos cuenta el estudiante? *',['class'=>'col-sm-4 control-label']) !!}                  
               
        <div class="col-sm-5">
          
        {!! Form::checkbox('sacramentos[]', 'Ninguno', true,['id'=>'super'])!!}
        {!! Form::label('sup', 'Ninguno',['class'=>'control-label']) !!}<br>
        {!! Form::checkbox('sacramentos[]', 'Bautismo', false,['class'=>'check'])!!}
        {!! Form::label('bono', 'Bautismo',['class'=>'control-label ']) !!}<br>
        {!! Form::checkbox('sacramentos[]', 'Primera Comunión', false,['class'=>'check'])!!}
        {!! Form::label('acti', 'Primera Comunión',['class'=>'control-label']) !!}<br>  {!! Form::checkbox('sacramentos[]', 'Confirmación', false,['class'=>'check'])!!}
        {!! Form::label('aca', 'Confirmación',['class'=>'control-label']) !!}<br>
        {!! Form::checkbox('sacramentos[]', 'Matrimonio', false,['class'=>'check'])!!}
        {!! Form::label('doc', 'Matrimonio',['class'=>'control-label']) !!}       
      </div>           
 </div>
    </div><!--fin col sm12-->

<hr>
    <h4 align="center">DATOS DE INGRESO</h4>
<hr>
     <div class="col-sm-12">
                   <div class="form-group">                                           
                           {!! Form::label('lblfechaingresoCE', 'Fecha de ingreso al Centro Escolar ',['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-5">

                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" value="{{old('f_fechaIngresoCE')}}" name="f_fechaIngresoCE" id="nac" class="form-control pull-right nac" data-mask  class="form-control pull-right">
                                </div>
                                </div>
                                 </div>              
     

            <div class="form-group">  
              {!! Form::label('nivel', 'Nivel ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_nivelingreso',['No Aplica'=>'No Aplica','Educación Parvularia'=>'Educación Parvularia','Educación Básica'=>'Educación Básica'], null,['class'=>'form-control'])!!}
                </div>
            </div> 

             <div class="form-group">  
              {!! Form::label('ciclo', 'Ciclo ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_cicloingreso',['No Aplica'=>'No Aplica','I Ciclo'=>'I Ciclo','II Ciclo'=>'II Ciclo','III Ciclo'=>'III Ciclo'], null,['class'=>'form-control'])!!}
                </div>
            </div>


             <div class="form-group">  
              {!! Form::label('modalidad educativa', 'Modalidad Educativa ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_modalidadeducativaingreso',['No Aplica'=>'No Aplica','Unica Parvularia'=>'Unica Parvularia','Regular'=>'Regular','General'=>'General'], null,['class'=>'form-control'])!!}
                </div>
            </div>


             <div class="form-group">  
              {!! Form::label('modalidad educativa', 'Modalidad de Atención ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_modalidadatencioningreso',['No Aplica'=>'No Aplica','Regular'=>'Regular','Flexible'=>'Flexible'], null,['class'=>'form-control'])!!}
                </div>
            </div>

             <div class="form-group">  
              {!! Form::label('gradoingreso', 'Grado',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
              {!! Form::text('v_gradoingreso',null,['class'=>'form-control pull-right','placeholder'=>'Grado  ']) !!}
                </div>
            </div>

             <div class="form-group">  
              {!! Form::label('observacionesingreso', 'Observaciones ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
              {!! Form::text('v_observacionesingreso',null,['class'=>'form-control pull-right','placeholder'=>'Observaciones ingreso ']) !!}
                </div>
            </div>


         <div class="form-group">
          {!! Form::label('nivel', 'Presentó partida de nacimiento *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::label('lbsi', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('presentopartidaSN','SI',true, ['class'=>'flat-red'])!!}
          {!! Form::label('lbno', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('presentopartidaSN','NO',false, ['class'=>'flat-red'])!!}
            </div> 
           </div>
                      
    </div><!--fin col sm12-->

                                                   
            </div>        
                
              <div class="box-footer" align="right">                
                  {!! Form::submit('Siguiente >>',['class'=>'btn btn-primary ']) !!}
                   <a href="{{route('listaexpedientes')}}" class="btn btn-default">Cancelar</a> 
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
            
          </div><!-- termina formulario datos personales -->

 </div> <!--finaliza box body-->
 @endsection
 @section('script')
 <script>
 
$(document).ready(function(){
  $('#super').change(function() {
          if(this.checked) {            
              $('.check').prop('checked', false);
          }      
      });
      $('.check').change(function() {
          if(this.checked) {            
              $('#super').prop('checked', false);
          }      
      });

//LLENAR EL SELEC DE MUNICIPIO , DESPUES DE CARGAR ERRORES EN FORMULARIO
if($('#departamentos').val()!=0)//no ha seleccionado ningun depto
{
var id=$("#departamentos option:selected").val();
 $('#municipio_id').empty();
 $('#municipio_id').append('<option value="'+  +'">'+ 'Seleccione' +'</option>');
$.get('municipios/'+id,function(municipios){
  $(municipios).each(function (key,value){ 
  if($('#muniselected').val()!=value.id){ 
$('#municipio_id').append('<option value="'+value.id+'" >'+value.v_municipio+'</option>');
}else{
  $('#municipio_id').append('<option value="'+value.id+'" selected>'+value.v_municipio+'</option>');
}
  });
});

/*
if($('#muniselected').val()!=0)//si ha seleccionado un muni
{
var id=$('#muniselected').val();
 $('#colonia_caserio_id').empty();
$('#colonia_caserio_id').append('<option value="'+ '0' +'">'+ 'Seleccione' +'</option>');
$.get('colonias/'+id,function(colonias){//'colonias' es el nombre de la ruta 
  $(colonias).each(function (key,value){
    if($('#caseselected').val()!=value.id){ 
$('#colonia_caserio_id').append('<option value="'+ value.id +'" >'+ value.v_caserio +'</option>');
}else{
  $('#colonia_caserio_id').append('<option value="'+ value.id +'" selected >'+ value.v_caserio +'</option>');
}
//alert(value.v_caserio);
  });
});

}
*/
}


$('#departamentos').on('change', function(e){
//alert('deptos');
var id=$(this).val();
 $('#municipio_id').empty();
$('#municipio_id').append('<option value="'+ '' +'" >'+ 'Seleccione' +'</option>');
$.get('municipios/'+id,function(municipios){
  $(municipios).each(function (key,value){   
$('#municipio_id').append('<option value="'+value.id+'" >'+value.v_municipio+'</option>');
  });
});
});//fin municipios


});
 </script>
 @endsection
