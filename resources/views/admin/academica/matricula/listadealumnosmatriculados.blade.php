@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Estudiantes Matriculados')
@section('content')

<div class="box box-primary ">
            <div class="box-header with-border">
               <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">MATRICULAS {{$anio}}</label></h2>
    </div>
    <div class="col-sm-12" align="right">            
              
                <a href="{{route('matricula')}}" class="btn btn-primary">Registrar matrícula</a>

          </div>
            </div>
           
            <!-- /.box-header -->
             <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
              <thead >
                 <th>No.</th>  
                 <th>FECHA DE MATRICULA</th>
                  <th>NIE</th> 
                  <th>ESTUDIANTE</th>
                   <th>GRADO</th>  
                  <th>SECCION</th>
                   <th>TURNO</th>                                     
                  <th>MODALIDAD</th>
                  <th>ACCIONES</th>
                </thead>
                 <tbody>
                    @foreach($datos as $key => $datos) 
                   @foreach($datos->estudiante_seccion as $matricula)                     
                        <tr> 
                        <td>{{$key + 1}}</td>            
                        <td>{{$matricula->pivot->f_fechamatricula}}</td>
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
                        <td>{{$matricula->pivot->modalidad}}</td>                  
                        <td>
    <a href="{{ route('vermatricula',[$datos->id,$matricula->pivot->id,$matricula->pivot->seccion_id]) }}" class="btn btn-primary" title="Ver"><i class="fa fa-eye"></i></a>
    <a href="{{ route('editarmatricula',[$datos->id,$matricula->pivot->id,$matricula->pivot->seccion_id]) }}" class="btn btn-success" title="Editar"><i class="fa fa-edit"></i></a>
   
       <a class="btn btn-danger" data-toggle="modal"  title="Retirar matrícula" data-target="#matricula_{{$matricula->pivot->id}}">
      <i class="fa fa-close"></i></a>
              <div class="modal fade" id="matricula_{{$matricula->pivot->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR RETIRO DE MATRICULA</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea retirar la matrícula del estudiante {{$datos->v_nombres}} {{$datos->v_apellidos}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{ route('retirarmatricula',[$datos->id,$matricula->pivot->seccion_id]) }}">
                        <input type="hidden" name="id" value="{{$matricula->pivot->id}}">
                        <input type="submit" value="Si" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="btn-group">
                  <button type="button" class="btn btn-warning" title="Reportes"><i class="fa fa-file-pdf-o"></i></button>
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                 <li><a href="{{ route('comprobantematriculapdf',[$datos->id,$matricula->pivot->id,$matricula->pivot->seccion_id]) }}" target="__blank">Imprimir comprobante</a></li>
                  </ul>
  </div>

                        </td>              
                        </tr>
                      @endforeach 
                      @endforeach                
              </tbody></table>
            </div>
            <!-- /.box-body -->

@endsection
