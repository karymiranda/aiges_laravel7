@extends('admin.menuprincipal')
@section('tittle','Administración académica/Padres de Familia/Crear Usuario')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>CUENTA DE USUARIO: {{ $familiar->nombres. ' ' .$familiar->apellidos }} </Strong></h3>
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
                 {!! Form::open(['route'=>'guardarusuariofamiliar', 'method'=>'POST', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
           <input type="hidden" name="id" value="{{$familiar->id}}">  

          <div class="col-sm-12" align="center">
            <!--li class="user-header"--><output id="list"><img src="{{ asset('/imagenes/Administracionacademica/Padresdefamilia/nofound.jpg') }}" height="200px" class="image-circle" alt="User Image"></output>
      <!--/li-->
              <hr>
          </div>

          

            <div class="col-sm-12">
               <div class="form-group">
                  {!! Form::label('lbfoto', 'Fotografía',['class'=>'col-sm-4 control-label']) !!}

                  <div class="col-sm-8">                   
    <input type="file" id="files" name="txtfoto" accept="image/*" />                  
                  </div>               
                </div><hr>
            </div>


          
            <div class="form-group">                                           
                                                {!! Form::label('lbusuario', 'Usuario',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('name',$familiar->expediente,['class'=>'form-control pull-right','placeholder'=>'Cuenta de usuario','readonly']) !!}
                                                </div>
              </div>
              <div class="form-group">                                           
                                                {!! Form::label('lbclave', 'Contraseña',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('password',$clave,['class'=>'form-control pull-right','placeholder'=>'Clave de ingreso','readonly']) !!}
                                                </div>
              </div> 
               <div class="form-group">                                           
                                                {!! Form::label('lbnivelusuario', 'Nivel usuario',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                 {!! Form::select('rolusuario_id', $rol, null,['class'=>'form-control pull-right'])!!}
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
                      document.getElementById("list").innerHTML = ['<img  height="250px" alt="User Image" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
               };
           })(f);
 
           reader.readAsDataURL(f);
       }
}
             
      document.getElementById('files').addEventListener('change', archivo, false);
      </script>

              <div class="box-footer" align="right">                
                 {!! Form::submit('Finalizar',['class'=>'btn btn-primary ']) !!}             
                  
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
           
          </div>

 @endsection

  

