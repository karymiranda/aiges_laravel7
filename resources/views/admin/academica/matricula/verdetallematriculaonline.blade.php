@extends('admin.menuprincipal')
@section('tittle', 'Administración Académica/Matrícula/Solicitudes en Linea')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header ">
              <h3 class="box-title"><Strong>SOLICITUD MATRICULA</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
    {!! Form::open(['route'=>'agregarseccion', 'method'=>'POST','class'=>'form-horizontal']) !!}   
      @foreach($datos->estudiante_seccion as $pivote)
                <div class="form-group"> 
                <div class="col-sm-8"></div>                                          
                                              
                                                <div class="col-sm-4">
                 <!--a href="{{route('listasolicitudesmatricula')}}" class="btn btn-warning">Consultar calificaciones</a-->
                  </div>                                                                    
                </div><!--fin form group-->
       
        <div class="form-group">                  
               {!! Form::label('fecha', 'Fecha de solicitud',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-4"> 
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {!! Form::text('txtfecha',$fecha,['class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>'Fecha de solicitud de inscripción','readonly']) !!}
              </div> 
  </div> 
</div>
  <div class="form-group">
              {!! Form::label('estado', 'Estado de solicitud',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-4">
           {!! Form::label('lbfsi', 'Pendiente',['class'=>'col- control-label']) !!}         
          <input type="radio" name="v_estadomatricula" class="flat-red" value="Pendiente" <?php if($pivote->pivot->v_estadomatricula="pendiente"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lbno', 'Aprobada',['class'=>'control-label']) !!}
          <input type="radio" name="v_estadomatricula" class="flat-red" value="Aprobada" <?php if($pivote->pivot->v_estadomatricula=="aprobada"){ ?> checked="checked" <?php } ?> >
           </div>
          </div><!--fin form group-->
            
     <div class="form-group">                                           
                                       
      {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-4">                                         
                                               
                                                  {!! Form::text('txtexp',$datos->v_expediente,['class'=>'form-control pull-right','placeholder'=>'Número de expediente estudiantil','readonly']) !!}        
                                                </div>
                                                 </div> 
  <div class="form-group">

                                                 {!! Form::label('nie', 'NIE',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('NIE',$datos->v_nie,['class'=>'form-control pull-right','placeholder'=>'Número de identificación del estudiante','readonly']) !!}
                                                </div>

                                                
                          </div>
                   
            <div class="form-group">                                           
                                                {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('txtnombres',$datos->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres','readonly']) !!}
                                                </div>
                                                 </div> 
  <div class="form-group">
                                                {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('txtapellidos',$datos->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos','readonly']) !!}
                                                </div>
                </div>
                   
           
                     <div class="form-group">                                           
                        {!! Form::label('lbgrado', 'Grado',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-4">
                          {!! Form::text('grado',$pivote->seccion_grado->grado,['class'=>'form-control pull-right','placeholder'=>'Grado','readonly']) !!}
                          </div>
                           </div> 
  <div class="form-group">
                          {!! Form::label('lbseccion', 'Sección',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-4">
                        {!! Form::text('seccion',$pivote->seccion,['class'=>'form-control pull-right','placeholder'=>'Sección','readonly']) !!}
                       </div>
              </div>
                       
                 <div class="form-group">                                           
                        {!! Form::label('lbturno', 'Turno',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-4">
                         {!! Form::text('turno',$pivote->seccion_turno->turno,['class'=>'form-control pull-right','placeholder'=>'Turno','readonly']) !!}
                       </div>
                        </div> 
  <div class="form-group">
                       {!! Form::label('lbasesor', 'Docente Asesor',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                  @if($pivote->seccion_empleado!=null)
                                                     {!! Form::text('txtdasesor',$pivote->seccion_empleado->v_nombres.' '.$pivote->seccion_empleado->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','readonly']) !!}
                                                     @else
                                                     {!! Form::text('txtdasesor',null,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','readonly']) !!}
                                                  @endif
                            
                                                </div>
                </div>

                <hr><h5 align="center">MATRICULADO POR</h5><hr>
                 <div class="form-group">                                           
                                                {!! Form::label('exppadre', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
                                  <div class="col-sm-4">
                                  <input type="text" class="form-control pull-right" name="familiar_exp" value="{{$pivote->pivot->familiar_exp}}" id="expedientefamiliar" readonly="true" <?php if($pivote->pivot->familiar_exp==null){ ?> placeholder="No Aplica" <?php } ?>  <?php if($pivote->pivot->familiar_exp!=null){ ?> placeholder="Expediente del familiar" <?php } ?>> 
                                                                                              
                                                </div>
                                                 </div> 
  <div class="form-group">
          {!! Form::label('nombre', 'Nombre del pariente ',['class'=>'col-sm-4 control-label']) !!}      
                                         <div class="col-sm-4">
             <input type="text" class="form-control pull-right" name="familiar_nombre" value="{{$pivote->pivot->familiar_nombre}}" id="nombrefamiliar" readonly="true" <?php if($pivote->pivot->familiar_nombre==null){ ?> placeholder="No Aplica" <?php } ?>  <?php if($pivote->pivot->familiar_nombre!=null){ ?> placeholder="Nombre del familiar" <?php } ?>>
             </div>                               
                                                
                </div><!--fin form group-->
                       
              </div><!--finaliza box body-->         
               @endforeach 
              <div class="box-footer" align="right">                
                  <a href="{{route('aprobarsolicitudmatriculaonline',[$datos->id,$pivote->pivot->seccion_id])}}" class="btn btn-success"><i class="fa fa-check"></i> Aprobar</a>
                      <a class="btn btn-danger" data-toggle="modal" title="Denegar" data-target="#solicitud_{{$datos->id}}"><i class="fa fa-close"></i> Denegar</a>
                  <a href="{{route('listasolicitudesmatricula')}}" class="btn btn-default">Regresar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->

              <div class="modal fade" id="solicitud_{{$datos->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">DENEGAR SOLICITUD DE MATRICULA</h4>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro, desea denegar la solicitud de matricula del estudiante:  {{$datos->v_nombres}} {{$datos->v_apellidos}}?</p> 
                       <p> Este proceso borrará la solicitud del sistema</p>
                      </div>
                      <div class="modal-footer">
          <form method="GET" action="{{route('eliminarsolicitudmatriculaonline',[$datos->id,$pivote->pivot->seccion_id])}}">
                         
                          <input type="submit" value="Aceptar" class="btn btn-sm btn-danger delete-btn">                               
                          <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

          </div>





@endsection
