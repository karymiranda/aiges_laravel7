@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Asistencia')
@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">ASISTENCIAS RECURSO HUMANO</label></h2>
    </div>
        <div class="col-sm-12" align="right">            
        <a href="{{ route('tomarasistenciarh') }}"  class="btn btn-primary">Tomar Asistencia</a>
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
    </div> 
           
    <div class="box-body">
      {!! Form::open(['route'=>'consultalistadoasistenciarh','class'=>'form-horizontal','method'=>'POST','name'=>'myform']) !!}
      <div class="form-group">
      <label class="col-sm-5 control-label">Buscar Fecha</label>
      <div class="col-sm-3">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" value="{{$hoy}}" name="f_asistencia" id="f_asistencia" class="form-control pull-right rangoPast" readonly="true">
        </div> 
      </div> 
      </div>
      {!! Form::close() !!}

      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>No</th>
          <th>EMPLEADO</th>
          <?php for($i=0;$i<$f;$i++){ ?> 
          <th>{{ $empleado[0][$i][1] }}</th>
          <?php } ?>
        </thead>
        <tbody> 
          <?php for($i=0;$i<$n;$i++){ ?> 
            <tr>
            <td>{{ $i+1}}</td>             
              <td>{{ $empleado[$i][0][0] }}</td> 
          <?php for($e=0;$e<$f;$e++){ ?>     
              <td>
                <?php if($empleado[$i][$e][2]=='Permiso'){ ?>
                <span class="label label-info">Permiso</span>
                <?php }else{ if($empleado[$i][$e][2]=='Asistencia'){ ?>
                <span class="label label-success">Asistencia</span>
                <?php }else{ if($empleado[$i][$e][2]=='Ausencia'){ ?>
                <span class="label label-danger">Ausencia</span>
                <?php }else{ ?>
                <span class="label label-default">Sin Registro</span>
                <?php }}} ?> 
              </td>            
          <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body-->   
    <div class="box-footer" align="right">                
    <a href="{{route('listaexpedientesrh')}}" class="btn btn-default">Regresar</a>
  </div>
  </div>
@endsection