@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Padres de Familia/Registrar')
@section('content')

<div class="box box-primary box-solid" >
  <!--div class="box col-sm-6 col-sm-offset-3" style="overflow: auto;width:50%;"-->
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>REGISTRAR FAMILIAR</Strong></h3>
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
	{!! Form::open(['route'=>'guardarfamiliar', 'method'=>'POST','class'=>'form-horizontal']) !!}

          <div class="form-group">                                           
                  {!! Form::label('exp', 'Expediente *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                    {!! Form::text('expediente',$expediente,['class'=>'form-control pull-right', 'placeholder'=>'Número de expediente familiar','readonly']) !!}
                      </div>
                                                
           </div>

                  

                 <div class="form-group">                                           
                                                {!! Form::label('nombres ', 'Nombres *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">                                  
                                  <input type="text" name="nombres" value="{{ old('nombres') }}" class="form-control pull-right" placeholder="Nombres" required="true">
                                 </div>
                </div>

                 <div class="form-group">                                           
                                                {!! Form::label('apellidos ', 'Apellidos *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                              
                                                  <input type="text" name="apellidos" value="{{ old('apellidos') }}" class="form-control pull-right" placeholder="Apellidos" required="true">
                                                </div>
                </div>

                <div class="form-group">                                           
                                                {!! Form::label('lbdui', 'DUI',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                   <input type="text" name="dui" value="{{ old('dui') }}" class="form-control" data-inputmask='"mask": "99999999-9","clearIncomplete":"true"' data-mask >
                                                </div>
                                                
                </div>

                <div class="form-group">               
                       
          {!! Form::label('genero', 'Género *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('lbfemenino', 'Femenino',['class'=>'col- control-label']) !!}
          {!! Form::radio('genero','Femenino',true, ['class'=>'flat-red','id'=>'optionsRadios1'])!!}
          {!! Form::label('lbmasculino', 'Masculino',['class'=>'control-label']) !!}
          {!! Form::radio('genero','Masculino',false, ['class'=>'flat-red','id'=>'optionsRadios2'])!!}
          </div> 
           </div>

         
                 


       <div class="form-group">                                           
        {!! Form::label('lblfec', 'Fecha de nacimiento ',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="fechanacimiento" value="{{ old('fechanacimiento') }}" id="nac" onblur="calcular(this,'edad')" onchange="calcular(this,'edad')" class="form-control pull-right nac" data-mask >
          </div>          
        </div>
         </div>
  
  <div class="form-group">
        {!! Form::label('lbedad', 'Edad (Años)',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('txtedad',null,['class'=>'form-control pull-right','id'=>'edad','placeholder'=>'Años','readonly']) !!}
        </div>                                         
      </div>


                <div class="form-group">                                           
                              {!! Form::label('direccion', 'Dirección *',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-5">
                                {!! Form::textarea('direccionderesidencia',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','required']) !!}
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
                                         {!! Form::text('profesion',null,['class'=>'form-control pull-right','placeholder'=>'Profesión u oficio ']) !!} 
                                        </div>
                </div>


                <div class="form-group">                                           
                                                {!! Form::label('lbtrabajo', 'Lugar de trabajo',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('lugardetrabajo',null,['class'=>'form-control pull-right','placeholder'=>'Lugar de trabajo']) !!}
                                                </div>
                </div>
                 <div class="form-group">                                           
                                                {!! Form::label('direcciontrabajo', 'Dirección del trabajo',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('direcciondetrabajo',null,['class'=>'form-control pull-right','placeholder'=>'Dirección del trabajo ']) !!}
                                                </div>
                </div>
                
        

           <div class="form-group">                                           
                        {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                         <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" name="telefonocasa" value="{{ old('telefonocasa') }}" class="form-control tel" placeholder="9999-9999" data-mask>
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
                            <input type="text" name="celular" value="{{ old('celular') }}" class="form-control tel" placeholder="9999-9999" data-mask>
                          </div>
                                                </div>

                                               
          </div>

          <div class="form-group">                                           
                        {!! Form::label('lblteltrabajo', 'Teléfono de trabajo',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                         <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" name="telefonotrabajo" value="{{ old('telefonotrabajo') }}" class="form-control tel" placeholder="9999-9999" data-mask>
                          </div>
                        </div>                
          </div>

          <div class="form-group">                                           
                                                {!! Form::label('lbcorreo', 'Correo electónico',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('correo',null,['class'=>'form-control pull-right','placeholder'=>'ejemplo@gmai.com','']) !!}
                                                </div>
          </div>
                                                            
            </div>        
                
              <div class="box-footer" align="right">  
              {!! Form::submit('Siguiente >>',['class'=>'btn btn-primary ']) !!}  
              <a href="{{route('listafamiliares')}}" class="btn btn-default">Cancelar</a>    
              </div>

                {!! Form::close() !!}
</div>
</div>
@endsection