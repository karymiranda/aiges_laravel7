@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Inscripción en Línea')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header ">
              <h3 class="box-title"><Strong>HABILITAR PERIODO DE INSCRIPCION EN LINEA</Strong></h3>
            </div>
          
            
              <div class="box-body">
              {!! Form::open(['route'=>'guardarperiodoinscripcion', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
              
              <div class="form-group">                                           
             {!! Form::label('descripcion', 'Año',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('anio',$anios,null,['class'=>'form-control pull-right','required']) !!}
                </div>
              </div>

             <div class="form-group">                                           
             {!! Form::label('descripcion', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                {!! Form::text('v_descripcion',null,['class'=>'form-control pull-right','placeholder'=>'Descripción periodo','required']) !!}
                </div>
              </div>

              <div class="form-group">
              	 {!! Form::label('periodo', 'Periodo ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="periodo" class="form-control pull-right rango"  required="true" id="reservation">
                </div>
              </div>
          </div> 

          <div class="form-group">
             {!! Form::label('tipoperiodo', 'Tipo periodo',['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-5">
              {!! Form::select('tipo_periodo',['MATRICULA GENERAL'=>'MATRICULA GENERAL','CURSO TEMPORAL'=>'CURSO TEMPORAL'], null,['class'=>'form-control'])!!}
              </div>          
         </div>

          </div>       
          <div class="box-footer" align="right">                
          {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
          <a href="{{route('periododeinscripcionenlinea')}}" class="btn btn-default">Cancelar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection
