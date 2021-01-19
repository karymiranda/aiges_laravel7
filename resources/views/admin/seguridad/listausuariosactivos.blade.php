@extends('admin.menuprincipal')
@section('tittle','Seguridad/Usuarios del Sistema')
@section('content')

  <div class="box box-primary">  
    <div class="box-header">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">USUARIOS DEL SISTEMA</label></h2>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive" align="center">
      <table class="table table-bordered table-striped" style="width: 85%" id="tablaBusqueda">
        <thead> 
        <th>No.</th>        
          <th>NOMBRE DE USUARIO</th>
           <th>CUENTA</th>
            <th>CORREO ELECTRONICO</th>
          <th>ROLES</th>         
          <th>ACCIONES</th>
        </thead>
        <tbody>  
        @foreach($usuarios  as $key=>$usuario)  
        <?php if ($usuario->name!='RH0000-0'): ?>      
          <tr>
             <td>{{$key+1}}</td>  
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
            <td>{{$usuario->email}}</td>
            <td>
              @foreach($usuario->usuario_rol as $rol)
                {{$rol->v_nombrerol}}<br>
              @endforeach
            </td>
            <td>
              <a href="{{route('verusuario',$usuario->id)}}" class="btn btn-primary" title="Ver"><i class="fa fa-eye"></i></a>
              <?php if ($usuario->id==Auth::user()->id): ?>
                <a disabled='true' class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" disabled='true'>
                <i class="fa fa-close"></i>
              </a>
              <?php else: ?>
                <a href="{{route('editarusuario',$usuario->id)}}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#usu_{{$usuario->id}}">
                <i class="fa fa-close"></i>
              </a>
              <?php endif ?>
              <div class="modal fade" id="usu_{{$usuario->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Confirmar Deshabilitar</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Esta seguro, desea deshabiliar la cuenta del usuario <?php if ($usuario->empleado!=null): ?>
                      {{$usuario->empleado->v_nombres .' '. $usuario->empleado->v_apellidos}}
                    <?php else: ?>
                      <?php if ($usuario->estudiante!=null): ?>
                      {{$usuario->estudiante->v_nombres .' '. $usuario->estudiante->v_apellidos}}
                      <?php else: ?>
                        {{$usuario->familiar->nombres .' '. $usuario->familiar->apellidos}}
                      <?php endif ?>
                    <?php endif ?>?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('eliminarusuario',$usuario->id)}}">
                        <input type="hidden" name="id" value="{{$usuario->id}}">
                        <input type="submit" value="Deshabilitar" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>                
          </tr>
            <?php endif ?> 
          @endforeach        
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection