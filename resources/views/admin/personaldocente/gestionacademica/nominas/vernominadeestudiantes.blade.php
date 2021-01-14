@extends('admin.menuprincipal')
@section('tittle','Docentes/Gestión Académica/Mis Secciones')
@section('content')
 
<div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
              <h2 ><label class="text-primary">{{$seccion}}</label></h2>
             </div> 
 </div>
             <div class="box-body">
              {!! Form::open(['route'=>'missecciones', 'method'=>'POST','class'=>'form-horizontal','id'=>'missecciones']) !!}
  <input type="hidden" name="seccion_id" id="seccion_id" value="{{$seccion_id}}">
              <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaAsistencia">
                <thead>
                 <th>No</th>
                  <th>EXPEDIENTE</th>
                  <th>NIE</th>
                  <th>ESTUDIANTE</th>
                  <th>ENCARGADO</th>
                  <th>PARENTESCO</th>
                  <th>CONTACTO ENCARGADO</th> 
                  <th>ACCIONES</th>
                  </thead>
                <tbody> 
                 @foreach($datos as $key => $estudiante)
                  @foreach($estudiante->estudiante_familiares as $familiar)
                 <tr>
                 <td>{{ $key+1 }}</td> 
                 <td>{{ $estudiante->v_expediente }}</td>
                 <td>{{ $estudiante->v_nie }}</td>
                 <td>{{ $estudiante->v_nombres }} {{ $estudiante->v_apellidos }}</td>
                 <td>{{ $familiar->nombres}} {{ $familiar->apellidos}}</td>
                 <td>{{ $familiar->pivot->parentesco}}</td>
                 @if($familiar->celular!=null)
                 <td>{{ $familiar->celular}}</td> 
                 @else
                  <td><span class="label label-warning">Sin asignar</span></td> 
                 @endif
                 <td>
                   <div class="btn-group">
                  <button type="button" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i></button>
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('listnotessingleadmin',[$estudiante->id,'docentes'])}}">Ingresar calificaciones</a></li>
                    <li><a href="{{ route('listcompsingleadmin',[$estudiante->id,'docentes'])}}" >Ingresar competencias ciudadanas</a></li>
                    <li class="divider"></li>
                    <li><a href="{{route('vercalificacionesonline',$estudiante->id)}}">Ver calificaciones</a></li>
                    <li><a href="{{route('listaasistencias')}}" target="blank">Ver asistencia</a></li>
                    <li><a href="{{route('expedientecompleto_modulodocente',[$estudiante->id,$seccion_id])}}" target="blank">Ver expediente</a></li>
                  </ul>
  </div>


                 </td> 
                </tr>
                 @endforeach               
                 @endforeach                            
              </tbody>
            </table>
            </div>
              </div>
            
            <!-- /.box-body -->

            <div class="box-footer" align="right" > 
   
<div class="btn-group">
                  <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i>  Opciones de seccion </button>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button> 
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('periodorefuerzonotas', [ $seccion_id,'docente'])}}">Refuerzo academico</a></li>
                    <li><a href="{{ route('cuadroFinal.show', $seccion_id) }}">Cuadro final</a></li>
                     <li class="divider"></li>
                    <li><a href="{{route('reporteBoleta',$seccion_id)}}" target="__blank">Boleta de notas<span class="pull-right-container">
      <small class="label pull-right bg-yellow"> Pdf</small>
      </span></a></li>
                    <li>
 <a  data-toggle="modal" data-target="#modalrendimientoescolar">Rendimiento escolar<span class="pull-right-container">
      <small class="label pull-right bg-yellow"> Pdf</small>
      </span></a></li>
         <li><a href="{{route('docentesnominadeestudiantes_pdf',$seccion_id)}}" target="_blank" target="__blank">Nomina<span class="pull-right-container">
      <small class="label pull-right bg-yellow"> Pdf</small>
      </span></a></li>
       <li><a href="{{route('horariosdeclases_pdf',$seccion_id)}}" target="_blank" target="__blank">Horario<span class="pull-right-container">
      <small class="label pull-right bg-yellow"> Pdf</small>
      </span></a></li>
                  </ul>
  </div>

  <!--a href="{{route('docentesnominadeestudiantes_pdf',$seccion_id)}}" target="_blank" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Generar PDF</a> 
           

<a href="{{route('nominaestudiantes_excelView',$seccion_id)}}" class="btn btn-success"><i class="fa fa-download"></i> Exportar a excel</a--> 
<a href="{{route('missecciones')}}" class="btn btn-default"><i class="fa fa-undo"></i> Regresar</a>
            
                      
           </div>



{!! Form::close() !!}

  <div class="modal fade" tabindex="-1" role="dialog" id="modalrendimientoescolar">
          <form action="#" id="Rendimientoescolar">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">RENDIMIENTO ESCOLAR</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
                            
                              <div class="form-group">
                                  <label class="col-sm-2" for="exampleInputEmail1">Asignatura</label>
                                  <div class="col-sm-10">
                                  <select class="form-control" name="asignatura" id="asignatura">
                                      @foreach ($asignaturas as $asignatura)
                                          <option value="{{ $asignatura->id }}">{{ $asignatura->asignatura }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
        
        <input type="button" name="" class="btn btn-primary" id="btnrendimientoescolar" value="Generar PDF"></input>
        <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>

 
            </div>

@endsection
@section('script')
<script type="text/javascript">   
  $('#btnrendimientoescolar').on('click', function(e){//rendimiento escolar por materia
var idmateria=$('#asignatura').val(); 
var id=$('#seccion_id').val(); 
$('#modalrendimientoescolar').modal('hide');
$('#Rendimientoescolar').attr("method",'GET');
$('#Rendimientoescolar').attr("target",'__blank');
$('#Rendimientoescolar').attr("action",'/aiges/public/index.php/admin/cuadrorendimientoescolar_pdf/'+id+'/'+idmateria+'/view'); 
 $('#Rendimientoescolar').submit(); 
}); 


</script>
@endsection