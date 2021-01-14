@extends('admin.menuprincipal')
@section('tittle','Seguridad/Bitácora del sistema')
@section('content')
<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
             <h2> <label class="text-primary">BITACORA</label></h2>
              </div> 
             
            </div>
             <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                  <th>No.</th>
                  <th>FECHA</th>
                   <th>EXPEDIENTE</th>                  
                  <th>USUARIO</th>
                  <th>OPERACIONES REALIZADAS</th>
                </thead>
                <tbody>
                @foreach($bitacora as $key => $row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->created_at}}</td>
                  <td>{{$row->bitacora_usuarios->name}}</td>
                  <td>{{$row->usuario_nombre}}</td>
                  <?php $obj=json_decode($row->operacion);
                  ?>                  
                  <td><?php print $obj->{'operacion'} ?></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
          </div>
@endsection
