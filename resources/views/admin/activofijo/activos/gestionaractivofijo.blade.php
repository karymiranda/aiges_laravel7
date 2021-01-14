@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo')
@section('content')

  <div class="box box-primary">
    <div class="box-header">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">GESTION ACTIVO FIJO</label></h2>
              </div>
      <div class="col-sm-12" align="right">          
        <a href="{{route('crearactivofijo')}}" class="btn btn-primary">Registrar activo</a>
        <a href="{{route('subirarchivoactivofijo')}}" class="btn btn-primary" id="btnarchivo">Subir archivo</a>
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
          <th>CODIGO</th>
          <th>DESCRIPCION</th> 
          <th>FECHA DE ADQUISICION</th>
          <th>VALOR ($)</th>                                   
          <th>UBICACION</th>
          <th>ACCIONES</th>
        </thead>
        <tbody>
          @foreach($activos as $activo)
          <tr>            
            <td>{{ $activo->v_codigoactivo }}</td>
            <td>{{ $activo->v_nombre }}</td>
            <td>{{ $activo->f_fecha_adquisicion }}</td>
            <td>{{ number_format($activo->d_valor,2) }}</td>
            <td>{{ $activo->v_ubicacion }}</td>
            <td>                   
              <a href="{{ route('verdetalleactivofijo',$activo->id) }}" title="Ver" class="btn btn-primary" ><i class="fa fa-eye"></i></a>
              <?php if ($activo->v_trasladadoSN=='N'){ ?>
                <a href="{{ route('editaractivofijo',$activo->id) }}" title="Actualizar" class="btn btn-success"><i class="fa fa-edit"></i></a>
              <?php }else{ ?>
                <a title="Actualizar" disabled='true' class="btn btn-success"><i class="fa fa-edit"></i></a>
              <?php } ?>
              <?php if ($activo->v_trasladadoSN=='N'){ ?>
                <a href="{{route('creartrasladoactivo',$activo->id)}}" title="Trasladar" class="btn btn-warning"><i class="fa fa-truck"></i></a>
              <?php }else{ ?>
                <a title="Trasladado" disabled='true' class="btn btn-warning"><i class="fa fa-truck"></i></a>
              <?php } ?>
              <?php if ($activo->v_trasladadoSN=='N'){ ?>              
                <a href="{{route('descargaractivo',$activo->id)}}" title="Descargar" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              <?php }else{ ?>
                <a title="Descargar" disabled='true' class="btn btn-danger"><i class="fa fa-trash"></i></a>
              <?php } ?>
            </td>                   
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection
@section('script')
 <script type="text/javascript">
 
 </script>
@endsection