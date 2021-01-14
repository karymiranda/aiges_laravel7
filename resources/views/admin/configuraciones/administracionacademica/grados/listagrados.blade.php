@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Grados')
@section('content')
<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">GRADOS</label></h2>
              </div>
              <div class="col-sm-12" align="right">            
            
                <a href="{{ route('agregargrado') }}" class="btn btn-primary">Agregar grado</a>
          </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                  <th>CORRELATIVO</th>
                  <th>GRADO</th>
                   <th>NIVEL ACADEMICO</th>                  
                  <th>ACCIONES</th>
                </thead>
                <tbody>
                @foreach($grados as $grados)
                <tr>
                 <td>{{$grados->id}}</td>
                 <td>{{$grados->grado}}</td>
                 <td>{{$grados->nivel_educativo}}</td>
                <td>                    
                    <a href="" class="btn btn-primary" disabled="true"><i class="fa fa-eye"></i></a>                    
                    <a href="{{route('editargrado',$grados->id)}}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
                   <a class="btn btn-danger" title="Eliminar" data-toggle="modal" data-target="#NOgrado_{{$grados->id}}" disabled=true>
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="grado_{{$grados->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ELIMINACION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Esta seguro, desea eliminar el grado {{$grados->grado}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('desactivargrado',$grados->id)}}">
                        <input type="hidden" name="id" value="{{$grados->id}}">
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
            <!-- /.box-body -->

          </div>


@endsection
