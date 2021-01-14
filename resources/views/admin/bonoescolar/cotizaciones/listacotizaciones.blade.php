@extends('admin.menuprincipal')
@section('tittle','Administración bono escolar/Cotizaciones')
@section('content')



<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">COTIZACIONES</label></h2>
              </div>
              <div class="col-sm-12" align="right">          
            
                <a href="{{ route('agregarcotizacion') }}" class="btn btn-primary">Registrar cotización</a>
                </div>
            </div>
           
          
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                  <th>COTIZACION</th>
                  <th>FECHA DE EMISION</th>
                   
                  <th>DESCRIPCION</th>                                  
                  <th>ACCIONES</th>
                </thead>
                <tbody>
                
                @foreach($cotizaciones as $listacotizaciones) 
                 <tr>         
                 <td>{{$listacotizaciones->v_numerocotizacion}}</td>
                 <td>{{$listacotizaciones->f_fechaelaboracion}}</td> 
                
                 <td>{{$listacotizaciones->v_descripcion}}</td>
                               
                  <td>                    
                    <a href="{{route('vercotizacion',$listacotizaciones->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('editarcotizacion',$listacotizaciones->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" data-toggle="modal" title="Eliminar" data-target="#cotizacion_{{$listacotizaciones->id}}">
                  <i class="fa fa-close"></i>
                </a>
                <div class="modal fade" id="cotizacion_{{$listacotizaciones->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Confirmar Eliminación</h4>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro, desea eliminar la cotizacion:  {{$listacotizaciones->v_numerocotizacion}}?</p>
                      </div>
                      <div class="modal-footer">
          <form method="GET" action="{{route('borrarcotizacion',$listacotizaciones->id)}}">
                          <input type="hidden" name="id" value="{{$listacotizaciones->id}}">
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
