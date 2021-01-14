@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración académica/Asignaturas')
@section('content')


<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">ASIGNATURAS</label></h2>
              </div>
              <div class="col-sm-12" align="right">            
            
                <a href="{{route('agregarasignatura')}}" class="btn btn-primary">Agregar asignatura</a>
          </div>
            </div>
            <HR>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda" style="width: 80%" align="center">
                <thead>
                  <th>No.</th> 
                  <th>CODIGO</th> 
                  <th>ASIGNATURA</th> 
                   <th>NOMBRE CORTO</th> 
                   <th>ES ASIGNATURA DE CUADRO FINAL</th> 
                    <th>ORDEN EN CUADRO FINAL</th>                        
                  <th>ACCIONES</th>
                </thead>
                <tbody>
                @foreach($asignaturas as $key => $asignaturas)
                <tr>
                 <td>{{$key+1}}</td> 
                 <td>{{$asignaturas->descripcion}}</td>
                 <td>{{$asignaturas->asignatura}}</td>
                 
                  <td>{{$asignaturas->name_short}}</td>
                  @if($asignaturas->is_cuadro==1)
                   <td>SI</td>
                   @else
                   <td>NO</td>
                  @endif
                  @if($asignaturas->orden==0)
                   <td>---</td>
                  @else
                   <td>{{$asignaturas->orden}}</td>
                  @endif
                      
                 <td>
                 <a href="" class="btn btn-primary" disabled="true"><i class="fa fa-eye"></i></a>
                    <a href="{{route('editarasignatura',$asignaturas->id)}}"  title="Editar"class="btn btn-success"><i class="fa fa-edit"></i></a>
                <!--a href="{{route('asignarasignaturaporseccion',$asignaturas->id)}}" title="Asignaturas a impartir por sección" class="btn btn-warning"><i class="fa fa-sign-in"></i></a-->                    
        <a class="btn btn-danger" data-toggle="modal" data-target="#asignatura_{{$asignaturas->id}}" title="Deshabilitar">
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="asignatura_{{$asignaturas->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea deshabilitar la asignatura {{$asignaturas->asignatura}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('desactivarasignatura',$asignaturas->id)}}">
                        <input type="hidden" name="id" value="{{$asignaturas->id}}">
                        <input type="submit" value="Deshabilitar" class="btn btn-sm btn-danger delete-btn">                               
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
