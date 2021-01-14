@extends('admin.menuprincipal')
@section('tittle', 'Administración activo fijo/Traslados')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>AGREGAR RETORNO</Strong></h3>
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
    {!! Form::open(['route'=>'guardarretorno', 'method'=>'POST','class'=>'form-horizontal']) !!}
    {!! Form::hidden('traslado_id',$traslado->id) !!}
     
        <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha Retorno',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('fecha',null,['class'=>'form-control pull-right nac','data-mask'=>'','placeholder'=>'Fecha de retorno','required']) !!}
            </div> 
          </div> 
        </div><!--fin form group-->
     
        <div class="form-group">                                           
          {!! Form::label('lbretorna', 'Retorna',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtretorna',$traslado->destino->codigo_institucion .' '. $traslado->destino->nombre_institucion,['class'=>'form-control pull-right','placeholder'=>'Retorna el Activo','readonly','id'=>'destino']) !!}
          </div>
          </div>
      
        <div class="form-group"> 
          {!! Form::label('fecha', 'Fecha Traslado',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechatraslado',$traslado->f_fechatraslado,['class'=>'form-control pull-right','placeholder'=>'Fecha de traslado','readonly']) !!}
            </div> 
          </div>                                                                  
        </div>
    
        <div class="form-group">                                           
          {!! Form::label('lbcodigo', 'Código',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtcodigo',$traslado->activofijo->v_codigoactivo,['class'=>'form-control pull-right','placeholder'=>'Código activo','readonly','id'=>'codigo']) !!}
          </div>
          </div>
      
        <div class="form-group"> 
          {!! Form::label('lbdescrip', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtdescrip',$traslado->activofijo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción','readonly','id'=>'descripcion']) !!}
          </div>
        </div>
     
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
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbpautoriza', 'Autoriza',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('persona_autoriza',null,['class'=>'form-control pull-right','placeholder'=>'Persona que autoriza traslado','required']) !!}
          </div>
          </div>
      
        <div class="form-group"> 
          {!! Form::label('lbrecibe', 'Recibe',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('persona_recibe',null,['class'=>'form-control pull-right','placeholder'=>'Persona que recibe','required']) !!}
          </div>
        </div>
      
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('observaciones',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones']) !!}
          </div>
        </div>
      </div>                                                       
     
      <div class="box-footer" align="right">                
        {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
        <a href="{{route('listatraslado')}}" class="btn btn-default">Cancelar</a>
      </div>
    {!! Form::close() !!}
    <!-- /.box-footer -->
</div>
@endsection