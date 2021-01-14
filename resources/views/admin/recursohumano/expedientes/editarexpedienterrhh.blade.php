@extends('admin.menuprincipal')
@section('tittle','Recurso Humano')
@section('content')

  <!-- comienza formulario datos personales -->
  <div class="box box-primary box-solid">
    <div class="box-header with-border">
      <h1 class="box-title">ACTUALIZAR EXPEDIENTES</h1>
    </div>
    <!-- /.box-header -->
    @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <!-- form start -->
    {!! Form::open(['route'=>['actualizarexpedienterh',$empleado->id], 'method'=>'PUT','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}    
    {!! Form::hidden('estado','1') !!}       
    <div class="box-body">

     <div class="col-sm-12" align="center">
      <output id="list"> <!--li class="user-header"-->
        <img src="{{asset('/imagenes/Recursohumano/'.$user->foto)}}" height="200px" class="img-circle" alt="User Image">
      <!--/li--> 
    </output> 
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
        {!! Form::label('exp', 'Expediente *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('v_numeroexp',$empleado->v_numeroexp,['class'=>'form-control pull-right','placeholder'=>'Número de expediente','readonly','required']) !!}
        </div>      
      </div>
      <div class="form-group">                                           
        {!! Form::label('nombres', 'Nombres *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('v_nombres',$empleado->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres ','required']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('apellidos', 'Apellidos *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('v_apellidos',$empleado->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos ','required']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('genero', 'Género',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">          
          {!! Form::label('lbfem', 'Femenino',['class'=>'col- control-label']) !!}
          <input type="radio" name="v_genero" class="flat-red" value="Femenino" <?php if($genero=="Femenino"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lbmas', 'Masculino',['class'=>'control-label']) !!}
          <input type="radio" name="v_genero" class="flat-red" value="Masculino" <?php if($genero=="Masculino"){ ?> checked="checked" <?php } ?> >
        </div> 
      </div>
      <div class="form-group">                                           
        {!! Form::label('lblfec', 'Fecha de nacimiento *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="f_fechanaci" id="nac" value="{{$empleado->f_fechanaci}}" onblur="calcular(this,'edad')" onchange="calcular(this,'edad')" class="form-control pull-right nac" data-mask required="true">
          </div>          
        </div>
         </div>
      <div class="form-group">
        {!! Form::label('lbedad', 'Edad (Años)',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('txtedad',$edad,['class'=>'form-control pull-right','id'=>'edad','placeholder'=>'Años','readonly','required']) !!}
        </div>                                         
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbdui', 'DUI *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_dui" class="form-control" value="{{$empleado->v_dui}}" data-inputmask='"mask": "99999999-9","clearIncomplete":"true"' data-mask required="true">
        </div>
         </div>
      <div class="form-group">
        {!! Form::label('lbdui', 'NIT *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_nit" class="form-control" value="{{$empleado->v_nit}}" data-inputmask='"mask": "9999-999999-999-9","clearIncomplete":"true"' data-mask required="true">
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('direccion', 'Dirección *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::textarea('v_direccioncasa',$empleado->v_direccioncasa,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','required']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-phone"></i>
            </div>
            <input type="text" name="v_telcasa" class="form-control tel" value="{{$empleado->v_telcasa}}"  data-mask>
          </div>
        </div>
         </div>
      <div class="form-group">
        {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-phone"></i>
            </div>
            <input type="text" name="v_celular" class="form-control tel" value="{{$empleado->v_celular}}" data-mask>
          </div>
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbcorreo', 'Correo electrónico',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-envelope"></i>
            </div>
          {!! Form::text('v_correo',$empleado->v_correo,['class'=>'form-control pull-right','placeholder'=>'ejemplo@gmai.com','']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lblfechcontra', 'Fecha de contratación',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="f_fechaingresoalCE" value="{{$empleado->f_fechaingresoalCE}}" class="form-control pull-right calendario" data-mask>
          </div>
        </div>                                              
      </div>  
      <div class="form-group">                                           
        {!! Form::label('lbtipopersonal', 'Tipo personal *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('tipopersonal_id',$tiposPersonal, $empleado->tipoPersonal->id,['class'=>'form-control'])!!}
        </div>
         </div>
      <div class="form-group">
        {!! Form::label('lbcargo', 'Cargo *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('cargo_id',$cargos, $empleado->cargo->id,['class'=>'form-control'])!!}
        </div>
      </div> 
       
      <div class="form-group">                                           
        {!! Form::label('lbtipocontrato', 'Tipo de contratación *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('v_tipocontratacion',['SB'=>'Sueldo base','SS'=>'Sobre sueldo','HC'=>'Horas clase'], $empleado->v_tipocontratacion,['class'=>'form-control'])!!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('lbsueldo', 'Salario mensual',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-dollar"></i>
            </div>        
            <input type="text" name="d_sueldo" value="{{$empleado->d_sueldo}}" class="form-control pull-right" data-inputmask="'alias': 'decimal'" data-mask>
          </div>
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbescpeciadlidad', 'Especialidad *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('especialidad_id',$especialidades, $empleado->especialidad->id,['class'=>'form-control'])!!}
        </div>
         </div>
      <div class="form-group">
        {!! Form::label('lbtitulo', 'Titulo Académico',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('v_tituloacademico',$empleado->v_tituloacademico,['class'=>'form-control pull-right','placeholder'=>'Titulo Académico','']) !!}
        </div>
      </div> 
      <div class="form-group">                                           
        {!! Form::label('lblfecingsedu', 'Fecha de ingreso al sistema educativo',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="f_fechaingresoministerio" value="{{$empleado->f_fechaingresoministerio}}" class="form-control pull-right calendario" data-mask>
          </div>
        </div>                                 
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbnivelesc', 'Nivel escalafón',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('v_nivelescalafon',['0'=>'Ninguno','1'=>'Uno','2'=>'Dos'], $empleado->v_nivelescalafon,['class'=>'form-control'])!!}
        </div>
      </div> 
      <div class="form-group">                                           
        {!! Form::label('lbcatescalafon', 'Categoria escalafón',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('v_categoriaescalafon',['0'=>'Ninguno','UA'=>'Uno-A    / Educadores con más de 35 años de servicio activo','UB'=>'Uno-B   / Educadores con más de 30  y hasta 35 años de servicio activo','UC'=>'Uno-C  / Educadores con más de 25 y hasta 30 años de servicio activo','
          D'=>'Dos    / Educadores con más de 20 y hasta 25 años de servicio activo','T'=>'Tres  / Educadores con más de 15 y hasta 20 años de servicio activo','Cu'=>'Cuatro / Educadores con más de 10 y hasta 15 años de servicio activo','C'=>'Cinco  / Educadores con más de 5 y hasta 10 años de servicio activo','S'=>'Seis   / Educadores hasta con 5 años de servicio activo'], $empleado->v_categoriaescalafon,['class'=>'form-control'])!!}
        </div>
      </div>  
      <div class="form-group">                                           
        {!! Form::label('lbnip', 'NIP',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_nip" value="{{$empleado->v_nip}}" class="form-control pull-right" data-inputmask='"mask": "999999999","clearIncomplete":"true"' data-mask>
        </div>
         </div>
      <div class="form-group">
        {!! Form::label('lbnup','NUP',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_nup" value="{{$empleado->v_nup}}" class="form-control pull-right" data-inputmask='"mask": "999999999999","clearIncomplete":"true"' data-mask>
        </div>
      </div>                                                     
    </div>
    <div class="box-footer" align="right">                
      {!! Form::submit('Actualizar', ['class'=>'btn btn-primary']) !!}
      <!--{!! Form::submit('Siguiente >>', ['class'=>'btn btn-primary']) !!}-->
      <a href="{{ route('listaexpedientesrh') }}" class="btn btn-default">Cancelar</a>
    </div>
    {!! Form::close() !!}
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