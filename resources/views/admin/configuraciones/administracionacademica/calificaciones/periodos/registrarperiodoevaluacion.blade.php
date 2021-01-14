@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Períodos')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header ">
              <h3 class="box-title"><Strong>REGISTRAR PERIODO DE EVALUACION</Strong></h3>
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
              {!! Form::open(['route'=>'guardarperiodoevaluacion', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
              
             <div class="form-group">                                           
             {!! Form::label('nombre', 'Nombre *',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                {!! Form::select('nombre',['P1'=>'P1','P2'=>'P2','P3'=>'P3'],null,['class'=>'form-control','placeholder'=>'Seleccione'])!!}


                </div>
              </div>
                <div class="form-group">
                {!! Form::label('descripcion', 'Descripción *',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                {!! Form::text('descripcion',null,['class'=>'form-control pull-right','placeholder'=>'Descripción del período','required','readonly'=>'true']) !!}
                </div>
              </div>

              <div class="form-group">
                 {!! Form::label('periodo', 'Duración *',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="periodo" value="{{ old('periodo') }}" class="form-control pull-right rangoPeriodo"  required="true" id="reservation">
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
          {!! Form::label('genero', 'Estatus ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::label('lbactivo', 'Activo',['class'=>'col- control-label']) !!}
          {!! Form::radio('estado','1',true, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('lbinactivo', 'Inactivo',['class'=>'control-label']) !!}
          {!! Form::radio('estado','0',false, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
          </div>
          </div>       
          <div class="box-footer" align="right">                
          {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
          <a href="{{route('listaperiodosdeevaluacion')}}" class="btn btn-default">Cancelar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection
@section ('script')
<script type="text/javascript">
  $('#nombre').on('change',function(e){
var op=$('#nombre option:selected').val();
switch (op)
{
case 'P1':
$('#descripcion').val('PRIMER PERIODO');
break;

case 'P2':
$('#descripcion').val('SEGUNDO PERIODO');
break;

case 'P3':
$('#descripcion').val('TERCER PERIODO');
break;
}

  });
</script>
@endsection
