@extends('admin.menuprincipal')
@section('tittle', 'Administración académica/Matrícula/Ver Matrícula')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>VER MATRICULA</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                 {!! Form::open(['route'=>'listadematriculados', 'method'=>'POST','class'=>'form-horizontal']) !!}
                 <input type="hidden" name="estudiante_id" id="" >
                 <input type="hidden" name="familiar_id" id="" >
       @foreach($datos->estudiante_seccion as $matricula)       
      <div class="form-group">                                           
                                                {!! Form::label('lblfec', 'Fecha de matrícula',['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-5">

                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" value="{{$fecha}}" name="fecha" id="fecha"  class="form-control pull-right nac" data-mask required="true" class="form-control pull-right" required="true" readonly="true">
                                </div>
                                </div>
 </div>

  <div class="form-group">
                 {!! Form::label('periodo', 'Año académico ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
                <select id="anio" class="form-control" readonly="true">
                  <option value="{{$matricula->pivot->anio}}">{{$matricula->pivot->anio}}</option>
                </select>
              </div>
          </div>

<div class="form-group">
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
                {!! Form::label('no', 'Nuevo ingreso',['class'=>'control-label']) !!}
          <input type="radio" name="v_nuevoingresoSN" class="flat-red" value="SI" <?php if($matricula->pivot->v_nuevoingresoSN=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'Antiguo ingreso',['class'=>'control-label']) !!}
          <input type="radio" name="v_nuevoingresoSN" class="flat-red" value="NO" <?php if($matricula->pivot->v_nuevoingresoSN=="NO"){ ?> checked="checked" <?php } ?> > 
            </div>                        
        </div>



                 <div class="form-group">
                               {!! Form::label('lbcertificado', 'Presentó certificado',['class'=>'col-sm-4 control-label']) !!} 
      <div class="col-sm-5">
            {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
      <input type="radio" name="certificadoRadios" class="flat-red" value="SI" <?php if($matricula->pivot->v_presentocertificadoSN=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
     <input type="radio" name="certificadoRadios" class="flat-red" value="NO" <?php if($matricula->pivot->v_presentocertificadoSN=="NO"){ ?> checked="checked" <?php } ?> > 
      </div>
           </div> 

      <div class="form-group">                                               
              {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
                       <div class="col-sm-5">   
                        
                        {!! Form::text('expediente',$datos->v_expediente,['class'=>'form-control pull-right','id'=>'expediente','placeholder'=>'Número de expediente','required','readonly']) !!}                                                  
                    </div>
                     </div>

                 <div class="form-group">

                                                 {!! Form::label('nie', 'NIE',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('NIE',$datos->v_nie,['class'=>'form-control pull-right','placeholder'=>'Número de identificación del estudiante','id'=>'nie','readonly']) !!}
                                                </div>
                                                
                                                
                </div><!--fin form group-->
              
            <div class="form-group">                                           
                                                {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('txtnombres',$datos->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres','required','id'=>'nombres','readonly']) !!}
                                                </div>
                                                 </div>

                 <div class="form-group">

                                                {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('txtapellidos',$datos->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos','required','id'=>'apellidos','readonly']) !!}
                                                </div>
                </div>
               
                <div class="form-group">
          {!! Form::label('', 'Matricula',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
                {!! Form::label('no', 'Inicial',['class'=>'control-label']) !!}
          <input type="radio" name="matriculaRadios" class="flat-red" value="1" <?php if($matricula->pivot->matricula=="1"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'repitencia',['class'=>'control-label']) !!}
          <input type="radio" name="matriculaRadios" class="flat-red" value="2" <?php if($matricula->pivot->matricula=="2"){ ?> checked="checked" <?php } ?> > 
            </div>                        
        </div>

              
                 <div class="form-group">                                           
                        {!! Form::label('lbgrado', 'Grado',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
               
      {!! Form::text('grado_id',$seccion->seccion_grado->grado,['class'=>'form-control pull-right','placeholder'=>'Grado','required','readonly']) !!}
                          </div>
                           </div>

                 <div class="form-group">
     {!! Form::label('lbseccion', 'Sección',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
     {!! Form::text('seccion_id',$seccion->seccion,['class'=>'form-control pull-right','placeholder'=>'Seccion','required','readonly']) !!}
                       </div>
              </div>
           
                 <div class="form-group">                                           
                        {!! Form::label('lbturno', 'Turno',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                          {!! Form::text('turno',$seccion->seccion_turno->turno,['class'=>'form-control pull-right','placeholder'=>'Turno','required','id'=>'turno_id','readonly']) !!}
                       </div>
                  </div>

                 <div class="form-group">
                       {!! Form::label('lbasesor', 'Asesor de sección',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('asesor',$seccion->seccion_empleado->v_nombres.' '.$seccion->seccion_empleado->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Docente asesor','id'=>'asesor_id','readonly']) !!}
                                                </div>
                </div>
            
                <div class="form-group">                                           
                                                {!! Form::label('exppadre', 'Matriculado por',['class'=>'col-sm-4 control-label']) !!}
                                            
                                                <div class="col-sm-5">
                                                {!! Form::text('familiar_nombre',$matricula->pivot->familiar_nombre,['class'=>'form-control pull-right','placeholder'=>'Padre de familia','id'=>'nombrefamiliar','readonly']) !!}
                                                </div>
                                                 </div>

                 <div class="form-group">

                                                {!! Form::label('modalidad', 'Modalidad de matrícula',['class'=>'col-sm-4 control-label']) !!} 
                   <div class="col-sm-5">
                  <span class="label label-warning">{{$matricula->pivot->modalidad}}</span> 
                  </div>                                                                     
                </div><!--fin form group-->
             
                                      
            <div class="form-group">
              {!! Form::label('lbtraslado', 'Traslado',['class'=>'col-sm-4 control-label']) !!} 
          <div class="col-sm-5">
             {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
              <input type="radio" name="trasladoRadios" class="flat-red" d="trasladoradiosi" value="SI" <?php if($matricula->pivot->v_trasladoSN=="SI"){ ?> checked="checked" <?php } ?> >

               {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
              <input type="radio" name="trasladoRadios" class="flat-red" d="trasladoradiosi" value="NO" <?php if($matricula->pivot->v_trasladoSN=="NO"){ ?> checked="checked" <?php } ?> >
            </div>    
 </div>

                 <div class="form-group">

                {!! Form::label('lbcentroescorigen', 'Trasladado de ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">  
                {!! Form::text('txtcentroorigen',$matricula->pivot->v_centroescolarorigen,['class'=>'form-control pull-right','placeholder'=>'Centro escolar de origen','id'=>'centroescolarorigen','readonly']) !!}
                </div>
            </div>           
         
            <div class="form-group">                                           
                       {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                     {!! Form::textarea('txtobservaciones',$matricula->pivot->v_observaciones,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones','readonly']) !!}
                  </div>
                </div>           
                                                               
          </div> 
       @endforeach

             <div class="box-footer" align="right">                
          <a href="{{route('listadematriculados')}}" class="btn btn-default">Regresar</a>
              </div>
                {!! Form::close() !!}
              <!-- /.box-footer -->


 
 </div>
@endsection


