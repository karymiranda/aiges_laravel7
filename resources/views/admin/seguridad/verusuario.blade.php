@extends('admin.menuprincipal')
@section('tittle','Usuarios/Control de Usuarios/Ver Cuenta')
@section('content')

  <div class="box box-primary box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><Strong>VER CUENTA DE USUARIO</Strong></h3>
    </div>

    <div class="box-body">
      {!! Form::open(['class'=>'form-horizontal']) !!}
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
        {!! Form::label('lbnivelusu', 'Niveles de usuario',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
          <?php if($roles[0]==true){ ?>
          {!! Form::label('sup', 'Super Admin  ',['class'=>'control-label']) !!}
          <?php } ?>
          <?php if($roles[1]==true){ ?>
          {!! Form::label('bono', 'Admin Bono Escolar',['class'=>'control-label ']) !!}<br>
          <?php } ?>
          <?php if($roles[2]==true){ ?>
          {!! Form::label('acti', 'Admin Activo Fijo',['class'=>'control-label']) !!}<br>
          <?php } ?>
          <?php if($roles[3]==true){ ?>
          {!! Form::label('aca', 'Admin Académico',['class'=>'control-label']) !!}<br>
          <?php } ?>
          <?php if($roles[4]==true){ ?>
          {!! Form::label('doc', 'Docente',['class'=>'control-label']) !!}
          <?php } ?>
          <?php if($roles[5]==true){ ?>
          {!! Form::label('est', 'Estudiante',['class'=>'control-label']) !!}
          <?php } ?>
          <?php if($roles[6]==true){ ?>
          {!! Form::label('pf', 'Padre de Familia',['class'=>'control-label']) !!}
          <?php } ?>
          <?php if($roles[7]==true){ ?>
          {!! Form::label('rrhh', 'Admin RRHH',['class'=>'control-label']) !!}
          <?php } ?>          
        </div>
      </div>
    </div><!-- /.BOXBODY--> 
    <div class="box-footer" align="right">                
      <a href="{{ route('listausuariosactivos') }}" class="btn btn-default"> Regresar</a>
    </div>
    {{Form::close()}}	                
	</div>
@endsection