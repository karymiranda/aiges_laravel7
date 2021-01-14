@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Turnos')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ACTUALIZAR TURNO</Strong></h3>
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
              {!! Form::open(['route'=>['actualizarturno',$turnos->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
              
             <div class="form-group">                                           
                                                {!! Form::label('turno', 'Turno',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('turno',$turnos->turno,['class'=>'form-control pull-right','placeholder'=>'Descripción de turno','required']) !!}
                                                </div>
                </div>

                <div class="form-group">                                           
                                {!! Form::label('horadesde', 'Inicio de turno',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" name="horadesde" class="form-control pull-right timepicker" placeholder="Hora inicio" required="true" value="{{$turnos->horadesde}}">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                              </div>
                               </div>
                  <div class="form-group"> 
                                                          
                              {!! Form::label('horahasta', 'Fin de turno',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                 <div class="input-group">
                                <input type="text" name="horahasta" class="form-control pull-right timepicker" placeholder="Hora fin" required="true"  value="{{$turnos->horahasta}}">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                </div>                                                                         
          </div>
         
                
              <div class="box-footer" align="right">                
                 {!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
                  <a href="{{route('listaturnos')}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
            
          </div>





@endsection
