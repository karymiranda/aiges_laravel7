@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Expediente Académico/Actualizar Datos Médicos')
@section('content')
<div class="box box-primary box-solid">
            <div class="box-header">
              <div class="col-sm-5">
                <h2 class="box-title"><Strong>ACTUALIZAR DATOS MEDICOS: {{$estudiante->v_nombres}} {{$estudiante->v_apellidos}}</Strong></h2>
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
     {!! Form::open(['route'=>['actualizardatosmedicosestudiante',$estudiante->id], 'method'=>'PUT','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}

     <div class="form-group">
          {!! Form::label('cantfam', 'Presenta tarjeta de vacuna',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
          <input type="radio" name="tarjeta_vacuna" class="flat-red" value="SI" <?php if($datosmedicos->tarjeta_vacuna=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
          <input type="radio" name="tarjeta_vacuna" class="flat-red" value="NO" <?php if($datosmedicos->tarjeta_vacuna=="NO"){ ?> checked="checked" <?php } ?> >          
          </div> 
          </div>

        <div class="form-group">
            {!! Form::label('cantfam', 'Esquema de vacunas completo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
          <input type="radio" name="vacuna_completa" class="flat-red" value="SI" <?php if($datosmedicos->vacuna_completa=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
          <input type="radio" name="vacuna_completa" class="flat-red" value="NO" <?php if($datosmedicos->vacuna_completa=="NO"){ ?> checked="checked" <?php } ?> > 
         </div> 
          </div>

          <div class="form-group">
            {!! Form::label('cantfam', 'Tipo sanguineo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
           {!! Form::label('AB-', 'AB-',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="AB-" <?php if($datosmedicos->tipo_sanguineo=="AB-"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('AB+', 'AB+',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="AB+" <?php if($datosmedicos->tipo_sanguineo=="AB+"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('A-', 'A-',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="A-" <?php if($datosmedicos->tipo_sanguineo=="A-"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('A+', 'A+',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="A+" <?php if($datosmedicos->tipo_sanguineo=="A+"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('B-', 'B-',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="B-" <?php if($datosmedicos->tipo_sanguineo=="B-"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('B+', 'B+',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="B+" <?php if($datosmedicos->tipo_sanguineo=="B+"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('O-', 'O-',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="O-" <?php if($datosmedicos->tipo_sanguineo=="O-"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('O+', 'O+',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="O+" <?php if($datosmedicos->tipo_sanguineo=="O+"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('No sabe', 'No sabe',['class'=>'control-label']) !!}
           <input type="radio" name="tipo_sanguineo" class="flat-red" value="No sabe" <?php if($datosmedicos->tipo_sanguineo=="No sabe"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

                
           <div class="form-group"> 
 {!! Form::label('cantfam', 'Discapacidades',['class'=>'col-sm-4 control-label'])!!}                
        <div class="col-sm-5">
  <div class="checkbox">
  <label><input type="checkbox" name="discapacidades[]" value="Ninguna" id="super" {{in_array("Ninguna",$datosmedicos->discapacidades)?"checked":""}}> Ninguna </label>
                  </div> 
                  <div class="checkbox">
  <label><input type="checkbox" name="discapacidades[]" value="Baja visión" class="check" {{in_array("Baja visión",$datosmedicos->discapacidades)?"checked":""}}> Baja visión </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="discapacidades[]" value="Sordera" class="check" {{in_array("Sordera",$datosmedicos->discapacidades)?"checked":""}}>Sordera</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="discapacidades[]" value="Falta de miembro" class="check" {{in_array("Falta de miembro",$datosmedicos->discapacidades)?"checked":""}}>Falta de miembro </label>                       
                  </div>
                  </div>
                </div>               
                
                 <div class="form-group">                                           
                {!! Form::label('lbhorariosuenonoche', 'Horario de sueño por la noche',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-5">
            {!! Form::textarea('horario_sueno_noche',$datosmedicos->horario_sueno_noche,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Ejemplo: 7:00 pm a 6:00 am','']) !!} 
                          </div>
                </div><!--fin form group-->
                           
                 <div class="form-group">                                           
       {!! Form::label('lbhorariosuenodia', 'Horario de sueño durante el dia',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
         {!! Form::textarea('horario_sueno_dia',$datosmedicos->horario_sueno_dia,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...']) !!}
                                                </div>
                </div><!--fin form group-->
              
               

            <div class="form-group">
            {!! Form::label('lbdificultad', 'Presenta dificultades para dormir',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            
          {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="dificul_dormir" class="flat-red" value="SI" <?php if($datosmedicos->dificul_dormir=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'NO',['class'=>'col- control-label']) !!}
          <input type="radio" name="dificul_dormir" class="flat-red" value="NO" <?php if($datosmedicos->dificul_dormir=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

          <div class="form-group">
           {!! Form::label('lblechematerna', 'Es o fué alimentado con leche materna',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
             {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="tomo_pecho" class="flat-red" value="SI" <?php if($datosmedicos->tomo_pecho=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'NO',['class'=>'col- control-label']) !!}
          <input type="radio" name="tomo_pecho" class="flat-red" value="NO" <?php if($datosmedicos->tomo_pecho=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

       <div class="form-group">                                           
          {!! Form::label('lbmeseslactancia', '¿Cuántos meses?',['class'=>'col-sm-4 control-label']) !!}
       <div class="col-sm-5">
      {!! Form::text('tiempo_lactancia',$datosmedicos->tiempo_lactancia,['class'=>'form-control pull-right','placeholder'=>'Meses','']) !!}
       </div>
</div><!--fin form group-->
                 
       <div class="form-group">                                           
           {!! Form::label('lbdifalimentacion', '¿Ha presentado dificultades para alimentarse?',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::text('tiene_dificultad_comer',$datosmedicos->tiene_dificultad_comer,['class'=>'form-control pull-right','placeholder'=>'Especifíque','']) !!}
          </div>                 
          </div><!--fin form group-->
                  
          <div class="form-group"> 
           {!! Form::label('lbalimentos', 'Alimentos que consume ',['class'=>'col-sm-4 control-label']) !!}                  
          <div class="col-sm-5">

<div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Todos" id="chkalimentos" {{in_array("Todos",$datosmedicos->alimentos_consume)?"checked":""}}> Todos </label>
                  </div> 
                  <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Lacteos" class="checkA" {{in_array("Lacteos",$datosmedicos->alimentos_consume)?"checked":""}}> Lacteos </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Verduras" class="checkA" {{in_array("Verduras",$datosmedicos->alimentos_consume)?"checked":""}}>Verduras</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Cereales" class="check" {{in_array("Cereales",$datosmedicos->alimentos_consume)?"checked":""}}>Cereales</label>                </div>
                          <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Frutas" class="checkA" {{in_array("Frutas",$datosmedicos->alimentos_consume)?"checked":""}}> Frutas </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Carne de pollo" class="checkA" {{in_array("Carne de pollo",$datosmedicos->alimentos_consume)?"checked":""}}>Carne de pollo</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Carne de res" class="checkA" {{in_array("Carne de res",$datosmedicos->alimentos_consume)?"checked":""}}>Carne de res </label>                       
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Carne de cerdo" class="checkA" {{in_array("Carne de cerdo",$datosmedicos->alimentos_consume)?"checked":""}}>Carne de cerdo</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Mariscos" class="checkA" {{in_array("Mariscos",$datosmedicos->alimentos_consume)?"checked":""}}>Mariscos</label>               </div>
                  </div>            
                  </div>
                          
                  <div class="form-group"> 
                    {!! Form::label('lbalimentos', '¿Cuántos tiempo de comida realiza?',['class'=>'col-sm-4 control-label']) !!}                  
                <div class="col-sm-5">
 <div class="checkbox">
  <label><input type="checkbox" name="tiempos_comida[]" value="Todos" id="chktiempos" {{in_array("Todos",$datosmedicos->tiempos_comida)?"checked":""}}> Todos </label>
                  </div> 
                  <div class="checkbox">
  <label><input type="checkbox" name="tiempos_comida[]" value="Desayuno" class="checkC" {{in_array("Desayuno",$datosmedicos->tiempos_comida)?"checked":""}}> Desayuno </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="tiempos_comida[]" value="Almuerzo" class="checkC" {{in_array("Almuerzo",$datosmedicos->tiempos_comida)?"checked":""}}>Almuerzo</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="tiempos_comida[]" value="Cena" class="checC" {{in_array("Cena",$datosmedicos->tiempos_comida)?"checked":""}}>Cena</label>                </div>
 
                  </div>            
                   </div>
                 
                    <div class="form-group">                                           
                                    {!! Form::label('lbrefrigerios', '¿Cuantos refrigerios realiza?',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                    {!! Form::text('canti_frigerios',$datosmedicos->canti_refrigerios,['class'=>'form-control pull-right','placeholder'=>'Cantidad','']) !!}
                                                </div>                 
                   </div><!--fin form group-->
                

          <div class="form-group">
         {!! Form::label('lbalergico', '¿Es alérgico? (alimentos - medicamentos)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="esalergicoSN" class="flat-red" value="SI" <?php if($datosmedicos->esalergicoSN=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'NO',['class'=>'col- control-label']) !!}
          <input type="radio" name="esalergicoSN" class="flat-red" value="NO" <?php if($datosmedicos->esalergicoSN=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

           <div class="form-group">                                           
            {!! Form::label('lbalergia', 'Alérgico a',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
            {!! Form::textarea('alergicoa',$datosmedicos->alergicoa,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','']) !!}
                                                </div>
                </div><!--fin form group-->
               
            <div class="form-group">                                           
             {!! Form::label('lbalimentoqprefiere', 'Alimentos que prefiere',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
              {!! Form::textarea('alimentos_prefiere',$datosmedicos->alimentos_prefiere,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','']) !!}
                                                </div>
                </div><!--fin form group-->               

                 <div class="form-group">                                           
                {!! Form::label('lbalimentoqrechaza', 'Alimentos que rechaza',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                {!! Form::textarea('alimentos_rechaza',$datosmedicos->alimentos_rechaza,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','']) !!}
                                                </div>
                </div><!--fin form group-->
            

          <div class="form-group">
         {!! Form::label('lbprescmedica', '¿Tiene el estudiante alguna prescripción médica especial que debe seguirse en el centro?',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="prescripcionmedicaSN" class="flat-red" value="SI" <?php if($datosmedicos->prescripcionmedicaSN=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'NO',['class'=>'col- control-label']) !!}
          <input type="radio" name="prescripcionmedicaSN" class="flat-red" value="NO" <?php if($datosmedicos->prescripcionmedicaSN=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

               
          <div class="form-group">                                           
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
           {!! Form::textarea('detallereceta',$datosmedicos->detallereceta,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','']) !!}
                                   </div>
   </div>
            
        
  </div><!--box body-->
 <div class="box-footer" align="right">   
     {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
   <a href="{{route('listaexpedientes')}}" class="btn btn-default">Finalizar</a>
 </div>
{!! Form::close() !!}

 </div><!--box primary-->
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

      $('#chkalimentos').change(function() {
          if(this.checked) {            
              $('.checkA').prop('checked', false);
          }      
      });
      $('.checkA').change(function() {
          if(this.checked) {            
              $('#chkalimentos').prop('checked', false);
          }      
      });

      $('#chktiempos').change(function() {
          if(this.checked) {            
              $('.checkC').prop('checked', false);
          }      
      });
      $('.checkC').change(function() {
          if(this.checked) {            
              $('#chktiempos').prop('checked', false);
          }      
      });
      

$('#departamentos').on('change', function(e){
//alert('deptos');
var id=$(this).val();
 $('#municipio_id').empty();
 $('#municipio_id').append('<option value="'+ '' +'" id="municipio_id" placeholder="Seleccione">'+ 'Seleccione' +'</option>');
$.get('municipios/'+id,function(municipios){
  $(municipios).each(function (key,value){   
$('#municipio_id').append('<option value="'+value.id+'" id="municipio_id">'+value.v_municipio+'</option>');
  });
});

});//fin municipios


$('#municipio_id').on('change', function(e){
var id=$(this).val();
$('#colonia_caserio_id').empty();
$('#colonia_caserio_id').append('<option value="'+ '' +'" id="colonia_caserio_id" placeholder="Seleccione">'+ 'Seleccione' +'</option>');
$.get('colonias/'+id,function(colonias){//'colonias' es el nombre de la ruta 
  $(colonias).each(function (key,value){
$('#colonia_caserio_id').append('<option value="'+ value.id +'" id="colonia_caserio_id">'+ value.v_caserio +'</option>');
//alert(value.v_caserio);
  });
});
});
});//fin caserios
 </script>
 <script>
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

