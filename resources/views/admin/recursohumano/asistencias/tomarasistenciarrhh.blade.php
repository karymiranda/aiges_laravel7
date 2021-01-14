@extends('admin.menuprincipal')
@section('tittle', 'Recurso Humano/ Registro de Asistencia')
@section('content')

<div class="box  box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>REGISTRO DE ASISTENCIA</Strong></h3>
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
    {!! Form::open(['class'=>'form-horizontal','id'=>'formulariorpt']) !!}
    <div class="form-group" align="center">                                         
      {!! Form::label('lbfecha', 'Fecha',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-3">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" id="fecha" name="fecha" value="{{ $hoy }}" class="form-control pull-right nac" required="true">

          </div>
        </div>


    </div>
    {!! Form::close() !!}
    <div>                                           
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>No</th>
          <th>EMPLEADO</th>
          <th>EXPEDIENTE</th> 
          <th>CARGO</th>
          <th>ASISTENCIA</th>                 
          <th>ACCIONES</th>
        </thead>
        <tbody>
          <?php for($i=0;$i<$n;$i++){ ?>
          <tr>   
            <td>{{ $i+1 }}</td>
            <td>{{ $empleado[$i][1] }}</td>      
            <td>{{ $empleado[$i][0] }}</td>
            <td>{{ $empleado[$i][2] }}</td>
            <td>
              <?php if($empleado[$i][3]=='Permiso'){ ?>
                <span class="label label-info">Permiso</span>
                </td>
                <td>
                  <a disabled='true' title="Asistencia" class="btn btn-success"><i class="fa fa-check"></i></a>
                  <a disabled='true' title="Ausencia" class="btn btn-danger"><i class="fa fa-close"></i></a>
              <?php }else{ if($empleado[$i][3]=='Asistencia'){ ?>
                <span class="label label-success">Asistencia</span>                    
                </td>
                <td>
                  <a disabled='true' title="Asistencia" class="btn btn-success"><i class="fa fa-check"></i></a>
                  <a disabled='true' title="Ausencia" class="btn btn-danger"><i class="fa fa-close"></i></a>
              <?php }else{ if($empleado[$i][3]=='Ausencia'){ ?>
                <span class="label label-danger">Ausencia</span>
                </td>
                <td>
                  <a disabled='true' title="Asistencia" class="btn btn-success"><i class="fa fa-check"></i></a>
                  <a disabled='true' title="Ausencia" class="btn btn-danger"><i class="fa fa-close"></i></a>                                                 
              <?php }else{ ?>   
                <span class="label label-warning">Pendiente</span>
                </td>
                <td>
                  <a data-toggle="modal" data-target="#form_{{$empleado[$i][4]}}" title="Asistencia" class="btn btn-success"><i class="fa fa-check"></i></a>
                  <a data-toggle="modal" data-target="#aus_{{$empleado[$i][4]}}" title="Ausencia" class="btn btn-danger"><i class="fa fa-close"></i></a>                 
              <?php }}} ?>    
                <div class="modal fade" id="form_{{$empleado[$i][4]}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{route('agregarasistenciarh')}}" method="GET" class="form-horizontal" >
                        <div class="modal-header success">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title">Tomar Asistencia a {{ $empleado[$i][1] }}</h4>
                        </div>
                        <div class="modal-body">                         
                          <input type="hidden" name="id" value="{{$empleado[$i][4]}}">
                          <div class="form-group">
                            {!! Form::label("lbhoraE","Hora Entrada",["class"=>"col-sm-2 control-label"]) !!}
                            <div class="col-sm-4">
                              <div class="input-group">
                                <input type="text" name="txthoraE" class="form-control pull-right time start" placeholder="Hora Entrada" required="true">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                            {!! Form::label("lbhoraS","Hora Salida",["class"=>"col-sm-2 control-label"]) !!}
                           <div class="col-sm-4">
                              <div class="input-group">
                                <input type="text" name="txthoraS" class="form-control pull-right time end" placeholder="Hora Salida" required="true">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </div>                     
                        </div>
                        <div class="modal-footer">
                          <input type="submit" value="Asistencia" class="btn btn-sm btn-success delete-btn">                               
                          <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="aus_{{$empleado[$i][4]}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Confirmar Ausencia</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Esta seguro, desea marcar ausencia a {{$empleado[$i][1]}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('agregarausenciarh',$empleado[$i][4])}}">
                        <input type="hidden" name="id" value="{{$empleado[$i][4]}}">
                        <input type="submit" value="Ausente" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>          
            </td>
          </tr>
          <?php } ?>  
        </tbody>
      </table>
    </div>
  </div>
  <div class="box-footer" align="right">                
    <a href="{{route('listaasistenciasrh')}}" class="btn btn-primary"><< Regresar</a>
  </div>                                    
</div>  

@endsection
@section('script')
<script>
$('#fecha').on('change',function(){
var fecha=$('#fecha').val();

});
</script>
@endsection
