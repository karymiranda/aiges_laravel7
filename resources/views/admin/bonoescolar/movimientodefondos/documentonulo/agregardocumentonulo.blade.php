@extends('admin.menuprincipal')
@section('tittle', 'Bono escolar/Transacciones/Cheques anulados')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>REGISTRAR CHEQUE NULO</Strong></h3>
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
              {!! Form::open(['route'=>'guardardocumentonulo', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
               <input type="hidden" name="idejercicio" id="idejercicio" value="{{$idejercicio}}">
               <input type="hidden" name="opyfuncionamientoSN" value="{{$transaccionbono}}">

                <div class="form-group">
              {!! Form::label('fecha', 'Fecha de cheque ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="fecha_transaccion" value="{{$fecha}}" class="form-control pull-right nac"  required="true">
                </div>
              </div>
            </div>
            <div class="form-group">
                  {!! Form::label('nombre', 'Cheque #',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('numero_cheque',null,['class'=>'form-control pull-right','placeholder'=>'Número de cheque','required']) !!}
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
