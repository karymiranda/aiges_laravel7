@extends('admin.menuprincipal')
@section('tittle','Consultas y Reportes')
@section('content')

  <div class="box">
    <div class="box-header">
      <div class="col-sm-4">
        <h2 class="box-title"><strong>Lista de Recurso Humano</strong></h2>
      </div>
    </div> 
    <hr>          
    <div class="box-body">
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>EXPEDIENTE</th> 
          <th>NOMBRE COMPLETO</th>
          <th>DIRECCION</th>
          <th>DUI</th>
          <th>CARGO</th>
          <th>CELULAR</th>
        </thead>
        <tbody>
          @foreach($empleados as $empleado)          
            <tr>            
              <td>{{ $empleado->v_numeroexp }}</td>
              <td>{{ $empleado->v_nombres . ' ' . $empleado->v_apellidos }}</td>
              <td>{{ $empleado->v_direccioncasa }}</td>
              <td>{{ $empleado->v_dui }}</td>
              <td>{{ $empleado->cargo->v_descripcion }}</td>
              <td>{{ $empleado->v_celular }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body-->
    <div class="box-footer" align="right">                
      <a href="{{ route('listareportes') }}" class="btn btn-primary"><< Regresar</a>
    </div>   
  </div>
@endsection