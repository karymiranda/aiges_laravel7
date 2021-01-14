@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Horario de Clases')
@section('content')


<div class="box box-primary">
            <div class="box-header">
             <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">HORARIO DE CLASES - BLOQUES</label></h2>
              </div>
              <div class="col-sm-12" align="right">          
              <a href="{{route('agregarbloquehorarios')}}" class="btn btn-primary">Registrar Bloque</a>
          </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead> 
                  <th>CORRELATIVO</th>
                  <th>TIPO BLOQUE</th> 
                  <th>HORA INICIO</th>
                  <th>HORA FIN</th>                   
                  <th>ACCIONES</th>
                </thead>
                <tbody>
                  @foreach($bloquehorario as $bloquehorario)
                <tr>
                 <td>{{$bloquehorario->correlativo_clase}}</td>
                 <td>{{$bloquehorario->tipo_bloque}}</td>
                 <td>{{$bloquehorario->hora_inicio}}</td>
                 <td>{{$bloquehorario->hora_fin}}</td>
                 <td>                    
                    <a href="#" class="btn btn-primary"  title="Ver" disabled="true"><i class="fa fa-eye"></i></a>
                    <a href="{{route('editarbloquehorarios',$bloquehorario->id)}}" class="btn btn-success"  title="Editar"><i class="fa fa-edit"></i></a>
        <a class="btn btn-danger" data-toggle="modal" data-target="#horario_{{$bloquehorario->id}}"  title="Eliminar">
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="horario_{{$bloquehorario->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ELIMINACION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea eliminar el bloque  {{$bloquehorario->correlativo_clase}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('eliminarbloquehorarios',$bloquehorario->id)}}">
                        <input type="hidden" name="id" value="#">
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
