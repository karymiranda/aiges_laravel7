@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Calificaciones/Períodos')
@section('content')
<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">PERIODOS DE EVALUACION</label></h2>
              </div>
   {!! Form::open(['route'=>'registrarperiodoevaluacion', 'method'=>'GET', 'class'=>'form-horizontal','id'=>'formulario']) !!}
    <input type="hidden" id="mostrarboton" value="{{$mostrarboton}}">
    <div class="col-sm-12" align="right">        
           <a id="btnnuevo" class="btn btn-primary">Registrar período</a>
    </div>
   </div>
     {!! Form::close() !!}
            <HR>
   <div hidden="true" class="alert alert-danger alert-dismissible" role="alert" id="errores">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <ul>
    
  </ul>
  </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead> 
                  <th>NOMBRE</th>
                  <th>DESCRIPCION</th>
                  <th>FECHA INICIO</th>
                  <th>FECHA FIN</th>
                  <th>CICLO ACADEMICO</th> 
                  <th>ESTATUS</th>                       
                  <th>ACCIONES</th>
                </thead>
                <tbody>
                    @foreach($periodosevaluacion as $periodosevaluacion)
                <tr>  
                 <td>{{$periodosevaluacion->nombre}}</td>        
                 <td>{{$periodosevaluacion->descripcion}}</td>
                 <td>{{$periodosevaluacion->fecha_inicio}}</td>
                 <td>{{$periodosevaluacion->fecha_fin}}</td>
                 <td>{{$periodosevaluacion->periodoevaluacion_cicloescolar->anio}}</td>

                  @if($periodosevaluacion->estado=='1')
                  <td><span class="label label-success">VIGENTE</span></td>
                 @else
                 <td><span class="label label-warning">CERRADO</span></td>
                 @endif
                  <td>
                 <a href="" class="btn btn-primary" disabled="true"><i class="fa fa-eye"></i></a>
                    <a href="{{route('editarperiodoevaluacion',$periodosevaluacion->id)}}"  title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
         
          <!--a class="btn btn-danger" data-toggle="modal"  title="Eliminar" data-target="#periodo_{{$periodosevaluacion->id}}" disabled="true"-->

        <a class="btn btn-danger" data-toggle="modal"  title="Eliminar" data-target="" disabled="true">

                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="periodo_{{$periodosevaluacion->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Confirmar Eliminación</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea eliminar el periodo de evaluación {{$periodosevaluacion->nombre}}?</p>
                    </div>
                    <div class="modal-footer">
         <form method="GET" action="{{route('eliminarperiodoevaluacion',$periodosevaluacion->id)}}">
                        <input type="hidden" name="id" value="{{$periodosevaluacion->id}}">
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
            
          </div>


@endsection
@section('script')
<script>
 $('#btnnuevo').on('click', function(e){
if($('#mostrarboton').val()>=3)//solo permitira registrar TRES periodos de evaluacion
{
   $('#errores').removeAttr('hidden');
   $('#errores').append("<li>Solamente puede registrar TRES periodos para ingreso de calificaciones por cada año escolar.</li>");
}
else 
{
  $('#formulario').submit();
}
  });
</script>
@endsection
