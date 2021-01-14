@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Padres de Familia')
@section('content')

<div class="box box-primary">
            <div class="box-header">
             <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">FAMILIARES</label></h2>
              </div>
              <div class="col-sm-12 " align="right">       
                    <a href="{{ route('agregarfamiliar') }}" class="btn btn-primary">Registrar Familiar</a>
                    
                 </div>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                <tr> 
                <th>No.</th>  
                  <th>DUI</th>
                  <th>NOMBRE DEL FAMILIAR</th>
                   <th>DIRECCION</th> 
                   <th>TELEFONO PERSONAL</th>  
                   <th>TELEFONO CASA</th>                              
                 <th>ACCIONES</th>
                </tr></thead>
                <tbody>
                 @foreach($listapadres as $key => $listapadres)
                  <tr>  
                <td>{{$key + 1}}</td> 
                  @if($listapadres->dui==null) 
                 <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                  @if($listapadres->dui!=null) 
                 <td>{{$listapadres->dui}}</td> 
                   @endif 
                  <td>{{$listapadres->nombres}} {{$listapadres->apellidos}}</td>
                 <td>{{$listapadres->direccionderesidencia}}</td>
                   @if($listapadres->celular==null) 
                 <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                   @if($listapadres->celular!=null) 
                 <td>{{$listapadres->celular}}</td> 
                   @endif 

                  @if($listapadres->telefonocasa==null) 
                 <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                   @if($listapadres->telefonocasa!=null) 
                 <td>{{$listapadres->telefonocasa}}</td> 
                   @endif
                 
                  <td>                    
                    <a href="{{route('verpadredefamilia',$listapadres->id)}}" title="Ver" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="{{route('editarpadredefamilia',$listapadres->id)}}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#familiar_{{$listapadres->id}}">
                  <i class="fa fa-close"></i>
                </a>
                <div class="modal fade" id="familiar_{{$listapadres->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">DESHABILITAR FAMILIAR</h4>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro, desea deshabilitar el expediente del familiar:  {{$listapadres->nombres}} {{$listapadres->apellidos}}?</p>
                      </div>
                      <div class="modal-footer">
          <form method="GET" action="{{route('eliminarpadredefamilia',$listapadres->id)}}">
                          <input type="hidden" name="id" value="{{$listapadres->id}}">
                          <input type="submit" value="Deshabilitar" class="btn btn-sm btn-danger delete-btn">                               
                          <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="btn-group">
                  <button type="button" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i></button>
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('expedientefamiliar_pdf',$listapadres->id)}}" target="blank">Expediente pdf</a></li>

                  </ul>
                </div>                
                  </td>                
                 </tr>
                 @endforeach
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
@endsection
