@extends('admin.menuprincipal')
@section('tittle', 'Administración activo fijo/Ver traslado')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>VER DETALLE TRASLADO</Strong></h3>
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
    {!! Form::open(['route'=>null, 'method'=>null,'class'=>'form-horizontal']) !!}
     
        <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechatraslado',$traslado->f_fechatraslado,['class'=>'form-control pull-right', 'placeholder'=>'Fecha de traslado','readonly']) !!}
            </div> 
          </div> 
            </div><!--fin form group-->
      
        <div class="form-group">
          {!! Form::label('lbtipoTRASLADO', 'Motivo de traslado',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('tipotraslado_id',$tipotraslado, $traslado->tipotraslado_id,['class'=>'form-control','disabled'])!!}
          </div> 
        </div><!--fin form group-->
      
        <div class="form-group">                                           
          {!! Form::label('lborigen', 'Origen',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtorigen',$traslado->procedencia->v_codigoinfraestructura .' - '.$traslado->procedencia->v_nombrecentro,['class'=>'form-control pull-right','placeholder'=>'Origen del activo','readonly']) !!}
          </div>
            </div><!--fin form group-->
      
        <div class="form-group">
          {!! Form::label('lbdestino', 'Destino',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtdestino',$traslado->destino->codigo_institucion .' '. $traslado->destino->nombre_institucion,['class'=>'form-control pull-right','placeholder'=>'Destino del activo','readonly','id'=>'destino']) !!}
          </div>                                                                 
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbcodigo', 'Código',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">            
            {!! Form::text('txtcodigo',$traslado->activofijo->v_codigoactivo,['class'=>'form-control pull-right','placeholder'=>'Código activo','readonly','id'=>'codigo']) !!}
          </div>
            </div><!--fin form group-->
      
        <div class="form-group">
          {!! Form::label('lbdescrip', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtdescrip',$traslado->activofijo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción','readonly','id'=>'descripcion']) !!}
          </div>
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbcondicion', 'Condición actual',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_condicionactivo',['Bueno'=>'Bueno','Malo'=>'Malo'], $traslado->activofijo->v_condicionactivo,['class'=>'form-control','disabled','id'=>'condicion'])!!}
          </div>
            </div><!--fin form group-->
      
        <div class="form-group">
          {!! Form::label('lbserie', 'Serie',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtserie',$traslado->activofijo->v_serie,['class'=>'form-control pull-right','placeholder'=>'Número de serie','readonly','id'=>'serie']) !!}
          </div>                                                                 
        </div>
    
        <div class="form-group">                                                               
          {!! Form::label('lbmodelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtmodelo',$traslado->activofijo->v_modelo,['class'=>'form-control pull-right','placeholder'=>'Modelo','readonly','id'=>'modelo']) !!}
          </div>
            </div><!--fin form group-->
      
        <div class="form-group">
          {!! Form::label('lbmarca', 'Marca',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtmarca',$traslado->activofijo->v_marca,['class'=>'form-control pull-right','placeholder'=>'Marca','readonly','id'=>'marca']) !!}
          </div>
        </div>
    
        <div class="form-group">                                           
          {!! Form::label('lbpautoriza', 'Autoriza',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_personaautoriza',$traslado->v_personaautoriza,['class'=>'form-control pull-right','placeholder'=>'Persona que autoriza traslado','readonly']) !!}
          </div>
            </div><!--fin form group-->
      
        <div class="form-group">
          {!! Form::label('lbrecibe', 'Recibe',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_personarecibe',$traslado->v_personarecibe,['class'=>'form-control pull-right','placeholder'=>'Persona que recibe','readonly']) !!}
          </div>
        </div>
     
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',$traslado->v_observaciones,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones','readonly']) !!}
          </div>
        </div>
      </div>                                                       
    
      <div class="box-footer" align="right">                
        <a href="{{route('listatraslado')}}" class="btn btn-primary"><< Regresar</a>
      </div>
    {!! Form::close() !!}
    <!-- /.box-footer -->
</div>
@endsection