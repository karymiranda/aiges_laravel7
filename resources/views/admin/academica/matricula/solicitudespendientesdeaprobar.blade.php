@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Matricula Virtual/Solicitudes')
@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">SOLICITUDES MATRICULA EN LINEA {{$anio}}</label></h2>
              </div>
              <div class="col-sm-8" align="right">            
              </div>
            </div>
           
         <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead > 
                  <th>No.</th>             
                  <th>FECHA DE SOLICITUD</th>
                  <!--th>EXPEDIENTE</th-->
                  <th>NIE</th> 
                  <th>ESTUDIANTE</th>                                 
                  <th>GRADO</th>
                  <th>SECCION</th>
                  <th>TURNO</th> 
                  <th>TELEFONO</th>                  
                  <th>ACCION</th>
                
              </thead>
                <tbody>
             @foreach($datos as $key => $datos) 
            @foreach($datos->estudiante_seccion as $matricula)   
                <tr>  
                 <td>{{$key + 1}}</td>            
                <td>{{$matricula->pivot->f_fechamatricula}}</td>
                 <!--td>{{$datos->v_expediente}}</td-->
                 @if($datos->v_nie==null) 
                 <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                   @if($datos->v_nie!=null) 
                  <td>{{$datos->v_nie}}</td>
                   @endif                        
                        <td>{{$datos->v_nombres}} {{$datos->v_apellidos}}</td>
                         <td>{{$matricula->seccion_grado->grado}}</td>
                        <td>{{$matricula->seccion}}</td>
                         <td>{{$matricula->seccion_turno->turno}}</td> 
                 @if($datos->v_telCelular==null) 
                 <td>---</span></td> 
                   @endif 
                   @if($datos->v_telCelular!=null) 
                  <td>{{$datos->v_telCelular}}</td>
                   @endif 

                  <td>                    
                    <a href="{{route('vermatriculaonline',$matricula->pivot->estudiante_id)}}" title="Ver" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="{{route('editarsolicitudmatriculaonline',[$datos->id,$matricula->pivot->id,$matricula->pivot->seccion_id])}}" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                    <a href="{{route('aprobarsolicitudmatriculaonline',[$datos->id,$matricula->pivot->seccion_id])}}" class="btn btn-success" title="Aprobar"><i class="fa fa-check"></i></a>
<a class="btn btn-danger" data-toggle="modal" title="Denegar" data-target="#solicitud_{{$datos->id}}">
                  <i class="fa fa-close"></i>
                </a>
                <div class="modal fade" id="solicitud_{{$datos->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">DENEGAR SOLICITUD DE MATRICULA</h4>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro, desea denegar la solicitud de matricula del estudiante:  {{$datos->v_nombres}} {{$datos->v_apellidos}}?</p> 
                       <p> Este proceso borrará la solicitud del sistema</p>
                      </div>
                      <div class="modal-footer">
          <form method="GET" action="{{route('eliminarsolicitudmatriculaonline',[$datos->id,$matricula->pivot->seccion_id])}}">
                         
                          <input type="submit" value="Aceptar" class="btn btn-sm btn-danger delete-btn">                               
                          <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                  </td>                                   
                  </tr>
                  @endforeach 
                @endforeach  
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->

            </div>
      
     @endsection
