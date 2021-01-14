@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Turnos')
@section('content')


<div class="box  box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">TURNOS</label></h2>
              </div>
              <div class="col-sm-12" align="right">            
            
                <a href="{{route('agregarturno')}}" class="btn btn-primary">Registrar turno</a>
          </div>
            </div>
            <hr>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>                  
                  <th>TURNO</th>
                  <th>HORA INCIO</th>
                  <th>HORA FIN</th>                     
                  <th>ACCIONES</th>
                </thead>
                <tbody>
                  @foreach($turnos as $turnos)
                <tr>         
                 <td>{{$turnos->turno}}</td> 
                 <td>{{$turnos->horadesde}}</td> 
                 <td>{{$turnos->horahasta}}</td> 
                 <td>
                   <a href="" class="btn btn-primary" disabled="true" title="Ver"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('editarturno',$turnos->id) }}" class="btn btn-success" title="Editar"><i class="fa fa-edit"></i></a>
                    
        <a class="btn btn-danger" data-toggle="modal" data-target="#cargo_{{$turnos->id}}" title="Deshabilitar">
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="cargo_{{$turnos->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea eliminar el turno {{$turnos->turno}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('desactivarturno',$turnos->id)}}">
                        <input type="hidden" name="id" value="{{$turnos->id}}">
                        <input type="submit" value="Eliminar" class="btn btn-sm btn-danger delete-btn">                               
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
            
          </div>


@endsection
