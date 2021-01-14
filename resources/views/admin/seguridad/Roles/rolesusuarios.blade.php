@extends('admin.menuprincipal')
@section('tittle','Configuraciones/ roles de usuarios')
@section('content')

  <div class="box box-primary">
    <div class="box-header">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary" >ROLES DE USUARIOS</label></h2>
        </div>
      <div class="col-sm-8 " align="right">          
        <!--a href="#" class="btn btn-primary">Agregar rol</a-->
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive" align="center">
      <table class="table table-bordered table-striped" id="tablaBusqueda" style="width: 75%">
        <thead>          
          <th>ROL USUARIO</th>         
          <th>ACCIONES</th>
        </thead>
        <tbody>  
        @foreach($roles as $roles)       
          <tr>
            <td>{{$roles->v_nombrerol}}</td>
            <td>
              <a href="#" class="btn btn-primary" disabled="true"><i class="fa fa-eye"></i></a>
              <a href="#" class="btn btn-success" disabled="true"><i class="fa fa-edit"></i></a>
              <a href="#" class="btn btn-danger" disabled="true"><i class="fa fa-close"></i></a>
            </td>                
          </tr> 
          @endforeach        
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection