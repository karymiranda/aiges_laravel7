@extends('admin.menuprincipal')
@section('tittle','Administración académica/Padres de Familia/Ver Expediente')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>EXPEDIENTE FAMILIAR</Strong></h3>
            </div>


<div class="box-body">
  {!! Form::open(['route'=>'listafamiliares', 'method'=>'POST','class'=>'form-horizontal']) !!}
   <div class="col-sm-12" align="center">
          <output id="list">  
          @foreach($user as $user)
                                 
             <img src="{{asset('/imagenes/Administracionacademica/Padresdefamilia/'.$user->foto) }}" height="200px" class="image-circle" alt="User Image">
             
          @endforeach
          </output>
      <!--/li-->
                  <hr>
                </div>

          <div class="form-group">                                           
                  {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                    {!! Form::text('expediente',$familiar->expediente,['class'=>'form-control pull-right','placeholder'=>'Número de expediente familiar','readonly']) !!}
                      </div>
                                                
           </div>

                  

                 <div class="form-group">                                           
                                                {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('nombres',$familiar->nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres ','readonly']) !!}
                                                </div>
                </div>

                 <div class="form-group">                                           
                                                {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('apellidos',$familiar->apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos ','readonly']) !!}
                                                </div>
                </div>

                <div class="form-group">                                           
                                                {!! Form::label('lbdui', 'DUI',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('dui',$familiar->dui,['class'=>'form-control pull-right','placeholder'=>'99999999-9','readonly','data-inputmask'=>"'mask': ['99999999-9', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                                                </div>

                                                
                </div>

                <div class="form-group">                                
          {!! Form::label('genero', 'Género',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::label('', 'Femenino',['class'=>'col- control-label']) !!}
          <input type="radio" name="genero" class="flat-red" value="Femenino" <?php if($familiar->genero=="Femenino"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'Masculino',['class'=>'col- control-label']) !!}
          <input type="radio" name="genero" class="flat-red" value="Masculino" <?php if($familiar->genero=="Masculino"){ ?> checked="checked" <?php } ?> >
        </div>           
 </div>

                 


                 <div class="form-group">                                           
        {!! Form::label('lblfec', 'Fecha de nacimiento',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="fechanacimiento" value="{{$familiar->fechanacimiento}}" id="nac" onblur="calcular(this,'edad')" onchange="calcular(this,'edad')" class="form-control pull-right nac" data-mask readonly="true">
          </div>          
        </div>
         </div>

                 <div class="form-group">
        {!! Form::label('lbedad', 'Edad (Años)',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('txtedad',$edad,['class'=>'form-control pull-right','id'=>'edad','placeholder'=>'Años','readonly','readonly']) !!}
        </div>                                         
      </div>


                <div class="form-group">                                           
                                                {!! Form::label('direccion', 'Dirección',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::textarea('direccionderesidencia',$familiar->direccionderesidencia,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','readonly']) !!}
                                                </div>
                </div>

                <div class="form-group">                                           
                                                {!! Form::label('lbniveledu', 'Nivel educativo',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                  {!! Form::select('niveleducativo',['BASICA'=>'BASICO','NOVENO GRADO'=>'NOVENO GRADO','BACHILLERATO'=>'BACHILLERATO','TECNICO'=>'TECNICO','UNIVERSIDAD'=>'UNIVERSIDAD'], $familiar->niveleducativo,['class'=>'form-control','readonly'])!!}
                                                  
                                                </div>
                </div>

                <div class="form-group">                                           
                                                {!! Form::label('lbprofesion', 'Profesión',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('profesion',$familiar->profesion,['class'=>'form-control pull-right','placeholder'=>'Profesión u oficio ','readonly']) !!}
                                                </div>
                </div>


                <div class="form-group">                                           
                                                {!! Form::label('lbtrabajo', 'Lugar de trabajo',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('lugardetrabajo',$familiar->lugardetrabajo,['class'=>'form-control pull-right','placeholder'=>'Lugar de trabajo','readonly']) !!}
                                                </div>
                </div>
                 <div class="form-group">                                           
                                                {!! Form::label('direcciontrabajo', 'Dirección del trabajo',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('direcciondetrabajo',$familiar->direcciondetrabajo,['class'=>'form-control pull-right','placeholder'=>'Dirección del trabajo','readonly']) !!}
                                                </div>
                </div>
                
        

           <div class="form-group">                                           
                        {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                        {!! Form::text('telefonocasa',$familiar->telefonocasa,['class'=>'form-control pull-right','readonly','placeholder'=>'9999-9999','data-inputmask'=>"'mask': ['9999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                        </div>

              </div>

                 <div class="form-group">
                {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                             {!! Form::text('celular',$familiar->celular,['class'=>'form-control pull-right','readonly','placeholder'=>'9999-9999','data-inputmask'=>"'mask': ['9999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                                                </div>

                                               
          </div>

          <div class="form-group">                                           
                        {!! Form::label('lblteltrabajo', 'Teléfono de trabajo',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                         {!! Form::text('telefonotrabajo',$familiar->telefonotrabajo,['class'=>'form-control pull-right','readonly','placeholder'=>'9999-9999','data-inputmask'=>"'mask': ['9999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'']) !!}
                        </div>                
          </div>

          <div class="form-group">                                           
                                                {!! Form::label('lbcorreo', 'Correo electónico',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('correo',$familiar->correo,['class'=>'form-control pull-right','readonly','placeholder'=>'ejemplo@gmai.com','']) !!}
                                                </div>
          </div>
                                                            
            </div>        
                
              <div class="box-footer" align="right">  
              <a href="#" class="btn btn-primary">Imprimir expediente</a>
              <a href="{{route('listafamiliares')}}" class="btn btn-default">Regresar</a>
              </div>

                {!! Form::close() !!}
</div>
</div>
@endsection