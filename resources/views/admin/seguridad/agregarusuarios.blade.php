@extends('admin.menuprincipal')
@section('tittle','Seguridad/Control de Usuarios/Registrar Nuevo Usuario')
@section('content')


<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">REGISTRAR NUEVO USUARIO</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">
      {!! Form::open(['route'=>'agregarusuario', 'method'=>'POST']) !!}
      <div class="form-group">                                           
        {!! Form::label('lbnivelusu', 'Nivel de usuario',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
          {!! Form::select('type',[''=>'Seleccione un nivel de usuario','admin'=>'Super administrador','Adminbono'=>'Administrador bono escolar','Adminactivo'=>'Administrador activo fijo','Adminaca'=>'Administrador académico','docente'=>'Docente','estu'=>'Estudiante','padre'=>'Padre de familia'], null,['class'=>'form-control'])!!}
                                                </div>
                </div>
                
                 <div class="form-group">                                           
                                                {!! Form::label('idusuario', 'Id usuario',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                {!! Form::text('txtidusuario',null,['class'=>'form-control pull-right','placeholder'=>'Id usuario','required']) !!}
                                                </div>
                </div>

                 <div class="form-group">                                           
                                                {!! Form::label('lbusuario', 'Usuario',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                {!! Form::text('txtusuario',null,['class'=>'form-control pull-right','placeholder'=>'Nombre de usuario','required']) !!}
                                                </div>
                </div>

                 <div class="form-group">                                           
                                                {!! Form::label('lbpass', 'Contraseña',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                {!! Form::password('txtclave',null,['class'=>'form-control pull-right','required']) !!}
                                                </div>
                </div>
                <div class="form-group">                                           
                                                {!! Form::label('lbrepas', 'Repetir contraseña',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                {!! Form::password('txtreclave',null,['class'=>'form-control pull-right','required']) !!}
                                                </div>
                </div>


                


                
              </div>
              <!-- /.box-body -->
              <div class="box-footer" align="right">                
                 {!! Form::submit('Registrar',['class'=>'btn btn-primary btn-flat']) !!}
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
            </form>
          </div>


  @endsection