@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Estudiantes Inactivos')
@section('content')


<div class="box">
            <div class="box-header">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">ESTUDIANTES INACTIVOS</label></h2>
              </div>                
            </div>
           
            
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                 <th>No.</th>
                  <th>EXPEDIENTE</th>
                  <th>NIE</th> 
                  <th>NOMBRES</th>
                  <th>APELLIDOS</th>                                
                  <th>FECHA DE RETIRO</th>                                                   
                  <th>MOTIVO</th>                                                    
                  <th>OBSERVACIONES</th>  
                  <th>ACCIONES</th>               
              </thead>
              <tbody>                            
                 @foreach($expedientes as $key=>$expedientes)
                <tr>
                <td>{{$key+1}}</td>             
                 <td>{{$expedientes->v_expediente}}</td> 
                 @if($expedientes->v_nie==null) 
                 <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                  @if($expedientes->v_nie!=null) 
                 <td>{{$expedientes->v_nie}}</td> 
                   @endif               
                  <td>{{$expedientes->v_nombres}}</td>
                  <td>{{$expedientes->v_apellidos}}</td>
                  <td>{{$expedientes->deshabilitadofecha}}</td>
                   @if($expedientes->deshabilitadomotivo==null) 
                   <td></td>
                   @endif  
                   @if($expedientes->deshabilitadomotivo=="T") 
                   <td><span class="label label-warning">Traslado</span></td>
                   @endif  
                   @if($expedientes->deshabilitadomotivo=="D") 
                   <td><span class="label label-danger">Deserción</span></td>
                   @endif  
                   @if($expedientes->deshabilitadomotivo=="G") 
                   <td><span class="label label-success">Graduado</span></td>
                   @endif 
                   @if($expedientes->deshabilitadomotivo=="O") 
                   <td><span class="label label-warning">Otros</span></td>
                   @endif 
                   <td>{{$expedientes->deshabilitadoobservaciones}}</td>                  
                  <td>                    
    <a href="{{ route('verexpedienteestudiantes',$expedientes->id)}}"  title="Ver" class="btn btn-primary"><i class="fa fa-eye"></i></a>
     @if($expedientes->deshabilitadomotivo!="G") 
    <a href="{{route('activarexpedientesinactivosest',$expedientes->id)}}" title="Activar" class="btn btn-success"><i class="fa fa-level-up"></i></a>
    @endif 
    
                  </td>                  
                  </tr>
                  @endforeach
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->

     


@endsection
