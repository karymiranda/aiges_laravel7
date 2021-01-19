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
          
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection