@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Padres de Familia')
@section('content')

<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">FAMILIARES INACTIVOS</label></h2>
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
                 @foreach($listapadres as  $key => $listapadres)
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
    <a href="{{ route('verpadredefamilia',$listapadres->id)}}"  title="Ver" class="btn btn-primary"><i class="fa fa-eye"></i></a>
    <a href="{{route('activarexpedientesinactivos',$listapadres->id)}}" title="Activar" class="btn btn-success"><i class="fa fa-level-up"></i></a>
                  </td>                
                 </tr>
                 @endforeach
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
@endsection
