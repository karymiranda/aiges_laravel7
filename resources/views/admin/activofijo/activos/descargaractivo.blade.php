@extends('admin.menuprincipal')
@section('tittle', 'Administración activo fijo/Descarga de activo')
@section('content')

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>DESCARGO DE ACTIVOS</Strong></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
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
    {!! Form::open(['route'=>'guardardescargo', 'method'=>'POST','class'=>'form-horizontal']) !!}
    {!! Form::hidden('activofijo_id', $activo->id) !!}
     
        <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de descargo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechadescargo',null,['class'=>'form-control pull-right calendario','data-mask'=>'']) !!}
            </div> 
          </div> 
           </div>
     
        <div class="form-group">  
          {!! Form::label('lbtipodescargo', 'Motivo de descargo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('tipodescargo_id',$tiposdescargo, null,['class'=>'form-control'])!!}
          </div>
        </div><!--fin form group-->
    
        <div class="form-group">                                           
          {!! Form::label('lbcuenta', 'Clasificación de activo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtclasi',$activo->cuentacatalogo->v_nombrecuenta,['class'=>'form-control pull-right','placeholder'=>'Clasificación de activo','readonly']) !!}
          </div>  
           </div>
     
        <div class="form-group">  
          {!! Form::label('lbcod', 'Código',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('codactivo',$activo->v_codigoactivo,['class'=>'form-control pull-right','placeholder'=>'Código de activo','readonly']) !!}
          </div>                                                 
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbdesc', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtdesc',$activo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción activo','readonly']) !!}
          </div>
           </div>
     
        <div class="form-group"> 
          {!! Form::label('lbserie', 'Serie',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtserie',$activo->v_serie,['class'=>'form-control pull-right','placeholder'=>'Número de serie','readonly']) !!}
          </div>                                                                 
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbmodelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtmodelo',$activo->v_modelo,['class'=>'form-control pull-right','placeholder'=>'Modelo','readonly']) !!}
          </div>
           </div>
     
        <div class="form-group"> 
          {!! Form::label('lbmarca', 'Marca',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtmarca',$activo->v_marca,['class'=>'form-control pull-right','placeholder'=>'Marca','readonly']) !!}
          </div>
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbvalor', 'Valor ($) ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtvalor',$activo->d_valor,['class'=>'form-control pull-right','placeholder'=>'Valor del activo','readonly']) !!}
          </div>
           </div>
     
        <div class="form-group"> 
          {!! Form::label('lbubicacion', 'Ubicación',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtubicacion',$activo->v_ubicacion,['class'=>'form-control pull-right','placeholder'=>'Especifique ubicación del activo','readonly']) !!}
          </div>
        </div>
    
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones','']) !!}
          </div>
        </div>
      </div>
    </div> 
    <div class="box-footer" align="right">                
      <a class="btn btn-danger" data-toggle="modal" data-target="#descargar">
        Descargar
      </a>
      <a href="{{route('activofijo')}}" class="btn btn-default">Cancelar</a>
    </div>
    <div class="modal fade" id="descargar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header danger">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">CONFIRMAR DESCARGA</h4>
        </div>
        <div class="modal-body">
          <p>¿Esta seguro, desea descargar el activo fijo {{$activo->v_codigoactivo}}?</p>
        </div>
        <div class="modal-footer">
            <input type="submit" value="Descargar" class="btn btn-sm btn-danger delete-btn">
            <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->
</div>
@endsection