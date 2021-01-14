@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Inscripción el Línea')
@section('content')


<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">PERIODO DE INSCRIPCION EN LINEA</label></h2>
             </div>

              <div class="col-sm-12" align="right">          
                <a href="{{route('agregarperiodo')}}" class="btn btn-primary">Agregar periodo</a>
          </div>
            </div>
            <HR>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead> 
                  <th>DESCRIPCION</th>
                  <th>AÑO</th>
                  <th>DESDE</th>
                  <th>HASTA</th> 
                   <th>TIPO PERIODO</th>
                    <th>ESTADO</th>                      
                  <th>ACCIONES</th>
                </thead>
                <tbody>
                 @foreach($periodohabil as $periodohabil)
                <tr>  
                 <td>{{$periodohabil->v_descripcion}}</td>
                 <td>{{$periodohabil->anio}}</td>        
                 <td>{{$periodohabil->f_fechadesde}}</td> 
                 <td>{{$periodohabil->f_fechahasta}}</td> 
                  <td>{{$periodohabil->tipo_periodo}}</td>
                  @if($hoy > $periodohabil->f_fechahasta)
                   <td><span class="label label-warning">CERRADO</span></td>
                 @else<td><span class="label label-success">VIGENTE</span></td>
                  @endif 
                 <td>
                 <a href="" class="btn btn-primary" disabled="true"><i class="fa fa-eye"></i></a>
                <a href="{{route('editarperiododeinscripcion',$periodohabil->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>                    
        <a class="btn btn-danger" data-toggle="modal" data-target="#periodo_{{$periodohabil->id}}">
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="periodo_{{$periodohabil->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ELIMINACION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea eliminar  {{$periodohabil->v_descripcion}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('desactivarperiododeinscripcion',$periodohabil->id)}}">
                        <input type="hidden" name="id" value="{{$periodohabil->id}}">
                        <input type="submit" value="Eliminar" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                 </td> 
                 </tr>
                 @endforeach()             
                </tbody>               
              </table>
            </div>
            
          </div>


@endsection
