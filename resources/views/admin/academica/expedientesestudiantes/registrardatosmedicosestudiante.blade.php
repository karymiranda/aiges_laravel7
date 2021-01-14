@extends('admin.menuprincipal')
@section('tittle','Administración académica/Registro Estudiantil/Creación de Expediente/Datos Médicos')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border ">
              <h3 class="box-title"><Strong>DATOS MEDICOS  </Strong></h3>
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
	 {!! Form::open(['route'=>'guardardatosmedicosestudiante', 'method'=>'POST','class'=>'form-horizontal']) !!}

          <input type="hidden" name="expedienteestudiante_id" value="{{$idestudiante}}">
          <div class="form-group">
          {!! Form::label('cantfam', 'Presenta tarjeta de vacuna',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('tarjeta_vacuna','SI',false, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('tarjeta_vacuna','NO',true, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
          </div>

            <div class="form-group">
            {!! Form::label('cantfam', 'Esquema de vacunas completo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('vacuna_completa','SI',true, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('vacuna_completa','NO',false, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
          </div>

          <div class="form-group">
            {!! Form::label('cantfam', 'Tipo sanguineo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::label('', 'AB-',['class'=>'col- control-label']) !!}
          {!! Form::radio('tipo_sanguineo','AB-',false, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('', 'AB+',['class'=>'control-label']) !!}
          {!! Form::radio('tipo_sanguineo','AB+',false, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          {!! Form::label('', 'A-',['class'=>'col- control-label']) !!}
          {!! Form::radio('tipo_sanguineo','A-',false, ['class'=>'flat-red','id'=>'optionsRadios3'])!!}
          {!! Form::label('', 'A+',['class'=>'control-label']) !!}
          {!! Form::radio('tipo_sanguineo','A+',false, ['class'=>'flat-red','id'=>'optionsRadios4'])!!}
          {!! Form::label('', 'B-',['class'=>'col- control-label']) !!}
          {!! Form::radio('tipo_sanguineo','B-',false, ['class'=>'flat-red','id'=>'optionsRadios5'])!!}
          {!! Form::label('', 'B+',['class'=>'control-label']) !!}
          {!! Form::radio('tipo_sanguineo','B+',false, ['class'=>'flat-red','id'=>'optionsRadios6'])!!}
          {!! Form::label('', 'O-',['class'=>'col- control-label']) !!}
          {!! Form::radio('tipo_sanguineo','O-',false, ['class'=>'flat-red','id'=>'optionsRadios7'])!!}
          {!! Form::label('', 'O+',['class'=>'control-label']) !!}
          {!! Form::radio('tipo_sanguineo','O+',false, ['class'=>'flat-red','id'=>'optionsRadios8'])!!}
          {!! Form::label('', 'No sabe',['class'=>'control-label']) !!}
          {!! Form::radio('tipo_sanguineo','No sabe',true, ['class'=>'flat-red','id'=>'optionsRadios9'])!!}
          </div> 
          </div>

                
                  <div class="form-group"> 
         {!! Form::label('cantfam', 'Discapacidades',['class'=>'col-sm-4 control-label']) !!}                  
                <div class="col-sm-5">
        {!! Form::checkbox('discapacidades[]', 'Ninguna', true,['id'=>'super'])!!}
        {!! Form::label('sup', 'Ninguna',['class'=>'control-label']) !!}<br>
        {!! Form::checkbox('discapacidades[]', 'Baja visión', false,['class'=>'check'])!!}
        {!! Form::label('bono', 'Baja visión',['class'=>'control-label ']) !!}<br>
        {!! Form::checkbox('discapacidades[]', 'Sordera', false,['class'=>'check'])!!}
        {!! Form::label('acti', 'Sordera',['class'=>'control-label']) !!}<br>  {!! Form::checkbox('discapacidades[]', 'Falta de miembro', false,['class'=>'check'])!!}
        {!! Form::label('aca', 'Falta de miembro',['class'=>'control-label']) !!}<br>  
                </div>
                 
                  </div>             
                
                 <div class="form-group">                                           
                           {!! Form::label('lbhorariosuenonoche', 'Horario de sueño por la noche',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-5">
                            {!! Form::textarea('horario_sueno_noche',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Ejemplo: 7:00 pm a 6:00 am','']) !!}
                                                </div>
                </div><!--fin form group-->
              


              
                 <div class="form-group">                                           
                                                {!! Form::label('lbhorariosuenodia', 'Horario de sueño durante el dia',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                               {!! Form::textarea('horario_sueno_dia',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Ejemplo: 2:00 pm a 3:00 pm','']) !!}
                                                </div>
                </div><!--fin form group-->
              
               

            <div class="form-group">
            {!! Form::label('lbdificultad', 'Presenta dificultades para dormir',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('dificul_dormir','SI',false, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('dificul_dormir','NO',true, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
          </div>

          <div class="form-group">
           {!! Form::label('lblechematerna', 'Es o fué alimentado con leche materna',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('tomo_pecho','SI',true, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('tomo_pecho','NO',false, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
          </div>


               
                    <div class="form-group">                                           
                                                {!! Form::label('lbmeseslactancia', '¿Cuántos meses?',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                   {!! Form::text('tiempo_lactancia',null,['class'=>'form-control pull-right','placeholder'=>'Meses','']) !!}
                                                </div>
                                                
                </div><!--fin form group-->
                 


                  
                    <div class="form-group">                                           
                                                {!! Form::label('lbdifalimentacion', '¿Ha presentado dificultades para alimentarse?',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                   {!! Form::text('tiene_dificultad_comer',null,['class'=>'form-control pull-right','placeholder'=>'Especifíque','']) !!}
                                                </div>                 
                   </div><!--fin form group-->
                  


          
                  <div class="form-group"> 
                    {!! Form::label('lbalimentos', 'Alimentos que consume ',['class'=>'col-sm-4 control-label']) !!}                  
                <div class="col-sm-5">
        {!! Form::checkbox('alimentos_consume[]', 'Todos', true,['id'=>'chkalimentos'])!!}
        {!! Form::label('sup', 'Todos',['class'=>'control-label']) !!}<br>
       {!! Form::checkbox('alimentos_consume[]', 'Lacteos', false,['class'=>'checkA'])!!}
        {!! Form::label('bono', 'Lacteos',['class'=>'control-label ']) !!}<br>
        {!! Form::checkbox('alimentos_consume[]', 'Verduras', false,['class'=>'checkA'])!!}
        {!! Form::label('acti', 'Verduras',['class'=>'control-label']) !!}<br>  
        {!! Form::checkbox('alimentos_consume[]', 'Cereales', false,['class'=>'checkA'])!!}
        {!! Form::label('aca', 'Cereales',['class'=>'control-label']) !!}<br>
         {!! Form::checkbox('alimentos_consume[]', 'Frutas', false,['class'=>'checkA'])!!}
           {!! Form::label('aca', 'Frutas',['class'=>'control-label']) !!}<br>
 {!! Form::checkbox('alimentos_consume[]', 'Carne de pollo', false,['class'=>'checkA'])!!}
         {!! Form::label('bono', 'Carne de pollo',['class'=>'control-label ']) !!}<br> 
       {!! Form::checkbox('alimentos_consume[]', 'Carne de res', false,['class'=>'checkA'])!!}
        {!! Form::label('bono', 'Carne de res',['class'=>'control-label ']) !!}<br>
        {!! Form::checkbox('alimentos_consume[]', 'Carne de cerdo', false,['class'=>'checkA'])!!}
        {!! Form::label('acti', 'Carne de cerdo',['class'=>'control-label']) !!}<br>  {!! Form::checkbox('alimentos_consume[]', 'Mariscos', false,['class'=>'checkA'])!!}
        {!! Form::label('aca', 'Mariscos',['class'=>'control-label']) !!}<br>

                  </div>              
                  </div>
                 

             
                  <div class="form-group"> 
                    {!! Form::label('lbalimentos', '¿Cuántos tiempo de comida realiza?',['class'=>'col-sm-4 control-label']) !!}                  
                <div class="col-sm-5">
        {!! Form::checkbox('tiempos_comida[]', 'Todos', true,['id'=>'chktiempos'])!!}
        {!! Form::label('sup', 'Todos',['class'=>'control-label']) !!}<br>
       {!! Form::checkbox('tiempos_comida[]', 'Desayuno', false,['class'=>'checkC'])!!}
        {!! Form::label('bono', 'Desayuno',['class'=>'control-label ']) !!}<br>
        {!! Form::checkbox('tiempos_comida[]', 'Almuerzo', false,['class'=>'checkC'])!!}
        {!! Form::label('acti', 'Almuerzo',['class'=>'control-label']) !!}<br>
        {!! Form::checkbox('tiempos_comida[]', 'Cena', false,['class'=>'checkC'])!!}
        {!! Form::label('acti', 'Cena',['class'=>'control-label']) !!}<br>
                 </div>             
  </div>                


                 
                    <div class="form-group">                                           
                                    {!! Form::label('lbrefrigerios', '¿Cuantos refrigerios realiza?',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                    {!! Form::text('canti_refrigerios',null,['class'=>'form-control pull-right','placeholder'=>'Cantidad','']) !!}
                                                </div>                 
                   </div><!--fin form group-->
                

          <div class="form-group">
         {!! Form::label('lbalergico', '¿Es alérgico? (alimentos - medicamentos)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('esalergicoSN','SI',false, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('esalergicoSN','NO',true, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
          </div>



                
                 <div class="form-group">                                           
                                                {!! Form::label('lbalergia', 'Alérgico a',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                {!! Form::textarea('alergicoa',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','']) !!}
                                                </div>
                </div><!--fin form group-->
               


              
                 <div class="form-group">                                           
                                                {!! Form::label('lbalimentoqprefiere', 'Alimentos que prefiere',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                          {!! Form::textarea('alimentos_prefiere',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','']) !!}
                                                </div>
                </div><!--fin form group-->
               

                 <div class="form-group">                                           
                                                {!! Form::label('lbalimentoqrechaza', 'Alimentos que rechaza',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                         {!! Form::textarea('alimentos_rechaza',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','']) !!}
                                                </div>
                </div><!--fin form group-->
            

          <div class="form-group">
         {!! Form::label('lbprescmedica', '¿Tiene el estudiante alguna prescripción médica especial que debe seguirse en el centro?',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('prescripcionmedicaSN','SI',false, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('prescripcionmedicaSN','NO',true, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
          </div>

               
                 <div class="form-group">                                           
                                                {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                              {!! Form::textarea('detallereceta',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique el detalle de la receta...','']) !!}
                                                </div>
                </div><!--fin form group-->
 </div>         
                
              <div class="box-footer" align="right">                
                 {!! Form::submit('Siguiente >>',['class'=>'btn btn-primary ']) !!}
              </div>

                {!! Form::close() !!}

</div> 
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

        });
    </script>
@endsection