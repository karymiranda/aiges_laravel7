@extends('admin.menuprincipal')
@section('tittle', 'Administración Activo Fijo/Agregar Activo')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>AGREGAR ACTIVO</Strong></h3>
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
          {!! Form::label('lbdesc', 'Descripción *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_nombre',null,['class'=>'form-control pull-right','placeholder'=>'Descripción activo','required']) !!}
          </div>
           </div><!--fin form group-->
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
          {!! Form::label('lbmarca', 'Marca *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_marca',null,['class'=>'form-control pull-right','placeholder'=>'Marca','required']) !!}
          </div>
        </div>
    
        <div class="form-group">                                           
          {!! Form::label('lbvalor', 'Valor ($) *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('d_valor',null,['class'=>'form-control pull-right','required','data-inputmask'=>"'alias': 'decimal'",'data-mask']) !!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Vida útil (años)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_vidautil',null,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'integer'",'data-mask']) !!}
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
          {!! Form::label('lbubicacion', 'Ubicación *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_ubicacion',null,['class'=>'form-control pull-right','placeholder'=>'Especifique ubicación del activo','required']) !!}
          </div>
        </div>
  
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones']) !!}
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
  
});

</script>
@endsection