@extends('admin.menuprincipal')
@section('tittle', 'Recurso Humano')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>Establecer Horario Empleado: {{$empleado->v_numeroexp .' | '. $empleado->v_nombres .' '. $empleado->v_apellidos}}</Strong></h3>
  </div>
  <!-- /.box-header -->
  @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <!-- form start -->
  <div class="box-body">
    {!! Form::open(['route'=>['actualizarhorario',$empleado->id], 'method'=>'PUT','class'=>'form-horizontal']) !!}
    {!! Form::hidden('empleado',$empleado->v_nombres .' '. $empleado->v_apellidos) !!}
    <div class="form-group">
      {!! Form::label("lbhoraE","Hora Entrada 1",["class"=>"col-sm-4 control-label","style"=>"padding-right:40px"]) !!}
      {!! Form::label("lbhoraS","Hora Salida 1",["class"=>"col-sm-2 control-label","style"=>"text-align:center"]) !!}
      {!! Form::label("lbhoraE2","Hora Entrada 2",["class"=>"col-sm-2 control-label","style"=>"text-align:center"]) !!}
      {!! Form::label("lbhoraS2","Hora Salida 2",["class"=>"col-sm-2 control-label","style"=>"text-align:center"]) !!}
    </div>
    <div class="form-group">
      <div id="timepair" class="timepair">
      {!! Form::label('lb', 'Lunes',['class'=>'col-sm-2 control-label']) !!} 
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLE" value="{{$horarios[0]->entrada1}}" autocomplete="off" class="form-control time start" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLS" value="{{$horarios[0]->salida1}}" autocomplete="off" class="form-control time end" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
    </div>
    <div id="timepair2" class="timepair">
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLE2" value="{{$horarios[0]->entrada2}}" autocomplete="off" class="form-control time start" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLS2" value="{{$horarios[0]->salida2}}" autocomplete="off" class="form-control time end" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    </div>
    <div class="form-group">
      <div id="timepair3" class="timepair">
      {!! Form::label('lb', 'Martes',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraME" value="{{$horarios[1]->entrada1}}" autocomplete="off" class="form-control time start" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMS" value="{{$horarios[1]->salida1}}" autocomplete="off" class="form-control time end" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div>
      <div id="timepair4" class="timepair">
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraME2" value="{{$horarios[1]->entrada2}}" autocomplete="off" class="form-control time start" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMS2" value="{{$horarios[1]->salida2}}" autocomplete="off" class="form-control time end" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div> 
    </div>
    <div class="form-group">
      <div id="timepair5" class="timepair">
      {!! Form::label('lb', 'Miercoles',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMiE" value="{{$horarios[2]->entrada1}}" autocomplete="off" class="form-control time start" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMiS" value="{{$horarios[2]->salida1}}" autocomplete="off" class="form-control time end" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div>
      <div id="timepair6" class="timepair">
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMiE2" value="{{$horarios[2]->entrada2}}" autocomplete="off" class="form-control time start" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMiS2" value="{{$horarios[2]->salida2}}" autocomplete="off" class="form-control time end" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    </div>
    <div class="form-group">
      <div id="timepair7" class="timepair">
      {!! Form::label('lb', 'Jueves',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraJE" value="{{$horarios[3]->entrada1}}" autocomplete="off" class="form-control time start" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraJS" value="{{$horarios[3]->salida1}}" autocomplete="off" class="form-control time end" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div>
      <div id="timepair8" class="timepair">
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraJE2" value="{{$horarios[3]->entrada2}}" autocomplete="off" class="form-control time start" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraJS2" value="{{$horarios[3]->salida2}}" autocomplete="off" class="form-control time end" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    </div>
    <div class="form-group">
      <div id="timepair9" class="timepair">
      {!! Form::label('lb', 'Viernes',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraVE" value="{{$horarios[4]->entrada1}}" autocomplete="off" class="form-control time start" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraVS" value="{{$horarios[4]->salida1}}" autocomplete="off" class="form-control time end" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div>
      <div id="timepair10" class="timepair">
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraVE2" value="{{$horarios[4]->entrada2}}" autocomplete="off" class="form-control time start" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraVS2" value="{{$horarios[4]->salida2}}" autocomplete="off" class="form-control time end" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    </div>
    <div class="form-group">
      <div id="timepair11" class="timepair">
      {!! Form::label('lb', 'Sabado',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraSE" value="{{$horarios[5]->entrada1}}" autocomplete="off" class="form-control time start" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraSS" value="{{$horarios[5]->salida1}}" autocomplete="off" class="form-control time end" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div>
      <div id="timepair12" class="timepair">
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraSE2" value="{{$horarios[5]->entrada2}}" autocomplete="off" class="form-control time start" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraSS2" value="{{$horarios[5]->salida2}}" autocomplete="off" class="form-control time end" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div> 
    </div>
    <div class="form-group">
      <div id="timepair13" class="timepair">
      {!! Form::label('lb', 'Domingo',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraDE" value="{{$horarios[6]->entrada1}}" autocomplete="off" class="form-control time start" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraDS" value="{{$horarios[6]->salida1}}" autocomplete="off" class="form-control time end" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div>
      <div id="timepair14" class="timepair">
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraDE2" value="{{$horarios[6]->entrada2}}" autocomplete="off" class="form-control time start" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraDS2" value="{{$horarios[6]->salida2}}" autocomplete="off" class="form-control time end" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div>
    </div>  
  </div>
  <div class="box-footer" align="right">                
    {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
    <a href="{{route('listaempleados')}}" class="btn btn-default">Cancelar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->   
</div>
@endsection
@section('script')
<script>
  $('.timepair .time').timepicker({
    'showDuration': true,
    'timeFormat': 'g:i A',
    'step': 10,
    'maxTime':'11:30 PM',
    'minTime':'5:00 AM'
});

var timeOnlyExampleEl = document.getElementById('timepair');
var timeOnlyDatepair = new Datepair(timeOnlyExampleEl);
var timeOnlyExampleEl2 = document.getElementById('timepair2');
var timeOnlyDatepair2 = new Datepair(timeOnlyExampleEl2);
var timeOnlyExampleEl3 = document.getElementById('timepair3');
var timeOnlyDatepair3 = new Datepair(timeOnlyExampleEl3);
var timeOnlyExampleEl4 = document.getElementById('timepair4');
var timeOnlyDatepair4 = new Datepair(timeOnlyExampleEl4);
var timeOnlyExampleEl5 = document.getElementById('timepair5');
var timeOnlyDatepair5 = new Datepair(timeOnlyExampleEl5);
var timeOnlyExampleEl6 = document.getElementById('timepair6');
var timeOnlyDatepair6 = new Datepair(timeOnlyExampleEl6);
var timeOnlyExampleEl7 = document.getElementById('timepair7');
var timeOnlyDatepair7 = new Datepair(timeOnlyExampleEl7);
var timeOnlyExampleEl8 = document.getElementById('timepair8');
var timeOnlyDatepair8 = new Datepair(timeOnlyExampleEl8);
var timeOnlyExampleEl9 = document.getElementById('timepair9');
var timeOnlyDatepair9 = new Datepair(timeOnlyExampleEl9);
var timeOnlyExampleEl10 = document.getElementById('timepair10');
var timeOnlyDatepair10 = new Datepair(timeOnlyExampleEl10);
var timeOnlyExampleEl11 = document.getElementById('timepair11');
var timeOnlyDatepair11 = new Datepair(timeOnlyExampleEl11);
var timeOnlyExampleEl12 = document.getElementById('timepair12');
var timeOnlyDatepair12 = new Datepair(timeOnlyExampleEl12);
var timeOnlyExampleEl13 = document.getElementById('timepair13');
var timeOnlyDatepair13 = new Datepair(timeOnlyExampleEl13);
var timeOnlyExampleEl14 = document.getElementById('timepair14');
var timeOnlyDatepair14 = new Datepair(timeOnlyExampleEl14);
</script>
@endsection