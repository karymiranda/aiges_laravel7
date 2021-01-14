@extends('admin.menuprincipal')
@section('tittle','Personal Docente/Permisos')
@section('content')


<div class="box box-primary box-solid">
  <div class="box-header">
      <h1 class="box-title">HISTORIAL PERMISOS SOLICITADOS</h1>              
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead >
        <th>No</th>  
        <th>MOTIVO</th>
        <th>DIAS (ACUMULADO)</th> 
        <th>HORAS (ACUMULADO)</th>  
        <th>MINUTOS (ACUMULADO)</th>
      </thead>
      <tbody>    
        @foreach($consulta as $key => $permiso)
        <tr> 
          <td>{{ $key+1 }}</td>
          <td>{{ $permiso->v_motivo }}</td> 
           <td>{{ $permiso->dias}}</td>   
           <td>{{ $permiso->horas}}</td>
            <td>{{ $permiso->minutos}}</td>                                
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
 <div class="box-footer" align="right">                
      <a href="{{route('historialpermisos')}}" class="btn btn-default">Regresar</a>
  </div>
</div>
@endsection
