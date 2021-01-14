@extends('admin.menuprincipal')
@section('tittle','Usuario/Control de Usuarios/Actualizar Cuenta')
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
      {!! Form::open(['route'=>['actualizarcuenta'],'method'=>'PUT','class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
      {!! Form::hidden('id_usuario',Auth::user()->id) !!}
      <div class="col-sm-12" align="center">
        <?php if (Auth::user()->empleado!=null): ?>
          <output id="list"><img src="{{asset('/imagenes/Recurso humano/{{ Auth::user()->foto }}" height="200px" class="img-circle" alt="User Image"></output>
        <?php else: ?>
          <?php if (Auth::user()->estudiante!=null): ?>
            <output id="list"><img src="/imagenes/Administracion academica/Estudiantes/{{ Auth::user()->foto }}" height="200px" class="img-circle" alt="User Image"></output>
          <?php else: ?>
            <output id="list"><img src="/imagenes/Administracion academica/Padres de familia/{{ Auth::user()->foto }}" height="200px" class="img-circle" alt="User Image"></output>
          <?php endif ?>
        <?php endif ?> 
        <hr>
      </div>
      <div class="col-sm-12">
        <div class="form-group">
          {!! Form::label('lbfoto', 'Fotografía',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-8">                   
            <input type="file" id="files" name="txtfoto" accept="image/*" />                  
          </div>               
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbusuario', 'Cuenta',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-2">
          {!! Form::text('name',Auth::user()->name,['class'=>'form-control pull-right','placeholder'=>'Cuenta de usuario','','readonly'=>'true']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbusuario', 'Usuario',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          <input type="text" name="usuario" value="<?php if(Auth::user()->empleado!=null){ ?>{{Auth::user()->empleado->v_nombres . ' ' . Auth::user()->empleado->v_apellidos}}<?php }else{ if(Auth::user()->estudiante!=null){ ?>{{Auth::user()->estudiante->v_nombres . ' ' . Auth::user()->estudiante->v_apellidos}}<?php }else{ ?>{{Auth::user()->familiar->nombres . ' ' . Auth::user()->familiar->apellidos}}<?php }}?>" readonly='true' class='form-control pull-right'>
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbclave', 'Contraseña Anterior',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-3">
          {!! Form::password('oldpassword',['class'=>'form-control pull-right','placeholder'=>'Contraseña Anterior','required']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbclave2', 'Nueva Contraseña',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-3">
          {!! Form::password('newpassword',['class'=>'form-control pull-right','placeholder'=>'Nueva Contraseña']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbclave3', 'Repetir Nueva Contraseña',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-3">
          {!! Form::password('newpassword2',['class'=>'form-control pull-right','placeholder'=>'Repetir Nueva Contraseña']) !!}
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
      <input type="submit" name="actualizar" value="Actualizar" class="btn btn-primary">              
      <a href="{{ route('menu') }}" class="btn btn-default">Cancelar</a>
    </div>
    {{Form::close()}}	                
	</div>
@endsection
@section('script')
<script>
  function archivo(evt) {
    var files = evt.target.files; // FileList object
       
    //Obtenemos la imagen del campo "file". 
    for (var i = 0, f; f = files[i]; i++) {         
      //Solo admitimos imágenes.
      if (!f.type.match('image.*')) {
        continue;
      }
   
      var reader = new FileReader();
           
      reader.onload = (function(theFile) {
        return function(e) {
          // Creamos la imagen.
          document.getElementById("list").innerHTML = ['<img class="img-circle" height="250px" alt="User Image" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
        };
      })(f);
 
      reader.readAsDataURL(f);
    }
  }
             
  document.getElementById('files').addEventListener('change', archivo, false);
</script>
@endsection