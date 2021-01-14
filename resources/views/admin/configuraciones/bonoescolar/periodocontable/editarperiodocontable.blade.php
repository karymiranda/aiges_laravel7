@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Bono Escolar')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ACTUALIZAR PERIODO CONTABLE</Strong></h3>
            </div>         
            
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
              {!! Form::open(['route'=>['actualizarperiodocontable',$ciclos->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
              
             <div class="form-group">                                           
             {!! Form::label('descripcion', 'Nombre',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                {!! Form::text('nombre',$ciclos->nombre,['class'=>'form-control pull-right','placeholder'=>'Nombre del ciclo académico','required']) !!}
                </div>
              </div>

              <div class="form-group">
              	 {!! Form::label('periodo', 'Año ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                {!! Form::select('anio',$periodos, $ciclos->anio,['class'=>'form-control','id'=>'anio'])!!}
              </div>
          </div> 

           
                </div>       
          <div class="box-footer" align="right">                
          {!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
          <a href="{{route('ciclosacademicos')}}" class="btn btn-default">Cancelar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection
