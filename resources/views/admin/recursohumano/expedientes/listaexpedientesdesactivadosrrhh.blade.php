@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Expedientes inactivos')
@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">
       <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">EXPEDIENTES INACTIVOS</label></h2>   
    </div>
     
    </div> 
         
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>No.</th>  
          <th>EXPEDIENTE</th> 
          <th>NOMBRES</th>
          <th>APELLIDOS</th>
          <th>TIPO PERSONAL</th>
          <th>CARGO</th>                  
          <th>ACCIONES</th>
        </thead>
        <tbody>
          @foreach($empleados as $key => $empleado)          
            <tr> 
             <td>{{$key }}</td>            
              <td>{{ $empleado->v_numeroexp }}</td>
              <td>{{ $empleado->v_nombres }}</td>
              <td>{{ $empleado->v_apellidos }}</td>
              <td>{{ $empleado->tipoPersonal->v_tipopersonal }}</td>
              <td>{{ $empleado->cargo->v_descripcion }}</td>
              <td>
                <a href="{{ route('verexpedientedesactivadorh',$empleado->id) }}" title="Ver" class="btn btn-primary" ><i class="fa fa-eye"></i></a>
                <a title="Activar" class="btn btn-success" data-toggle="modal" data-target="#emple_{{$empleado->id}}"><i class="fa fa-level-up"></i></a>
                <div class="modal fade" id="emple_{{$empleado->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">CONFIRMAR ACCION</h4>
                      </div>
                      <div class="modal-body">
                        <p>¿Esta seguro, desea activar el expediente {{$empleado->v_numeroexp}}?</p>
                      </div>
                      <div class="modal-footer">
                        <form method="GET" action="{{route('activarexpedienterh',$empleado->id)}}">
                          <input type="hidden" name="id" value="{{$empleado->id}}">
                          <input type="submit" value="Activar" class="btn btn-sm btn-success delete-btn">                               
                          <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body-->   
  </div>
@endsection