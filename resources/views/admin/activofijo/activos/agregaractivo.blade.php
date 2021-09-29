@extends('admin.menuprincipal')
@section('tittle', 'Administración Activo Fijo/Agregar Activo')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>CARGAR ACTIVO</Strong></h3>
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
    {!! Form::open(['route'=>'agregaractivo', 'method'=>'POST','class'=>'form-horizontal']) !!}
    {!! Form::hidden('cod_infra',$infra,['id'=>'cod_infra']) !!}
      
        
        <div class="form-group">                                           
          {!! Form::label('lbcuenta', 'Clasificación de activo *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('cuentacatalogo_id', $cuentas, null,['class'=>'form-control','id'=>'id_cuentas'])!!}
          </div>
          </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbcod', 'Código *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_codigoactivo',null,['class'=>'form-control pull-right','id'=>'id_codigo','placeholder'=>'Código de activo','required','readonly']) !!}
          </div> 
        </div>
    
           
        <div class="form-group"> 
          {!! Form::label('lbserie', 'Serie',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_serie',null,['class'=>'form-control pull-right','placeholder'=>'Número de serie']) !!}
          </div>                                                                 
        </div>
    
        <div class="form-group">                                           
          {!! Form::label('lbmodelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_modelo',null,['class'=>'form-control pull-right','placeholder'=>'Modelo']) !!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbmarca', 'Marca',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_marca',null,['class'=>'form-control pull-right','placeholder'=>'Marca']) !!}
          </div>
        </div>
    
    
        <div class="form-group">                                           
          {!! Form::label('lbmat', 'Material de construcción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_materialdeconstruccion',null,['class'=>'form-control pull-right','placeholder'=>'cemento - plástico - concreto - otros']) !!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbmedida', 'Medida',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_medida',null,['class'=>'form-control pull-right','placeholder'=>'centimetro - unidad - otros']) !!}
          </div>
        </div>
   
        <div class="form-group"> 
          {!! Form::label('lbcondicion', 'Condición actual *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_condicionactivo',['Bueno'=>'Bueno','Malo'=>'Malo'], null,['class'=>'form-control'])!!}
          </div>
           </div><!--fin form group-->
            <div class="form-group">                                           
          {!! Form::label('lbdesc', 'Descripción *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_nombre',null,['class'=>'form-control pull-right','placeholder'=>'Descripción activo','required']) !!}
          </div>
           </div>
        <div class="form-group"> 
          {!! Form::label('lbubicacion', 'Asignado a *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_ubicacion',null,['class'=>'form-control pull-right','placeholder'=>'Persona o área a la que está asignado el activo','required']) !!}
          </div>
        </div>
  
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones']) !!}
          </div>
        </div>

        <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de adquisición *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fecha_adquisicion',null,['class'=>'form-control pull-right nac','data-mask'=>'','placeholder'=>'Fecha de adquisición de activo','required']) !!}
            </div> 
          </div>  
        </div><!--fin form group-->

<div class="form-group"> 
          {!! Form::label('lbcondicion', 'Forma de adquisición *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_formaadquisicion',['1'=>'Entrega del MINED','2'=>'Donado','3'=>'Fondo GOES','4'=>'Presupuesto escolar'], null,['class'=>'form-control'])!!}
          </div>
           </div><!--fin form group-->

            <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Documento',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('v_documento',null,['class'=>'form-control pull-right','placeholder'=>'# de documento de adquisición']) !!}
          </div>
        </div>

        <div class="form-group">                                          
          {!! Form::label('lbvalor', 'Valor de adquisición ($) *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('d_valor',null,['class'=>'form-control pull-right','required','data-inputmask'=>"'alias': 'decimal'",'data-mask','id'=>'d_valor']) !!}
          </div>
      </div><!--fin form group-->

<div class="form-group">
          {!! Form::label('valorderecuperacion', '¿Aplica valor de recuperación? *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::label('lbsi', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('valorrecuperacionSN','SI',false, ['class'=>'col- control-label','id'=>'recupSI'])!!}

          {!! Form::label('lbno', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('valorrecuperacionSN','NO',true, ['class'=>'col- control-label','id'=>'recupNO'])!!}
           </div> 
        </div>


      <div class="form-group">                                          
          {!! Form::label('lbvalor', 'Valor de recuperación 10%($) *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('d_valorsalvamento',null,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'decimal'",'data-mask','id'=>'d_valorsalvamento','disabled']) !!}
          </div>
      </div><!--fin form group-->

      <div class="form-group">                                          
          {!! Form::label('lbvalor', 'Base para depreciación 90% ($) *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('d_basedepreciacion',null,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'decimal'",'data-mask','id'=>'d_basedepreciacion','disabled']) !!}
          </div>
      </div><!--fin form group-->

<div class="form-group">
          {!! Form::label('biendepreciable', '¿Aplica depreciación? *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::label('lbsi', 'SI',['class'=>'col- control-label']) !!}
          {!! Form::radio('depreciacionSN','SI',true, ['class'=>'col- control-label','id'=>'depreciacionSI'])!!}
          {!! Form::label('lbno', 'NO',['class'=>'control-label']) !!}
          {!! Form::radio('depreciacionSN','NO',false, ['class'=>'col- control-label','id'=>'depreciacionNO'])!!}
           </div> 
        </div>

        <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Vida útil (años)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('v_vidautil',null,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'integer'",'data-mask','id'=>'v_vidautil']) !!}
          </div>
        </div>

       
        

      </div>
  
    <div class="box-footer" align="right">                
      {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
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
    var cod = $("#cod_infra").val();
    $.ajax({
        url:"{{ route('correlativoactivo') }}",
        method:"POST",
        data:{codigo:opt, _token: "{{ csrf_token() }}"},
        success:function(data){
          $("#id_codigo").val(cod+opt+data);
        }
      });   
  }); 

  //generar codigo activo al cargar formulario
  var opt = $("#id_cuentas option:selected").val(); 
  if(opt!=null){
    var cod = $("#cod_infra").val();
    $.ajax({
        url:"{{ route('correlativoactivo') }}",
        method:"POST",
        data:{codigo:opt, _token: "{{ csrf_token() }}"},
        success:function(data){
          $("#id_codigo").val(cod+opt+data);
        }
      });
  }
  

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
});

});


</script>
@endsection