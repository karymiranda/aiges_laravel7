@extends('admin.menuprincipal')
@section('tittle', 'Recurso Humano')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>Horario Empleado: {{$empleado->v_numeroexp .' | '. $empleado->v_nombres .' '. $empleado->v_apellidos}}</Strong></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    {!! Form::open(['class'=>'form-horizontal']) !!}
    <div class="form-group">
      {!! Form::label("lbhoraE","Hora Entrada 1",["class"=>"col-sm-4 control-label","style"=>"padding-right:40px"]) !!}
      {!! Form::label("lbhoraS","Hora Salida 1",["class"=>"col-sm-2 control-label","style"=>"text-align:center"]) !!}
      {!! Form::label("lbhoraE2","Hora Entrada 2",["class"=>"col-sm-2 control-label","style"=>"text-align:center"]) !!}
      {!! Form::label("lbhoraS2","Hora Salida 2",["class"=>"col-sm-2 control-label","style"=>"text-align:center"]) !!}
    </div>
    <div class="form-group">
      {!! Form::label('lb', 'Lunes',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLE" value="{{$horarios[0]->entrada1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLS" value="{{$horarios[0]->salida1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLE2" value="{{$horarios[0]->entrada2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLS2" value="{{$horarios[0]->salida2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    <div class="form-group">
      {!! Form::label('lb', 'Martes',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraME" value="{{$horarios[1]->entrada1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMS" value="{{$horarios[1]->salida1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraME2" value="{{$horarios[1]->entrada2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMS2" value="{{$horarios[1]->salida2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    <div class="form-group">
      {!! Form::label('lb', 'Miercoles',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMiE" value="{{$horarios[2]->entrada1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMiS" value="{{$horarios[2]->salida1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMiE2" value="{{$horarios[2]->entrada2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraMiS2" value="{{$horarios[2]->salida2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    <div class="form-group">
      {!! Form::label('lb', 'Jueves',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraJE" value="{{$horarios[3]->entrada1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraJS" value="{{$horarios[3]->salida1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraJE2" value="{{$horarios[3]->entrada2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraJS2" value="{{$horarios[3]->salida2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    <div class="form-group">
      {!! Form::label('lb', 'Viernes',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraVE" value="{{$horarios[4]->entrada1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraVS" value="{{$horarios[4]->salida1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraVE2" value="{{$horarios[4]->entrada2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraVS2" value="{{$horarios[4]->salida2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    <div class="form-group">
      {!! Form::label('lb', 'Sabado',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraSE" value="{{$horarios[5]->entrada1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraSS" value="{{$horarios[5]->salida1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraSE2" value="{{$horarios[5]->entrada2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraSS2" value="{{$horarios[5]->salida2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>
    <div class="form-group">
      {!! Form::label('lb', 'Domingo',['class'=>'col-sm-2 control-label']) !!}    
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraDE" value="{{$horarios[6]->entrada1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraDS" value="{{$horarios[6]->salida1}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 1">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraDE2" value="{{$horarios[6]->entrada2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Entrada 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraDS2" value="{{$horarios[6]->salida2}}" autocomplete="off" class="form-control" readonly="true" placeholder="Salida 2">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div> 
    </div>  
  </div>
  <div class="box-footer" align="right">                
    <a href="{{route('listaempleados')}}" class="btn btn-primary"><< Regresar</a>
  </div>
  <!-- /.box-footer -->  
  {!! Form::close() !!} 
</div>
@endsection