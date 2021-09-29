@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Depreciación')
@section('content')

  <div class="box box-primary">
    <div class="box-header">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">DEPRECIACIÓN DE ACTIVO FIJO {{$anio}}</label></h2>
              </div>
      <div class="col-sm-12" align="right">          
        <a href="{{route('calculardepreciacion',$anio)}}" class="btn btn-primary" <?php if($deprecVerify>0){ echo"disabled";} ?>>Calcular</a>
        <form id="formulariorpt">
      <?php @crsf ?>
        </form>
      </div>
    </div>
    <hr>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>ID</th>
          <th>CÓDIGO</th>
          <th>DESCRIPCIÓN</th>
           <!--th>AÑO</th> 
          <th>DEPRECIACIÓN ANUAL</th>
          <th>DEPRECIACIÓN ACUMULADA</th>       
          <th>VALOR EN LIBROS</th-->
          <th>ACCIONES</th>
        </thead>
        <tbody>
           @foreach($activos as $activo)
          <tr>
          <td>{{ $activo->id }}</td>            
            <td>{{ $activo->v_codigoactivo }}</td>
            <td>{{ $activo->v_nombre }}</td>
            <td>
              <a href="{{route('verhistorialdepreciacion', $activo->id)}}" title="Ver historial" class="btn btn-primary"><i class="fa fa-eye"></i></a>
            </td>
          </tr>            
            @endforeach
       </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection
