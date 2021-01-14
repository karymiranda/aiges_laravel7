@extends('admin.menuprincipal')
@section('tittle','Sin acceso')
@section('content')
<div class="box-body">
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h2><i class="icon fa fa-ban"></i> ACCESO RESTRINGIDO!</h2>
                <h3>  Lo sentimos, usted no tiene acceso al contenido solicitado. <h3>
              </div>
@endsection