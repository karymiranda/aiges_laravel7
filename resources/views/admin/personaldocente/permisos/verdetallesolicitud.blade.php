@extends('admin.menuprincipal')
@section('tittle','Personal docente/Permisos')
@section('content')


<!-- comienza formulario datos personales -->
  <div class="box box-primary box-solid">
    <div class="box-header with-border">
      <h1 class="box-title">DETALLE SOLICITUD</h1>
    </div>
    <!-- /.box-header -->
    <!-- form start -->           
    <div class="box-body">
      {!! Form::open(['class'=>'form-horizontal']) !!}
      <div class="form-group">                                           
        {!! Form::label('lblfec', 'Fecha',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="f_fechasolicitud" value="{{ $permiso->f_fechasolicitud }}" class="form-control pull-right" readonly="true">
          </div>
        </div>        
      </div>
      <div class="form-group">
        {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('expediente',Auth::user()->empleado->v_numeroexp,['class'=>'form-control pull-right','placeholder'=>'Expediente', 'readonly','id'=>'expediente']) !!}
        </div> 
          </div>  


         <div class="form-group">  
        {!! Form::label('exp', 'NIP *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('nip',null,['class'=>'form-control pull-right','placeholder'=>'Número de Identificaión Personal', 'readonly','id'=>'nip','required']) !!}
        </div>
      </div>


      <div class="form-group">                                     
        {!! Form::label('nombre', 'Nombre completo',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('nombre',Auth::user()->empleado->v_nombres.' '.Auth::user()->empleado->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Nombre completo', 'readonly','id'=>'nombre']) !!}
        </div>
      </div><!--fin form group-->
           
      <div class="form-group"> 
        {!! Form::label('lbmotivo', 'Motivo',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('motivo_id',$motivos, $permiso->motivo_id,['class'=>'form-control','disabled'])!!}
        </div>
      </div>
      <div class="form-group"> 
        {!! Form::label('lblfec', 'Periodo del Permiso',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="periodo" class="form-control pull-right" value="{{ $permiso->f_desde . ' - ' . $permiso->f_hasta }}" readonly="true" required="true">
          </div>
        </div>
          </div> 


      
      <div class="form-group"> 
        {!! Form::label('lbtiemposolicitado', 'Tiempo solicitado (dias)',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('i_tiemposolicitado',$permiso->i_tiemposolicitado,['class'=>'form-control pull-right','placeholder'=>'Tiempo solicitado','id'=>'dias', 'readonly','required']) !!}
        </div>
      </div> 
     
  <div class="form-group">
  {!! Form::label("lbhoraE","Tiempo solicitado (horas)",["class"=>"col-sm-4 control-label"]) !!}
                            <div class="col-sm-2">
                              <div class="input-group">
                                <input type="number" name="i_horas" class="form-control pull-right time start" placeholder="Horas" value="{{$permiso->i_horas}}" readonly="true">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>

                            {!! Form::label("lbhoraS","Minutos",["class"=>"col-sm-1 control-label"]) !!}
                           <div class="col-sm-2">
                              <div class="input-group">
                                <input type="number" name="i_minutos" class="form-control pull-right time end" placeholder="Minutos" value="{{$permiso->i_minutos}}" readonly="true">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
        </div>                


      <div class="form-group">                                           
        {!! Form::label('direccion', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::textarea('v_observaciones',$permiso->v_observaciones,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones','readonly']) !!}
        </div>
      </div>
    </div>        
    <div class="box-footer" align="right">                
      <a href="{{route('historialpermisos')}}" class="btn btn-primary">Regresar</a>
    </div>
    {!! Form::close() !!}
    <!-- /.box-footer -->
  </div>        

@endsection