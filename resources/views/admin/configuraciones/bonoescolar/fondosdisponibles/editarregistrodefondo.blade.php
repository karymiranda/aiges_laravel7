@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Bono escolar/Fondos')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>EDITAR FONDO</Strong></h3>
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
              {!! Form::open(['route'=>'actualizarregistrodefondo', 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
              <input type="hidden" name="id" id="id" value="{{$datos->id}}">
                             
             <div class="form-group">                                           
             {!! Form::label('nombre', 'Número de cuenta',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                <input type="text" name="numero_cuenta" value="{{$datos->numero_cuenta}}" class="form-control" data-inputmask='"mask": "999999999999","clearIncomplete":"true"' data-mask required="true" placeholder="Número de cuenta">
                </div>
              </div> 
              <div class="form-group">                                           
             {!! Form::label('nombre', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('descripcion',$datos->descripcion,['class'=>'form-control pull-right','placeholder'=>'Descripción','required']) !!}
                </div>
              </div> 
              <div class="form-group">                                           
             {!! Form::label('nombre', 'Monto',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" name="monto_disponible" value="{{$datos->monto_disponible}}" required pattern="[0-9]+" step="any"  class="form-control" required="true">
                          </div>
                </div>
              </div>            

      
                </div>       
          <div class="box-footer" align="right">                
          {!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
          <a href="{{route('listadepositodefondos')}}" class="btn btn-default">Cancelar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection
