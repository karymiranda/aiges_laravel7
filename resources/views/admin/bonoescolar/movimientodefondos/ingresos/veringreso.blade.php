 @extends('admin.menuprincipal')
@section('tittle', 'Bono escolar/Transacciones')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>VER DETALLE INGRESO</Strong></h3>
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
              {!! Form::open(['route'=>'historialtransacciones', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
          <input type="hidden" name="idejercicio" id="idejercicio" value="{{$ingreso->fondodisponible_id}}">

                <div class="form-group">
                 {!! Form::label('fecha', 'Fecha ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="fecha_transaccion" value="{{$ingreso->fecha_transaccion }}" class="form-control pull-right nac"  required="true" readonly="true">
                </div>
              </div>
               </div>
      <div class="form-group">
      {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
       <div class="col-sm-4">
        <label><input type="checkbox" name="opyfuncionamientoSN" value="" <?php if($ingreso->opyfuncionamientoSN=="SI"){?>checked=""<?php }?>>Operación y funcionamiento</label>           
       </div> 
      </div>


                <div class="form-group">
              {!! Form::label('nombre', 'Monto',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="ingreso" value="{{$ingreso->ingreso}}" class="form-control" required="true" readonly="true">
                          </div>
                  </div>
          </div> 

              
             <div class="form-group">                                           
             {!! Form::label('nombre', 'En concepto de',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('concepto',$ingreso->concepto,['class'=>'form-control pull-right','placeholder'=>'En concepto de ','required','readonly']) !!}
                </div>
              </div>                 
                </div>       
          <div class="box-footer" align="right">               
          <a href="{{route('historialtransacciones')}}" class="btn btn-primary">Regresar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection
