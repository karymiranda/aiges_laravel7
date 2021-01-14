@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Crear Cuenta de Usuario')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><Strong>CREAR CUENTA DE USUARIO DEL EMPLEADO:</h3> <h3 class=" box-title text-white">{{ $empleado->v_nombres . ' ' . $empleado->v_apellidos }}</Strong></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
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
    {!! Form::open(['route'=>'agregarusuariorh', 'method'=>'POST', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
    {!! Form::hidden('id',$empleado->id) !!}
    <div class="col-sm-12" align="center">
      <!--li class="user-header"-->
        <output id="list"><img src="{{ asset('imagenes/Recursohumano/nofound.jpg') }}" height="200px" class="img-circle" alt="User Image"></output>
      <!--/li-->
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
      {!! Form::label('lbusuario', 'Usuario',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('name',$empleado->v_numeroexp,['class'=>'form-control pull-right','placeholder'=>'Cuenta de usuario','','readonly'=>'true']) !!}
      </div>
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbclave', 'Contraseña',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('password',$contraseña,['class'=>'form-control pull-right','placeholder'=>'Clave de ingreso','','readonly'=>'true']) !!}
      </div>
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbnivelusu', 'Niveles de usuario',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-8">
        {!! Form::label('sup', 'Super Admin  ',['class'=>'control-label']) !!}
        {!! Form::checkbox('nivel[]', '1', false,['id'=>'super'])!!}<br>
        {!! Form::label('bono', 'Admin Bono Escolar',['class'=>'control-label ']) !!}
        {!! Form::checkbox('nivel[]', '2', false,['class'=>'check'])!!}<br>
        {!! Form::label('acti', 'Admin Activo Fijo',['class'=>'control-label']) !!}
        {!! Form::checkbox('nivel[]', '3', false,['class'=>'check'])!!}<br>
        {!! Form::label('aca', 'Admin Académico',['class'=>'control-label']) !!}
        {!! Form::checkbox('nivel[]', '4', false,['class'=>'check'])!!}<br>
        {!! Form::label('doc', 'Docente',['class'=>'control-label']) !!}
        {!! Form::checkbox('nivel[]', '5', false,['class'=>'check'])!!}<br>
        {!! Form::label('rrhh', 'Admin RRHH',['class'=>'control-label']) !!}
        {!! Form::checkbox('nivel[]', '8', false,['class'=>'check'])!!}
      </div>
    </div>

  </div>
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
  <div class="box-footer" align="right">                
    {!! Form::submit('Siguiente >>',['class'=>'btn btn-primary ']) !!}                                 
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->
</div>
 @endsection
 @section('script')
  <script>
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