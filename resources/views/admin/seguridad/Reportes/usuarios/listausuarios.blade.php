@extends('admin.menuprincipal')
@section('tittle','Consultas y Reportes')
@section('content')

  <div class="box">
    <div class="box-header">
      <div class="col-sm-4">
        <h2 class="box-title"><strong>Lista de Usuarios</strong></h2>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive" align="center">
      <table class="table table-bordered table-striped" style="width: 85%" id="tablaBusqueda">
        <thead>         
          <th>NOMBRE DE USUARIO</th>
          <th>CUENTA</th>
          <th>ROLES</th>
        </thead>
        <tbody>  
        @foreach($usuarios as $usuario)       
          <tr>
            <?php if ($usuario->empleado!=null): ?>
              <td>{{$usuario->empleado->v_nombres .' '. $usuario->empleado->v_apellidos}}</td>
            <?php else: ?>
              <?php if ($usuario->estudiante!=null): ?>
              <td>{{$usuario->estudiante->v_nombres .' '. $usuario->estudiante->v_apellidos}}</td>
              <?php else: ?>
                <td>{{$usuario->familiar->nombres .' '. $usuario->familiar->apellidos}}</td>
              <?php endif ?>
            <?php endif ?>                        
            <td>{{$usuario->name}}</td>
            <td>
              @foreach($usuario->usuario_rol as $rol)
                {{$rol->v_nombrerol}}<br>
              @endforeach
            </td>          
          </tr> 
          @endforeach        
        </tbody>
      </table>
    </div>
    <div class="box-footer" align="right">                
      <a href="{{ route('listareportes') }}" class="btn btn-primary"><< Regresar</a>
    </div>
    <!-- /.box-body -->
  </div>
@endsection