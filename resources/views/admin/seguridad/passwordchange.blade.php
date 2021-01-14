@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Cambio de Clave de Acceso')
@section('content')

  <div class="box box-primary col-sm-6 col-sm-offset-3 " style="overflow: auto;width:40%;">
    
 <div class="box-header">
              <div class="col-sm-12" align="center">
         <h2> <label class="text-white">CAMBIAR CONTRASEÑA</label></h2>
              </div>
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
      {!! Form::open(['route'=>'myaccountchangepassword','method'=>'POST','class'=>'form-horizontal']) !!}
      {!! Form::hidden('id_usuario',$usuario->id) !!}
       
      <div class="form-group" align="center">
         <div class="col-sm-12 "> 
                 <?php if($usuario->empleado!=null):?>
                 <h3 class="box-title"><Strong>{{$usuario->empleado->v_nombres}}</Strong></h3>
                 <?php endif ?>

                  <?php if($usuario->estudiante!=null):?>
                <h3 class="box-title"><Strong>{{$usuario->estudiante->v_nombres}}</Strong></h3>
                  <?php endif ?>

                   <?php if($usuario->familiar!=null):?>
                <h3 class="box-title"><Strong>{{$usuario->familiar->nombres}}</Strong></h3>
                  <?php endif ?>        
      </div>
       </div>
      
  <!--p class="login-box-msg text-blue">Seguridad de la contraseña:<br> Su nueva contraseña debe incluir al menos 8 caracteres. Mayúsculas, minúsculas, números y símbolos.  </p--> 

<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-gears" align="center"></i> Seguridad de la contraseña:</h4>
               Su nueva contraseña debe incluir al menos 8 caracteres. Mayúsculas, minúsculas, números y símbolos.
</div>



      <div class="col-sm-12"> 
      <div class="form-group has-feedback" >
        <input type="text" class="form-control" value="{{$usuario->name}}" placeholder="Cuenta de usuario" disabled="true">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
    </div>

        <div class="col-sm-12" > 
       <div class="form-group has-feedback">
        <input type="password" class="form-control" name="oldpassword" placeholder="Ingrese su contraseña actual *" required="true">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      </div>

       <div class="col-sm-12" > 
       <div class="form-group has-feedback">
        <input type="password" class="form-control" name="newpassword" placeholder="Nueva contraseña *" required="true">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      </div>

       <div class="col-sm-12" > 
       <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password_confirm" placeholder="Confirmar nueva contraseña *" required="true">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      </div>



     
    </div><!-- /.BOXBODY--> 
    <div class="box-footer" align="right">
      <input type="submit" value="Cambiar contraseña" class="btn btn-primary">              
      <a href="{{route('menu')}}" class="btn btn-default">Cancelar</a>
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