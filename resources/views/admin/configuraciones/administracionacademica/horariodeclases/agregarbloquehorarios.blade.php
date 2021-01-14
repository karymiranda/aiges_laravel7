@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Horario de Clases/Registrar Bloque')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>REGISTRAR BLOQUE</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
       
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
                  {!! Form::open(['route'=>'guardarbloquehorarios', 'method'=>'POST', 'class'=>'form-horizontal']) !!}


                 <div class="form-group">                                           
                                                {!! Form::label('C', 'Correlativo',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('correlativo_clase',$correlativo,['class'=>'form-control pull-right','placeholder'=>'Correlativo bloque','required']) !!}
                                                </div>
                 </div>
                 <div class="form-group">                
                                                {!! Form::label('Tipo bloque', 'Tipo bloque',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::select('tipo_bloque',['Clase'=>'Clase','Receso'=>'Receso'],null,['class'=>'form-control','required'])!!}
                                                </div>
                </div>

        <div class="form-group">
          <div id="timepair"> 
      {!! Form::label('lb', 'Hora inicio',['class'=>'col-sm-4 control-label']) !!} 
        <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="hora_inicio"  autocomplete="off" class="form-control time start" placeholder="Hora inicio" required="true" id="hora_inicio">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
   
    
       {!! Form::label('lb', 'Hora fin',['class'=>'col-sm-1 control-label']) !!} 
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="hora_fin"  autocomplete="off" class="form-control time end" placeholder="Hora fin" required="true" id="hora_fin">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>  
      </div>      
  </div>           
                                           
          </div>        
         <div class="box-footer" align="right">                
        {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
         <a href="{{route('listabloquehorarios')}}" class="btn btn-default">Cancelar</a>
        </div>

        {!! Form::close() !!}
              <!-- /.box-footer -->           
          </div>
@endsection
@section('script')
<script >   
 $('#timepair .time').timepicker({
    'showDuration': false,
    'timeFormat': 'g:i A',
    'step': 10,
    'maxTime':'11:30 PM',
    'minTime':'5:00 AM'
});

var timeOnlyExampleEl = document.getElementById('timepair');
var timeOnlyDatepair = new Datepair(timeOnlyExampleEl);
</script>
@endsection