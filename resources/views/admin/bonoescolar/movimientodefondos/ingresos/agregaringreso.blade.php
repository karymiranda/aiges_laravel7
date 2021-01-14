@extends('admin.menuprincipal')
@section('tittle', 'Bono escolar/Transacciones')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>REGISTRAR INGRESO</Strong></h3>
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
              {!! Form::open(['route'=>'guardaringresos', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
          <input type="hidden" name="idejercicio" id="idejercicio" value="{{$idejercicio}}">
          <input type="hidden" name="opyfuncionamientoSN" value="{{$transaccionbono}}">

                <div class="form-group">
                 {!! Form::label('fecha', 'Fecha ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="fecha_transaccion" value="{{$fecha }}" class="form-control pull-right nac"  required="true">
                </div>
              </div>
               </div>


                <div class="form-group">
              {!! Form::label('nombre', 'Monto',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="ingreso" value="{{ old('ingreso') }}" class="form-control" required="true">
                          </div>
                  </div>
          </div> 

              
             <div class="form-group">                                           
             {!! Form::label('nombre', 'En concepto de',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('concepto',null,['class'=>'form-control pull-right','placeholder'=>'En concepto de ','required']) !!}
                </div>
              </div>          

      
                </div>       
          <div class="box-footer" align="right">                
          {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
          <a href="{{route('historialtransacciones')}}" class="btn btn-default">Cancelar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection

@section('script')
<script>
    $('#checkOP').on('click', function(){

    });
  </script>
@endsection
