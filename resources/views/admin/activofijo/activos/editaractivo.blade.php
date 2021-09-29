@extends('admin.menuprincipal')
@section('tittle', 'Administración Activo Fijo/Actualizar Activo')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>ACTUALIZAR ACTIVO</Strong></h3>
  </div>
  <!-- /.box-header -->
  @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <!-- form start -->   
  <div class="box-body">
    {!! Form::open(['route'=>['actualizaractivo',$activo->id], 'method'=>'PUT','class'=>'form-horizontal']) !!}
    {!! Form::hidden('cod_infra',$infra,['id'=>'cod_infra']) !!}
    {!! Form::hidden('cod_cata',$activo->cuentacatalogo->v_codigocuenta,['id'=>'cod_cata']) !!}
    {!! Form::hidden('cod_acti',$activo->v_codigoactivo,['id'=>'cod_acti']) !!}
    
    <div class="form-group">                                           
          {!! Form::label('lbcuenta', 'Clasificación de activo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('cuentacatalogo_id', $cuentas, $activo->cuentacatalogo->v_codigocuenta,['class'=>'form-control','id'=>'id_cuentas','disabled'])!!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbcod', 'Código',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_codigoactivo',$activo->v_codigoactivo,['class'=>'form-control pull-right','placeholder'=>'Código de activo','readonly']) !!}
          </div> 
        </div>
    
       

        <div class="form-group"> 
          {!! Form::label('lbserie', 'Serie',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_serie',$activo->v_serie,['class'=>'form-control pull-right','placeholder'=>'Número de serie']) !!}
          </div>                                                                 
        </div>
   
        <div class="form-group">                                           
          {!! Form::label('lbmodelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_modelo',$activo->v_modelo,['class'=>'form-control pull-right','placeholder'=>'Modelo']) !!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbmarca', 'Marca',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_marca',$activo->v_marca,['class'=>'form-control pull-right','placeholder'=>'Marca']) !!}
          </div>
        </div>
     
        
     
        <div class="form-group">                                           
          {!! Form::label('lbmat', 'Material de construcción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_materialdeconstruccion',$activo->v_materialdeconstruccion,['class'=>'form-control pull-right','placeholder'=>'cemento - plástico - concreto - otros']) !!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbmedida', 'Medida',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_medida',$activo->v_medida,['class'=>'form-control pull-right','placeholder'=>'centimetro - unidad - otros']) !!}
          </div>
        </div>
   
        <div class="form-group"> 
          {!! Form::label('lbcondicion', 'Condición actual',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_condicionactivo',['Bueno'=>'Bueno','Malo'=>'Malo'], $activo->v_condicionactivo,['class'=>'form-control'])!!}
          </div>
           </div><!--fin form group-->

              <div class="form-group">                                           
          {!! Form::label('lbdesc', 'Descripción ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_nombre',$activo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción activo']) !!}
          </div>
           </div>

        <div class="form-group"> 
          {!! Form::label('lbubicacion', 'Asignado a',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_ubicacion',$activo->v_ubicacion,['class'=>'form-control pull-right','placeholder'=>'Persona o área a la que está asignado el activo']) !!}
          </div>
        </div>
  
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',$activo->v_observaciones,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones']) !!}
          </div>
        </div>

        
        <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de adquisición *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fecha_adquisicion',$activo->f_fecha_adquisicion,['class'=>'form-control pull-right nac','data-mask'=>'','placeholder'=>'Fecha de adquisición de activo']) !!}
            </div> 
          </div>  
        </div><!--fin form group-->

<div class="form-group"> 
          {!! Form::label('lbcondicion', 'Forma de adquisición *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_formaadquisicion',['1'=>'Entrega del MINED','2'=>'Donado','3'=>'Fondo GOES','4'=>'Presupuesto escolar'], $activo->v_formaadquisicion,['class'=>'form-control'])!!}
          </div>
           </div><!--fin form group-->

 <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Documento',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('v_documento',$activo->v_documento,['class'=>'form-control pull-right','placeholder'=>'# de documento de adquisición']) !!}
          </div>
        </div>

        <div class="form-group">                                          
          {!! Form::label('lbvalor', 'Valor de adquisición ($) *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('d_valor',$activo->d_valor,['class'=>'form-control pull-right','required','data-inputmask'=>"'alias': 'decimal'",'data-mask','id'=>'d_valor']) !!}
          </div>
           </div><!--fin form group-->


           <div class="form-group">
          {!! Form::label('valorderecuperacion', '¿Aplica valor de recuperación? *',['class'=>'col-sm-4 control-label']) !!}
          
          <div class="col-sm-5">
             {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
              <input type="radio" name="valorrecuperacionSN" class="col control-label" id="valorrecuperacionSN" value="SI" <?php if($activo->valorrecuperacionSN=="SI"){ ?> checked="checked" <?php } ?> >

               {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
              <input type="radio" name="valorrecuperacionSN" class="col control-label" id="valorrecuperacionSN" value="NO" <?php if($activo->valorrecuperacionSN=="NO"){ ?> checked="checked" <?php } ?> >
            </div>

        </div>


      <div class="form-group">                                          
          {!! Form::label('lbvalor', 'Valor de recuperación 10%($) *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('d_valorsalvamento',$activo->d_valorrecuperacion,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'decimal'",'data-mask','id'=>'d_valorsalvamento','disabled']) !!}
          </div>
      </div><!--fin form group-->

      <div class="form-group">                                          
          {!! Form::label('lbvalor', 'Base para depreciación 90% ($) *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('d_basedepreciacion',$activo->d_basedepreciacion,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'decimal'",'data-mask','id'=>'d_basedepreciacion','disabled']) !!}
          </div>
      </div><!--fin form group-->

<div class="form-group">
          {!! Form::label('biendepreciable', '¿Aplica depreciación? *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
             {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
              <input type="radio" name="depreciacionSN" class="col control-label" id="depreciacionSI" value="SI" <?php if($activo->depreciacionSN=="SI"){ ?> checked="checked" <?php } ?> >

               {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
              <input type="radio" name="depreciacionSN" class="col control-label" id="depreciacionNO" value="NO" <?php if($activo->depreciacionSN=="NO"){ ?> checked="checked" <?php } ?> >
            </div>
        </div>
       



        <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Vida útil (años)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('v_vidautil',$activo->v_vidautil,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'integer'",'data-mask','id'=>'v_vidautil']) !!}
          </div>
        </div>

       



    </div>

  <div class="box-footer" align="right">                
    {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
    <a href="{{route('activofijo')}}" class="btn btn-default">Cancelar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->
</div>
@endsection
@section('script')
<script>

$(document).ready(function() {

//cambiar codigo cuenta catalogo activo
  $("#id_cuentas").on('change',function(){ 
    var opt = $("#id_cuentas option:selected").val(); 
    if ('["'+opt+'"]'!=$("#cod_cata").val()) {//si cambia la cuenta genero codigo nuevo
      var cod = $("#cod_infra").val();
      $.ajax({
          url:"{{ route('correlativoactivo') }}",
          method:"POST",
          data:{codigo:opt, _token: "{{ csrf_token() }}"},
          success:function(data){
            $("#id_codigo").val(cod+opt+data);
          }
        }); 
    }else {//si es la misma cuenta recupero el codigo q tenia
      $("#id_codigo").val($("#cod_acti").val());
    }
  }); 


  $('input[type=radio][name=valorrecuperacionSN]').change(function () {

            if (this.value == 'SI') 
            {
let monto=document.getElementById("d_valor").value;
document.getElementById("d_basedepreciacion").value = monto*0.90;
document.getElementById("d_valorsalvamento").value = monto*0.10;

            }
            if (this.value == 'NO') {
document.getElementById("d_basedepreciacion").value = "";
document.getElementById("d_valorsalvamento").value ="";
document.getElementById("d_valorsalvamento").disabled = true;              
document.getElementById("d_basedepreciacion").disabled = true;
            }
        });


$('#depreciacionSI').on('click', function(e){
document.getElementById("v_vidautil").disabled =false; 
 });

$('#depreciacionNO').on('click', function(e){ 
 document.getElementById("v_vidautil").disabled =true;
 document.getElementById("v_vidautil").value ="";
});

  
});

</script>
@endsection