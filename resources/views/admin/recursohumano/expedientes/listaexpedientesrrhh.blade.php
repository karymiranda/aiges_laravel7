@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Expedientes')
@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">GESTION DE PERSONAL</label></h2>
   
    </div>
      <div class="col-sm-12" align="right">            
        <a href="{{ route('crearexpedientesrh') }}"  class="btn btn-primary">Registrar expediente</a>
      </div>
    </div> 
              
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
           <th>No.</th>  
          <th>DUI</th> 
          <th>NOMBRES</th>
          <th>APELLIDOS</th>
          <th>TIPO PERSONAL</th>
          <th>CARGO</th>                  
          <th>ACCIONES</th>
        </thead>
        <tbody>
          @foreach($empleados as $key => $empleado)  
           <?php if ($empleado->v_numeroexp!='RH0000-0'): ?>          
            <tr>
            <td>{{$key }}</td>              
              <td>{{ $empleado->v_dui }}</td>
              <td>{{ $empleado->v_nombres }}</td>
              <td>{{ $empleado->v_apellidos }}</td>
              <td>{{ $empleado->tipoPersonal->v_tipopersonal }}</td>
              <td>{{ $empleado->cargo->v_descripcion }}</td>
              <td>
                <a href="{{ route('verexpedienterh',$empleado->id) }}" title="Ver" class="btn btn-primary" ><i class="fa fa-eye"></i></a>
                <a href="{{ route('editarexpedienterh',$empleado->id) }}" title="Actualizar" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <?php if ($empleado->id!=Auth::user()->empleado->id): ?>
                <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#emple_{{$empleado->id}}">
                  <i class="fa fa-close"></i>
                </a>  
                <?php else: ?>
                <a class="btn btn-danger" disabled='true' title="Deshabilitar">
                  <i class="fa fa-close"></i>
                </a>  
                <?php endif ?>
                <div class="modal fade" id="emple_{{$empleado->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">DESHABILITAR PERSONAL</h4>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro, desea deshabilitar el expediente {{$empleado->v_numeroexp}}?</p>
                      </div>
                      <div class="modal-footer">
                        <form method="GET" action="{{route('eliminarexpedienterh',$empleado->id)}}">
                          <input type="hidden" name="id" value="{{$empleado->id}}">
                          <input type="submit" value="Deshabilitar" class="btn btn-sm btn-danger delete-btn">                               
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
                    <li><a href="{{route('expedienterh_pdf',$empleado->id)}}" target="blank">Expediente</a></li>
                    <li><a href="{{route('estudiosycapacitacionesrrhh',$empleado->id)}}" target="blank">Titulos y certificaciones</a></li>
                    
                    <li><a href="{{route('consultahistorialasistencia_docente')}}">Asistencias</a></li>
                  
                    <li><a href="{{ route('listapermisosrh')}}">Permisos</a></li>
                    <li><a href="{{route('horariodeclases_docente',$empleado->id)}}">Horario de clases</a></li>
                    <!--li><a href="{{ route('listaempleados')}}">Horario de labores</a></li-->
                  </ul>
  </div>
              </td>




  <div class="modal fade" tabindex="-1" role="dialog" id="modalfiltrorptasistencia_{{$empleado->id}}"> </input>
          <form method="POST" id="rptAsistencia">
            @csrf
               <input type="hidden" name="idpersonal" id="idpersonal" value="{{$empleado->id}}">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">REPORTE ASISTENCIA</h4>
                      </div>
                      <div class="modal-body">
                          <div class="box-body">
       
       <div class="form-group">
        <label class="col-sm-2 control-label">Mes</label>
 <div class="col-sm-10">
  <select class="form-control" id="mesasistencia" name="mesasistencia">
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>
                  
                  </select>       
</div>
       

           </div>
           </div>
         
                      <div class="modal-footer">
                         <button type="button" data-dismiss="modal" class="btn btn-primary" id="btnasistencia" >Generar PDF</button> 
                         
                            <button type="button" data-dismiss="modal" class="btn btn-primary" id="btnasistencia" >Generar PDF</button> 


                          <button type="button" 
                              class="btn btn-default " data-dismiss="modal">Cerrar</button>
                          
                      </div>
             
                  </div>
                  </div>
                  </form> 
              </div>












            </tr>
                <?php endif ?>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body-->  



  </div>
@endsection
@section('script')
<script>

$('#btnasistencia').on('click', function(e){//asistencia
  e.preventDefault();
  alert('isjdiosjfoi');
$('#rptAsistencia').attr("method",'POST');
$('#rptAsistencia').attr("target",'__blank');
$('#rptAsistencia').attr("action",'historialasistencia_docente'); 
 $('#rptAsistencia').submit(); 
}); 
</script>
@endsection

