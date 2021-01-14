@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/ Ver Asistencia')
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
      <div class="col-sm-4">
        <h2 class="box-title"><strong>DETALLE ASISTENCIA RECURSO HUMANO </strong></h2>
      </div>
    </div>
  <form action="{{route('agregarasistenciarh')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="fecha" value="{{ $hoy }}" />
    
    <div class="box-body">

      <div class="col-sm-10 col-sm-offset-1">
        <table class="table table-bordered table-striped" id="tablaAsistencia">
          <thead>
            <th>No</th>
            <th>Nombre del empleado</th>
            <th>Fecha</th>
            <th align="center">¿Asistió?</th>
             <th align="center">Motivo</th>
          </thead>
          <tbody>
<?php for($i=0;$i<$n;$i++){ ?>            
              <tr id="$tudent->id">
                <td>{{ $i+1 }}</td>
                <td>{{ $empleado[$i][1] }}</td>
                 <th>{{$hoy}}</th>
                <td align="center">
              
             <?php if($empleado[$i][3]=='Asistencia'){?>
			<span class="label label-success">Si</span>
             	
             <?php } else if($empleado[$i][3]=='Ausencia'){?>
	<span class="label label-danger">No</span>
              <?php }else{?>   
<span class="label label-info">No</span>
               <?php }?>          
            
              </td>
              
               <?php 
if($empleado[$i][3]== 'Permiso'){
echo"<td><span class='label label-info'>"; print_r("Permiso"); echo"</span></td>";
}
else if ($empleado[$i][3]== 'Ausencia'){
echo"<td>"; print_r("Sin justificar"); echo"</td>"; 
}
else
{
echo"<td>"; print_r("---"); echo"</td>";	
}
               }
               ?> 
              
              </tr>
           
          </tbody>
        </table>
      </div>  
    </div>
    <div class="box-footer" align="right">

      <a href="{{route('consultahistorialasistencia_docente')}}" class="btn btn-default">regresar</a>
    </div>
  </form>
</div>
@endsection