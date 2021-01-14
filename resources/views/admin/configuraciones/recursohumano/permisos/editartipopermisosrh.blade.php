@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Recurso Humano')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>EDITAR TIPO PERMISO</Strong></h3>
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
  <div class="box-body">
    {!! Form::open(['route'=>['actualizartipopermisosrh', $tipo->id], 'method'=>'PUT','class'=>'form-horizontal']) !!}
    <div class="form-group">                                           
      {!! Form::label('lbid', 'Código',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('txtid',$tipo->id,['class'=>'form-control pull-right','placeholder'=>'Código','disabled','required']) !!}
      </div>
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbtipopermiso', 'Tipo permiso',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('v_descripcion',$tipo->v_descripcion,['class'=>'form-control pull-right','placeholder'=>'Tipo permiso','required']) !!}
        {!! Form::hidden('estado','1') !!}
      </div>      
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbmaxanual', 'Máximo Anual',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('i_maxpermisosanual',$tipo->i_maxpermisosanual,['class'=>'form-control pull-right','placeholder'=>'Máximo de Permisos','required']) !!}
      </div> 
              </div> 
 <div class="form-group">                                  
      {!! Form::label('lbduracion', 'Duración Máxima (Días)',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('i_duracionmax',$tipo->i_duracionmax,['class'=>'form-control pull-right','placeholder'=>'Duración Máxima','required']) !!}
      </div>                                              
    </div>                                              
  </div>
  <!-- form start -->
  <div class="box-footer" align="right">                
    {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
    <a href="{{route('listatipopermisosrh')}}" class="btn btn-default">Cancelar</a>
  </div>
{!! Form::close() !!}
<!-- /.box-footer -->
</div>
@endsection