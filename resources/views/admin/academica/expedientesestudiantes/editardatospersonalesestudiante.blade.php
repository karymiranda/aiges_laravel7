@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Expediente Académico/Actualizar Datos Personales')
@section('content') 
<div class="box box-primary box-solid">
            <div class="box-header">
              <div class="col-sm-8">
                <h2 class="box-title"><Strong>ACTUALIZAR DATOS PERSONALES</Strong></h2>
              </div> 
              </div>  
              
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
     {!! Form::open(['route'=>['actualizardatospersonalesestudiante',$estudiante->id], 'method'=>'PUT','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}

            
          <div class="col-sm-12" align="center">
          <output id="list">  
          @foreach($user as $user)                   
          <img src="{{asset('/imagenes/Administracionacademica/Estudiantes/'.$user->foto)}}" height="200px" class="image-circle" alt="User Image">
         @endforeach
          </output>
      <!--/li-->
            <hr>
            </div>

              <div class="col-sm-12">
               <div class="form-group">
                  {!! Form::label('lbfoto', 'Fotografía',['class'=>'col-sm-4 control-label']) !!}

                  <div class="col-sm-8">                   
    <input type="file" id="files" name="txtfoto" accept="image/*" />                  
                  </div>               
                </div>
                <hr>
            </div>
 

          <div class="form-group">                                           
                                                {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_expediente',$estudiante->v_expediente,['class'=>'form-control pull-right','placeholder'=>'Número de expediente','required','readonly']) !!}
                                                </div>
                                                
                </div>

                  <div class="form-group">                                           
                                                {!! Form::label('nie', 'NIE',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                            @if($estudiante->v_nie==null)
                            {!! Form::text('v_nie',$estudiante->v_nie,['class'=>'form-control pull-right','placeholder'=>'SIN ASIGNAR']) !!}
                            
                            @else
                              {!! Form::text('v_nie',$estudiante->v_nie,['class'=>'form-control pull-right','placeholder'=>'Número de identificación del estudiante']) !!}
                            @endif
                                                 </div>
                                                
                </div>

               

                 <div class="form-group">                                           
                       {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                       {!! Form::text('v_nombres',$estudiante->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres segun partida de nacimiento','required']) !!}
                      </div>
                </div>

                 <div class="form-group">                                           
                         {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                         {!! Form::text('v_apellidos',$estudiante->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos segun partida de nacimiento','required']) !!}
                       </div>
                </div>

          <div class="form-group">
          {!! Form::label('genero', 'Género',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
         {!! Form::label('lbfem', 'Femenino',['class'=>'col- control-label']) !!}
          <input type="radio" name="v_genero" class="flat-red" value="Femenino" <?php if($estudiante->v_genero=="Femenino"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lbmas', 'Masculino',['class'=>'control-label']) !!}
          <input type="radio" name="v_genero" class="flat-red" value="Masculino" <?php if($estudiante->v_genero=="Masculino"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

            <div class="form-group">                                           
                    {!! Form::label('lblfec', 'Fecha de nacimiento',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-5">
              <div class="input-group date">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" name="f_fnacimiento" id="nac" value="{{$estudiante->f_fnacimiento}}" onblur="calcular(this,'edad')" onchange="calcular(this,'edad')" class="form-control pull-right nac" data-mask required="true">
                  </div>
               </div>
               </div>

                 <div class="form-group">
                {!! Form::label('lbedad', 'Edad',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                {!! Form::text('txtedad',$edad,['class'=>'form-control pull-right','id'=>'edad','placeholder'=>'Años','required','readonly']) !!}
                                                </div>                                               
              </div>
              

                
                <div class="form-group">                                           
                                                {!! Form::label('direccion', 'Dirección',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::textarea('v_direccion',$estudiante->v_direccion,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','required']) !!}
                                                </div>
                </div>
                
     <div class="form-group">                                           
                        {!! Form::label('lbldepto', 'Departamento de nacimiento',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
          {!! Form::select('departamento_id',$departamentos, $dept->id,['class'=>'form-control','id'=>'departamentos'])!!}
                        </div>
                        </div>

                 <div class="form-group">             
            {!! Form::label('lbmunici', 'Municipio de nacimiento',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
              {!! Form::select('municipio_id',$listamunicipios, $municipios,['class'=>'form-control','id'=>'municipio_id','required'])!!}
                                                </div>
                                               
          </div>

            
           <div class="form-group">                                           
                        {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                         {!! Form::text('v_telCasa',$estudiante->v_telCasa,['class'=>'form-control','placeholder'=>'9999-9999', 'data-inputmask'=>"'mask': ['2999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                        </div>
             </div>

                 <div class="form-group">
                {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                              {!! Form::text('v_telCelular',$estudiante->v_telCelular,['class'=>'form-control','placeholder'=>'9999-9999', 'data-inputmask'=>"'mask': ['9999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                                                </div>

                                               
          </div>



          <div class="form-group">                                           
                                                {!! Form::label('lbcorreo', 'Correo electónico',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_correo',$estudiante->v_correo,['class'=>'form-control pull-right','placeholder'=>'ejemplo@gmai.com','']) !!}
                                                </div>
                </div>
             
<hr>
<h4 align="center">SITUACION FAMILIAR</h4>
                <div class="form-group">                                           
                   {!! Form::label('cantfam', 'Miembros',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('i_catFamiliares',$estudiante->i_catFamiliares,['class'=>'form-control pull-right','placeholder'=>'Número de miembros que conforman su núcleo familiar']) !!}
                                                </div>
                </div>

                 
                <div class="form-group">                                           
                                                {!! Form::label('convivecon', 'Convive con',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                     {!! Form::select('v_viveCon',['Padre y madre'=>'Padre y madre','Madre'=>'Madre','Padre'=>'Padre','Familiares'=>'Familiares','Otros'=>'Otros'], $estudiante->v_viveCon,['class'=>'form-control'])!!}
                                                </div>
                </div>

            <div class="form-group">   

                    {!! Form::label('depende', 'Económicamente depende de',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                     {!! Form::select('v_dependeDe',['Padre y madre'=>'Padre y madre','Madre'=>'Madre','Padre'=>'Padre','Otros'=>'Otros'], $estudiante->v_dependeDe,['class'=>'form-control'])!!}
                                                </div>
                </div> 

      <h4 align="center">SITUACION ECLESIAL</h4><hr>

     <div class="col-sm-12">
                  <div class="form-group"> 
                    {!! Form::label('lbeclesial', '¿Con qué sacramentos cuenta el estudiante? ',['class'=>'col-sm-4 control-label']) !!} 

                 <div class="col-sm-5"> 
                  <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Ninguno" id="super" {{in_array("Ninguno",$estudiante->sacramentos)?"checked":""}}> Ninguno </label>
                  </div> 
                  <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Bautismo" class="check" {{in_array("Bautismo",$estudiante->sacramentos)?"checked":""}}> Bautismo </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Primera Comunión" class="check" {{in_array("Primera Comunión",$estudiante->sacramentos)?"checked":""}}>Primera Comunión </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Confirmación" class="check" {{in_array("Confirmación",$estudiante->sacramentos)?"checked":""}}>Confirmación </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Matrimonio" class="check" {{in_array("Matrimonio",$estudiante->sacramentos)?"checked":""}}>Matrimonio </label>
                  </div>        
      </div>                

                  </div>
                  </div><!--fin col sm12-->

<h4 align="center">DATOS DE INGRESO</h4>
<hr>
     <div class="col-sm-12">

        <div class="form-group">                                           
                                {!! Form::label('lblfechaingresoCE', 'Fecha de ingreso al Centro Escolar',['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-5">

                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="f_fechaIngresoCE" id="nac" value="{{$estudiante->f_fechaIngresoCE}}" class="form-control pull-right nac" data-mask >
                                </div>
                                </div>

        </div>
      
            <div class="form-group">  
              {!! Form::label('nivel', 'Nivel ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_nivelingreso',['No Aplica'=>'No Aplica','Educación Parvularia'=>'Educación Parvularia','Educación Básica'=>'Educación Básica'], $estudiante->v_nivelingreso,['class'=>'form-control'])!!}
                </div>
            </div> 

             <div class="form-group">  
              {!! Form::label('ciclo', 'Ciclo ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_cicloingreso',['No Aplica'=>'No Aplica','I Ciclo'=>'I Ciclo','II Ciclo'=>'II Ciclo','III Ciclo'=>'III Ciclo'], $estudiante->v_cicloingreso,['class'=>'form-control'])!!}
                </div>
            </div>


             <div class="form-group">  
              {!! Form::label('modalidad educativa', 'Modalidad Educativa ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_modalidadeducativaingreso',['No Aplica'=>'No Aplica','Unica Parvularia'=>'Unica Parvularia','Regular'=>'Regular','General'=>'General'], $estudiante->v_modalidadeducativaingreso,['class'=>'form-control'])!!}
                </div>
            </div>


             <div class="form-group">  
              {!! Form::label('modalidadatencion', 'Modalidad de Atención ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_modalidadatencioningreso',['No Aplica'=>'No Aplica','Regular'=>'Regular','Flexible'=>'Flexible'], $estudiante->v_modalidadatencioningreso,['class'=>'form-control'])!!}
                </div>
            </div>

             <div class="form-group">  
              {!! Form::label('gradoingreso', 'Grado ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
              {!! Form::text('v_gradoingreso',$estudiante->v_gradoingreso,['class'=>'form-control pull-right','placeholder'=>'Grado  ']) !!}
                </div>
            </div>

             <div class="form-group">  
              {!! Form::label('observacionesingreso', 'Observaciones ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
              {!! Form::text('v_observacionesingreso',$estudiante->v_observacionesingreso,['class'=>'form-control pull-right','placeholder'=>'Observaciones ingreso ']) !!}
                </div>
            </div>

 <div class="form-group">
          {!! Form::label('nivel', 'Presentó partida de nacimiento',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
         {!! Form::label('lbfsi', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="presentopartidaSN" class="flat-red" value="SI" <?php if($estudiante->presentopartidaSN=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lbno', 'NO',['class'=>'control-label']) !!}
          <input type="radio" name="presentopartidaSN" class="flat-red" value="NO" <?php if($estudiante->presentopartidaSN=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
      </div>              
     
                      
    </div><!--fin col sm12-->




  </div>
 <div class="box-footer" align="right">   
     {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
   <a href="{{route('listaexpedientes')}}" class="btn btn-default">Finalizar</a>
 </div>
{!! Form::close() !!}

 </div>
@endsection
@section('script')
 <script>
   //Select para municipios
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

$('#departamentos').on('change', function(e){
//alert('deptos');
var id=$(this).val();
 $('#municipio_id').empty();
 //$('#municipio_id').append('<option value="'+ '0' +'" id="municipio_id" placeholder="Seleccione">'+ 'Seleccione' +'</option>');

 $.ajax({
        url:"{{ route('municipios',1) }}",
        method:"GET",
        dataType: 'json',
        success:function(data){
           $.each(data, function(key, value) {
  $('#municipio_id').append('<option value="'+value.id+'" id="municipio_id">'+value.v_municipio+'</option>');          
             }); 
            }
 });//cierro $.ajax

});//fin municipios
});
/*
$('#municipio_id').on('change', function(e){
var id=$(this).val();
$('#colonia_caserio_id').empty();
$('#colonia_caserio_id').append('<option value="'+ '0' +'" id="colonia_caserio_id" placeholder="Seleccione">'+ 'Seleccione' +'</option>');
$.get('colonias/'+id,function(colonias){//'colonias' es el nombre de la ruta 
  $(colonias).each(function (key,value){
$('#colonia_caserio_id').append('<option value="'+ value.id +'" id="colonia_caserio_id">'+ value.v_caserio +'</option>');
//alert(value.v_caserio);
  });
});
});
});//fin caserios
*/

  function archivo(evt) {
    var files = evt.target.files; // FileList object

    //Obtenemos la imagen del campo "file". 
    for (var i = 0, f; f = files[i]; i++) {         
       //Solo admitimos imágenes.
       if (!f.type.match('image.*')) {
            continue;
       }
   
       var reader = new FileReader();       
       reader.onload = (function(theFile) {
           return function(e) {
           // Creamos la imagen.
 document.getElementById("list").innerHTML = ['<img class="img-circle" height="250px" alt="User Image" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
           };
       })(f);

       reader.readAsDataURL(f);
    }
  }
  document.getElementById('files').addEventListener('change',archivo,false);

</script>
 @endsection

