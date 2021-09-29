@extends('admin.menuprincipal')
@section('tittle', 'Administración activo fijo/Detalle activo fijo')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>DETALLE ACTIVO</Strong></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    {!! Form::open(['class'=>'form-horizontal']) !!}     
       
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
            {!! Form::text('v_serie',$activo->v_serie,['class'=>'form-control pull-right','placeholder'=>'Número de serie','readonly']) !!}
          </div>                                                                 
        </div>
   
        <div class="form-group">                                           
          {!! Form::label('lbmodelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_modelo',$activo->v_modelo,['class'=>'form-control pull-right','placeholder'=>'Modelo','readonly']) !!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbmarca', 'Marca',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_marca',$activo->v_marca,['class'=>'form-control pull-right','placeholder'=>'Marca','readonly']) !!}
          </div>
        </div>
     
        
     
        <div class="form-group">                                           
          {!! Form::label('lbmat', 'Material de construcción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_materialdeconstruccion',$activo->v_materialdeconstruccion,['class'=>'form-control pull-right','placeholder'=>'cemento - plástico - concreto - otros','readonly']) !!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbmedida', 'Medida',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_medida',$activo->v_medida,['class'=>'form-control pull-right','placeholder'=>'centimetro - unidad - otros','readonly']) !!}
          </div>
        </div>
   
        <div class="form-group"> 
          {!! Form::label('lbcondicion', 'Condición actual',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_condicionactivo',['Bueno'=>'Bueno','Malo'=>'Malo'], $activo->v_condicionactivo,['class'=>'form-control','disabled'])!!}
          </div>
           </div><!--fin form group-->

              <div class="form-group">                                           
          {!! Form::label('lbdesc', 'Descripción ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_nombre',$activo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción activo','readonly']) !!}
          </div>
           </div>

        <div class="form-group"> 
          {!! Form::label('lbubicacion', 'Asignado a',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_ubicacion',$activo->v_ubicacion,['class'=>'form-control pull-right','placeholder'=>'Persona o área a la que está asignado el activo','readonly']) !!}
          </div>
        </div>
  
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',$activo->v_observaciones,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones','readonly']) !!}
          </div>
        </div>

        
        <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de adquisición *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fecha_adquisicion',$activo->f_fecha_adquisicion,['class'=>'form-control pull-right nac','data-mask'=>'','placeholder'=>'Fecha de adquisición de activo','disabled']) !!}
            </div> 
          </div>  
        </div><!--fin form group-->

<div class="form-group"> 
          {!! Form::label('lbcondicion', 'Forma de adquisición *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_formaadquisicion',['1'=>'Entrega del MINED','2'=>'Donado','3'=>'Fondo GOES','4'=>'Presupuesto escolar'], $activo->v_formaadquisicion,['class'=>'form-control','readonly'])!!}
          </div>
           </div><!--fin form group-->

     <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Documento',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('v_documento',$activo->v_documento,['class'=>'form-control pull-right','placeholder'=>'# de documento de adquisición','disabled']) !!}
          </div>
        </div>

        <div class="form-group">                                          
          {!! Form::label('lbvalor', 'Valor de adquisición ($) *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('d_valor',$activo->d_valor,['class'=>'form-control pull-right','required','data-inputmask'=>"'alias': 'decimal'",'data-mask','disabled']) !!}
          </div>
           </div><!--fin form group-->

 <div class="form-group">
          {!! Form::label('valorderecuperacion', '¿Aplica valor de recuperación? *',['class'=>'col-sm-4 control-label']) !!}
          
          <div class="col-sm-5">
             {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
              <input type="radio" name="valorrecuperacionSN" class="flat-red" d="trasladoradiosi" value="SI" <?php if($activo->valorrecuperacionSN=="SI"){ ?> checked="checked" <?php } ?> >

               {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
              <input type="radio" name="valorrecuperacionSN" class="flat-red" d="trasladoradiosi" value="NO" <?php if($activo->valorrecuperacionSN=="NO"){ ?> checked="checked" <?php } ?> >
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
              <input type="radio" name="depreciacionSN" class="flat-red" d="trasladoradiosi" value="SI" <?php if($activo->depreciacionSN=="SI"){ ?> checked="checked" <?php } ?> >

               {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
              <input type="radio" name="depreciacionSN" class="flat-red" d="trasladoradiosi" value="NO" <?php if($activo->depreciacionSN=="NO"){ ?> checked="checked" <?php } ?> >
            </div>
        </div>
       


        <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Vida útil (años)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('v_vidautil',$activo->v_vidautil,['class'=>'form-control pull-right','data-inputmask'=>"'alias': 'integer'",'data-mask','disabled']) !!}
          </div>
        </div>

            </div>
   
    <div class="box-footer" align="right">                           
      <a href="{{route('activofijo')}}" class="btn btn-primary"> << Regresar</a>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->
</div>
@endsection