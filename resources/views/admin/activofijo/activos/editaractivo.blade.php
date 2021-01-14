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
          {!! Form::label('fecha', 'Fecha de adquisición *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fecha_adquisicion',$activo->f_fecha_adquisicion,['class'=>'form-control pull-right nac','data-mask'=>'','placeholder'=>'Fecha de adquisición de activo','required']) !!}
            </div> 
          </div>  
        </div><!--fin form group-->    
        <div class="form-group">                                           
          {!! Form::label('lbcuenta', 'Clasificación de activo *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('cuentacatalogo_id', $cuentas, $activo->cuentacatalogo->v_codigocuenta,['class'=>'form-control','id'=>'id_cuentas'])!!}
          </div>
            </div><!--fin form group-->    
        <div class="form-group">
          {!! Form::label('lbcod', 'Código *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_codigoactivo',$activo->v_codigoactivo,['class'=>'form-control pull-right','id'=>'id_codigo','placeholder'=>'Código de activo','required','readonly']) !!}
          </div> 
        </div>
 
        <div class="form-group">                                           
          {!! Form::label('lbdesc', 'Descripción *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_nombre',$activo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción activo','required']) !!}
          </div>
            </div><!--fin form group-->    
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
          {!! Form::label('lbmarca', 'Marca *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_marca',$activo->v_marca,['class'=>'form-control pull-right','placeholder'=>'Marca','required']) !!}
          </div>
        </div>
    
        <div class="form-group">                                           
          {!! Form::label('lbvalor', 'Valor ($)* ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('d_valor',$activo->d_valor,['class'=>'form-control pull-right','required','data-inputmask'=>"'alias': 'decimal'",'data-mask']) !!}
          </div>
            </div><!--fin form group-->    
        <div class="form-group">
          {!! Form::label('lbvidautil', 'Vida útil (años)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_vidautil',$activo->v_vidautil,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'integer'",'data-mask']) !!}
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
          {!! Form::label('lbcondicion', 'Condición actual *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_condicionactivo',['Bueno'=>'Bueno','Malo'=>'Malo'], $activo->v_condicionactivo,['class'=>'form-control'])!!}
          </div>
            </div><!--fin form group-->    
        <div class="form-group">
          {!! Form::label('lbubicacion', 'Ubicación *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_ubicacion',$activo->v_ubicacion,['class'=>'form-control pull-right','placeholder'=>'Especifique ubicación del activo','required']) !!}
          </div>
        </div>
   
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',$activo->v_observaciones,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones']) !!}
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
  
});

</script>
@endsection