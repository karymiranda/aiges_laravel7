@extends('admin.menuprincipal')
@section('tittle','Usuarios/Control de Usuarios/Actualizar Cuenta')
@section('content')

  <div class="box box-primary box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><Strong>ACTUALIZAR CUENTA DE USUARIO</Strong></h3>
    </div>
    @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="box-body">
      {!! Form::open(['route'=>['actualizarusuario',$usuario->id],'method'=>'PUT','class'=>'form-horizontal']) !!}
      {!! Form::hidden('id_usuario',$usuario->id) !!}
      <div class="col-sm-12" align="center">
        <?php if ($usuario->empleado!=null): ?>
          <output id="list"><img src="{{asset('/imagenes/Recursohumano/'.$usuario->foto)}}" height="200px" class="img-circle" alt="User Image"></output>
        <?php else: ?>
          <?php if ($usuario->estudiante!=null): ?>
            <output id="list"><img src="{{asset('/imagenes/Administracionacademica/Estudiantes/'.$usuario->foto)}}" height="200px" class="img-circle" alt="User Image"></output>
          <?php else: ?>
            <output id="list"><img src="{{asset('/imagenes/Administracionacademica/Padresdefamilia/'.$usuario->foto)}}" height="200px" class="img-circle" alt="User Image"></output>
          <?php endif ?>
        <?php endif ?> 
        <hr>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbusuario', 'Cuenta',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-2">
          {!! Form::text('name',$usuario->name,['class'=>'form-control pull-right','placeholder'=>'Cuenta de usuario','','readonly'=>'true']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbusuario', 'Usuario',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          <input type="text" name="usuario" value="<?php if($usuario->empleado!=null){ ?>{{$usuario->empleado->v_nombres . ' ' . $usuario->empleado->v_apellidos}}<?php }else{ if($usuario->estudiante!=null){ ?>{{$usuario->estudiante->v_nombres . ' ' . $usuario->estudiante->v_apellidos}}<?php }else{ ?>{{$usuario->familiar->nombres . ' ' . $usuario->familiar->apellidos}}<?php }}?>" readonly='true' class='form-control pull-right'>
        </div>
      </div>
      <div class="form-group">                                           
      {!! Form::label('lbclave', 'Generar Nueva Contraseña',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        <div class="input-group">        
          {!! Form::text('password',null,['class'=>'form-control pull-right','placeholder'=>'Clave de ingreso','id'=>'pass','readonly'=>'true']) !!}
           <span class="input-group-btn">
              <a id="generarPassword" class="btn btn-primary">Generar</a>
            </span>
            <span class="input-group-btn">
              <a id="btnCancel" class="btn btn-default">Cancelar</a>
            </span>
        </div>
      </div>
    </div>
      <div class="form-group">                                           
        {!! Form::label('lbnivelusu', 'Niveles de usuario',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
          <?php if($roles[5]==false && $roles[6]==false){ ?>
          {!! Form::label('sup', 'Super Admin  ',['class'=>'control-label']) !!}
          {!! Form::checkbox('nivel[]', '1', $roles[0],['id'=>'super'])!!}<br>
          {!! Form::label('bono', 'Admin Bono Escolar',['class'=>'control-label ']) !!}
          {!! Form::checkbox('nivel[]', '2', $roles[1],['class'=>'check'])!!}<br>
          {!! Form::label('acti', 'Admin Activo Fijo',['class'=>'control-label']) !!}
          {!! Form::checkbox('nivel[]', '3', $roles[2],['class'=>'check'])!!}
          </div>
           {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
           <div class="col-sm-8">            
          {!! Form::label('aca', 'Admin Académico',['class'=>'control-label']) !!}
          {!! Form::checkbox('nivel[]', '4', $roles[3],['class'=>'check'])!!}<br>
          {!! Form::label('doc', 'Docente',['class'=>'control-label']) !!}
          {!! Form::checkbox('nivel[]', '5', $roles[4],['class'=>'check'])!!}<br>
          <?php } ?>
          <?php if($roles[5]==true){ ?>
          {!! Form::label('est', 'Estudiante',['class'=>'control-label']) !!}
          <div style="display: none;">
          {!! Form::checkbox('nivel[]', '6', $roles[5])!!}
          </div>
          <?php } ?>
          <?php if($roles[6]==true){ ?>
          {!! Form::label('pf', 'Padre de Familia',['class'=>'control-label']) !!}
          <div style="display: none;">
          {!! Form::checkbox('nivel[]', '7', $roles[6])!!}
          </div>
          <?php } ?>
          <?php if($roles[5]==false && $roles[6]==false){ ?>
          {!! Form::label('rrhh', 'Admin RRHH',['class'=>'control-label']) !!}
          {!! Form::checkbox('nivel[]', '8', $roles[7],['class'=>'check'])!!}
          <?php } ?>
        </div>
      </div>
    </div><!-- /.BOXBODY--> 
    <div class="box-footer" align="right">
      <input type="submit" name="actualizar" value="Actualizar" class="btn btn-primary">              
      <a href="{{ route('listausuariosactivos') }}" class="btn btn-default">Cancelar</a>
    </div>
    {{Form::close()}}	                
	</div>
@endsection
@section('script')
<script>
  $('#generarPassword').on('click',function(){
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 8; i++ ){
       text += possible.charAt(Math.floor(Math.random() * possible.length));
     }
    $('#pass').val(text);
  });
  $('#btnCancel').on('click',function(){
    $('#pass').val('');
  });
  $(document).ready(function() {
    $('#super').change(function() {
        if(this.checked) {            
            $('.check').prop('checked', false);
        }      
    });
    $('.check').change(function() {
        if(this.checked) {            
            $('#super').prop('checked', false);
        }      
    });
  });
</script>
@endsection