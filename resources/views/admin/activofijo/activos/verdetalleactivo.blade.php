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
          {!! Form::label('fecha', 'Fecha de adquisición',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fecha_adquisicion',$activo->f_fecha_adquisicion,['class'=>'form-control pull-right',  'placeholder'=>'Fecha de adquisición de activo','readonly']) !!}
            </div> 
          </div>  
        </div><!--fin form group-->
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
          {!! Form::label('lbdesc', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_nombre',$activo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción activo','readonly']) !!}
          </div>
           </div><!--fin form group-->
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
          {!! Form::label('lbvalor', 'Valor ($) ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('d_valor',$activo->d_valor,['class'=>'form-control pull-right','readonly']) !!}
          </div>
           </div><!--fin form group-->
        <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Vida útil (años)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_vidautil',$activo->v_vidautil,['class'=>'form-control pull-right','readonly']) !!}
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
          {!! Form::label('lbubicacion', 'Ubicación',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_ubicacion',$activo->v_ubicacion,['class'=>'form-control pull-right','placeholder'=>'Especifique ubicación del activo','readonly']) !!}
          </div>
        </div>
  
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',$activo->v_observaciones,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones','readonly']) !!}
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