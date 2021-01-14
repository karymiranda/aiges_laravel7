@extends('admin.menuprincipal')
@section('tittle','Familiares/Expediente en linea')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>EXPEDIENTE PERSONAL</Strong></h3>
            </div>

 {!! Form::open(['route'=>['actualizarpadredefamilia',$familiar->id], 'method'=>'PUT','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
 {!! Form::hidden('id',$familiar->id) !!}

  @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

<!--div class="box-body">
  <div class="col-sm-4">
 {!! Form::label('exp', 'Expediente *',['class'=>'col-sm-4 control-label']) !!}
  </div>

  <div class="col-sm-8">
 {!! Form::label('exp', 'Expediente *',['class'=>'col-sm-4 control-label']) !!}
  </div-->

   <div class="col-sm-12" align="center">
          <output id="list">  
          @foreach($user as $user)                                
              <img src="{{asset('/imagenes/Administracionacademica/Padresdefamilia/'.$user->foto)}}" height="200px" class="image-circle" alt="User Image"> 
            
          @endforeach
          </output>
          <hr>
    </div>
      <!--div class="col-sm-12">
               <div class="form-group">
                  {!! Form::label('lbfoto', 'Fotografía',['class'=>'col-sm-4 control-label']) !!}

                  <div class="col-sm-8">                   
    <input type="file" id="files" name="txtfoto" accept="image/*" />                  
                  </div>               
                </div>
                <hr>
            </div>

          <div class="form-group">                                           
                  {!! Form::label('exp', 'Expediente *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                    {!! Form::text('expediente',$familiar->expediente,['class'=>'form-control pull-right','placeholder'=>'Número de expediente familiar','readonly']) !!}
                      </div>
                                                
           </div-->

                  

                 <div class="form-group">                                           
                                                {!! Form::label('nombres', 'Nombres *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('nombres',$familiar->nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres ','required']) !!}
                                                </div>
                </div>

                 <div class="form-group">                                           
                                                {!! Form::label('apellidos', 'Apellidos *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('apellidos',$familiar->apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos ','required']) !!}
                                                </div>
                </div>

                <div class="form-group">                                           
                                                {!! Form::label('lbdui', 'DUI',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                <input type="text" name="dui" value="{{ $familiar->dui }}" class="form-control" data-inputmask='"mask": "99999999-9","clearIncomplete":"true"' data-mask >
                                                </div>                                                
                </div>

                <div class="form-group">                                
          {!! Form::label('genero', 'Género *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::label('', 'Femenino',['class'=>'col- control-label']) !!}
          <input type="radio" name="genero" class="flat-red" value="Femenino" <?php if($familiar->genero=="Femenino"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'Masculino',['class'=>'col- control-label']) !!}
          <input type="radio" name="genero" class="flat-red" value="Masculino" <?php if($familiar->genero=="Masculino"){ ?> checked="checked" <?php } ?> >
        </div>           
 </div>


        

                           


                 <div class="form-group">                                           
        {!! Form::label('lblfec', 'Fecha de nacimiento ',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="fechanacimiento" value="{{$familiar->fechanacimiento}}" id="nac" onblur="calcular(this,'edad')" onchange="calcular(this,'edad')" class="form-control pull-right nac" data-mask>
          </div>          
        </div>
         </div>

                 <div class="form-group">
        {!! Form::label('lbedad', 'Edad (Años)',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('txtedad',$edad,['class'=>'form-control pull-right','id'=>'edad','placeholder'=>'Años','readonly']) !!}
        </div>                                         
      </div>


                <div class="form-group">                                           
                                                {!! Form::label('direccion', 'Dirección *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::textarea('direccionderesidencia',$familiar->direccionderesidencia,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','required']) !!}
                                                </div>
                </div>

                <div class="form-group">                                           
                                                {!! Form::label('lbniveledu', 'Nivel educativo *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                              {!! Form::select('niveleducativo',['BASICA'=>'BASICO','NOVENO GRADO'=>'NOVENO GRADO','BACHILLERATO'=>'BACHILLERATO','TECNICO'=>'TECNICO','UNIVERSIDAD'=>'UNIVERSIDAD'], null,['class'=>'form-control'])!!}
                                                </div>
                </div>

                <div class="form-group">                                           
                                                {!! Form::label('lbprofesion', 'Profesión',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('profesion',$familiar->profesion,['class'=>'form-control pull-right','placeholder'=>'Profesión u oficio ']) !!}
                                                </div>
                </div>


                <div class="form-group">                                           
                                                {!! Form::label('lbtrabajo', 'Lugar de trabajo',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('lugardetrabajo',$familiar->lugardetrabajo,['class'=>'form-control pull-right','placeholder'=>'Lugar de trabajo']) !!}
                                                </div>
                </div>
                 <div class="form-group">                                           
                                                {!! Form::label('direcciontrabajo', 'Dirección del trabajo',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('direcciondetrabajo',$familiar->direcciondetrabajo,['class'=>'form-control pull-right','placeholder'=>'Dirección del trabajo']) !!}
                                                </div>
                </div>
                
        

           <div class="form-group">                                           
                        {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                        {!! Form::text('telefonocasa',$familiar->telefonocasa,['class'=>'form-control pull-right','placeholder'=>'9999-9999','data-inputmask'=>"'mask': ['9999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                        </div>

              </div>

                 <div class="form-group">
                {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                             {!! Form::text('celular',$familiar->celular,['class'=>'form-control pull-right','placeholder'=>'9999-9999','data-inputmask'=>"'mask': ['9999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                                                </div>

                                               
          </div>

          <div class="form-group">                                           
                        {!! Form::label('lblteltrabajo', 'Teléfono de trabajo',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                         {!! Form::text('telefonotrabajo',$familiar->telefonotrabajo,['class'=>'form-control pull-right','placeholder'=>'9999-9999','data-inputmask'=>"'mask': ['9999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                        </div>                
          </div>

          <div class="form-group">                                           
                                                {!! Form::label('lbcorreo', 'Correo electrónico',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('correo',$familiar->correo,['class'=>'form-control pull-right','placeholder'=>'ejemplo@gmai.com','']) !!}
                                                </div>
          </div>
                                                            
                 
                
              <div class="box-footer" align="right">  
              <a href="{{route('actualizarexpedientefamiliaronline',$familiar->id)}}" >Actualizar información de expediente </a><!--i class="fa fa-edit"></i-->
              </div-->
  </div> 
                {!! Form::close() !!}
</div>
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
  document.getElementById('files').addEventListener('change',archivo,false);
</script>
@endsection