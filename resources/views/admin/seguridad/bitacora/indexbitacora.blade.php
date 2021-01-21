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
               
              </tbody>
            </table>
            </div>
          </div>
@endsection
