@extends('admin.menuprincipal')
@section('tittle', 'Expediente Académico/Faltas')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>EXPEDIENTE ESTUDIANTIL / REGISTRO DE FALTAS</Strong></h3>
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
    {!! Form::open(['route'=>'storefaltaestudiante_docentes', 'method'=>'POST','class'=>'form-horizontal']) !!}
       
     <input type="hidden" value="{{$estudiante->id}}" name="estudiante_id"> 
 <input type="hidden" value="{{$idseccion}}" name="seccion_id">

        <div class="form-group"> 
          {!! Form::label('lbcod', 'NIE ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('v_nie',$estudiante->nie,['class'=>'form-control pull-right','id'=>'id_codigo','placeholder'=>'Sin Asignar','readonly']) !!}
          </div> 
        </div>
     
        <div class="form-group">                 
          {!! Form::label('lbdesc', 'Estudiante *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('v_nombre',$estudiante->v_nombres.' '. $estudiante->v_apellidos,['class'=>'form-control pull-right','placeholder'=>' Nombre del estudiante','readonly']) !!}
          </div>
</div><!--fin form group-->

<div class="form-group">                                        
               {!! Form::label('lblfec', 'Fecha *',['class'=>'col-sm-4 control-label']) !!}


                              <div class="col-sm-4">

                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" value="{{$fecha}}" name="fecha" id="fecha"  class="form-control pull-right nac" data-mask required="true" class="form-control pull-right" required="true" readonly="true">
                                </div>
                                </div>
               
 </div>
          <div class="form-group">
                {!! Form::label('rubro', 'Tipo falta *',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('tipo_falta',['Menos grave'=>'Menos grave','grave'=>'Grave','Muy grave'=>'Muy grave'],null,['class'=>'form-control'])!!}
                </div>
            </div>

      
        <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Descripción *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::textarea('descripcion_falta',null,['class'=>'form-control pull-right','required']) !!}
          </div>
        </div>
    
    <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Sanciones aplicadas *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::textarea('sanciones_aplicadas',null,['class'=>'form-control pull-right','required']) !!}
          </div>
        </div>
       
      </div>
  
    <div class="box-footer" align="right">                
      {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
      <a href="{{route('expedientecompleto_modulodocente',[$estudiante->id,$idseccion])}}" class="btn btn-default">Finalizar</a>
    </div>
  {!! Form::close() !!}
</div>
@endsection
