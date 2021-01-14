@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Períodos')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ACTUALIZAR PERIODO DE EVALUACION</Strong></h3>
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
              {!! Form::open(['route'=>['actualizarperiodoevaluacion',$datos->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
              
             <div class="form-group">                                           
             {!! Form::label('nombre', 'Nombre *',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                {!! Form::text('nombre',$datos->nombre,['class'=>'form-control pull-right','placeholder'=>'Nombre del período','required','readonly'=>'true']) !!}
                </div>
              </div>
                <div class="form-group">
                {!! Form::label('descripcion', 'Descripción *',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                {!! Form::text('descripcion',$datos->descripcion,['class'=>'form-control pull-right','placeholder'=>'Descripción del período','required','readonly'=>'true']) !!}
                </div>
              </div>

              <div class="form-group">
                 {!! Form::label('periodo', 'Duración *',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="periodo" value="{{ $periodo }}" class="form-control pull-right rangoPeriodo"  required="true" id="reservation">
                </div>
              </div>
            </div>
              <div class="form-group">
               {!! Form::label('', 'Ciclo  académico *',['class'=>'col-sm-4 control-label']) !!}
                          <div class="col-sm-5">
                 {!! Form::select('periodo_id',$ciclos,null,['class'=>'form-control'])!!}
              </div> 
          </div> 

          <div class="form-group">
          {!! Form::label('lb', 'Estatus',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
         {!! Form::label('lbactivo', 'Activo',['class'=>'col- control-label']) !!}
          <input type="radio" name="estado" class="flat-red" value="1" <?php if($datos->estado=="1"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lbinactivo', 'Inactivo',['class'=>'control-label']) !!}
          <input type="radio" name="estado" class="flat-red" value="0" <?php if($datos->estado=="0"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>
      
                </div>       
          <div class="box-footer" align="right">                
          {!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
          <a href="{{route('listaperiodosdeevaluacion')}}" class="btn btn-default">Cancelar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection
