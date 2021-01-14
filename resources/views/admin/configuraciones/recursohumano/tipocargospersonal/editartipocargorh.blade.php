@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Recurso Humano')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>EDITAR TIPO CARGO</Strong></h3>
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
    {!! Form::open(['route'=>['actualizartipocargorh', $cargo->id], 'method'=>'PUT','class'=>'form-horizontal']) !!}
    <div class="form-group">                                           
      {!! Form::label('lbid', 'Código',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('txtid',$cargo->id,['class'=>'form-control pull-right','placeholder'=>'Código','disabled','required']) !!}
      </div>
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbtipocargo', 'Tipo cargo',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('v_descripcion',$cargo->v_descripcion,['class'=>'form-control pull-right','placeholder'=>'Cargo','required']) !!}
      </div>
    </div>
  </div>
  <div class="box-footer" align="right">                
    {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
    <a href="{{route('listatipocargorh')}}" class="btn btn-default">Cancelar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->
</div>
@endsection