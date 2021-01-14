@extends('admin.menuprincipal')
@section('tittle', 'Bono escolar/Transacciones')
@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-6">
              <h3 class="box-title"><Strong>REGISTRAR GASTO</Strong></h3>
            </div>
            <div class="col-sm-6" align="right">
              <h2 class="box-title"> <span class="label label-success">Saldo disponible ${{$saldodisponible}} 
              </span></h2>
            </div>  
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
              {!! Form::open(['route'=>'guardargastos', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
               <input type="hidden" name="idejercicio" id="idejercicio" value="{{$idejercicio}}">
               <input type="hidden" name="opyfuncionamientoSN" value="{{$transaccionbono}}">

                <div class="form-group">
                {!! Form::label('nombre', 'Cheque #',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('numero_cheque',null,['class'=>'form-control pull-right','placeholder'=>'Número de cheque','required']) !!}
                </div>
                 </div> 
              
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
             {!! Form::label('nombre', 'En concepto de',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('concepto',null,['class'=>'form-control pull-right','placeholder'=>'En concepto de','required']) !!}
                </div>
                 </div> 
              
             <div class="form-group">
                {!! Form::label('nombre', 'A favor de',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('a_favor_de',null,['class'=>'form-control pull-right','placeholder'=>'A favor de','required']) !!}
                </div>
              </div>

               <?php if($transaccionbono!=null){ ?>
              <div class="form-group">
              	{!! Form::label('rubro', 'Rubro',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('rubro_id',$rubros, null,['class'=>'form-control'])!!}
                </div>
              </div> 
              <?php } ?>
              
             <div class="form-group">
                {!! Form::label('descripcion', 'Monto',['class'=>'col-sm-4 control-label']) !!}
                  <div class="col-sm-4">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" required pattern="[0-9]+" step="any"  name="gasto" min="1" max="{{$saldodisponible}}" value="{{ old('gasto') }}" class="form-control">
                          </div>
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
