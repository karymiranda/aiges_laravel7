@extends('admin.menuprincipal')
@section('tittle','Personal Docente / Expediente Estudiantil')
@section('content')

<div class="nav-tabs-custom"> 
            <ul class="nav nav-tabs pull-right">
              <li class=""><a href="#tab_3-4" data-toggle="tab" aria-expanded="false">HISTORIAL CONDUCTA</a></li>
               <li class=""><a href="#tab_3-3" data-toggle="tab" aria-expanded="false">GRADOS CURSADOS</a></li>
              <li class=""><a href="#tab_3-2" data-toggle="tab" aria-expanded="false">GRUPO FAMILIAR</a></li>
               <li class=""><a href="#tab_3-1-1" data-toggle="tab" aria-expanded="false" disabled="true">DATOS MEDICOS</a></li>
              <li class="active"><a href="#tab_3-1" data-toggle="tab" aria-expanded="true">DATOS GENERALES</a></li>
              <li class="pull-left header box-header">EXPEDIENTE ACADEMICO</li>
            </ul>

  <div class="tab-content">

<!--////////////////////////////////////////////////////////////////-->
<div class="tab-pane " id="tab_3-4">
<div class="box-body">
{!! Form::open(['route'=>'guardargrado', 'method'=>'POST','class'=>'form-horizontal']) !!}
 <div class="col-sm-12">

<!--a href="{{route('addfaltaestudiante_doc',[$estudiante->id,$seccion_id])}}" class="btn btn-primary pull-right">Logro</a-->

<a href="{{route('addfaltaestudiante_doc',[$estudiante->id,$seccion_id])}}" class="btn btn-primary pull-right">Agregar falta</a>
</div>

<!--h3><p class="text-green" align="center">LOGROS</p></h3-->

<!--div class="box-body table-responsive">
<table class="table table-bordered table-striped" id="tablaBusquedaR">
 <thead style="background-color: #f97464;color:white;">
        <th>FECHA</th>
        <th>NIVEL EDUCATIVO</th>
        <th>DESCRIPCION DEL LOGRO</th>
        <th>OBSERVACIONES</th>
      </thead>
      <tbody>

      </tbody>
    </table>
 </div-->

<h3><p class="text-red" align="center">FALTAS</p></h3>

<div class="box-body table-responsive">
<table class="table table-bordered table-striped" id="tablaBusquedaR">
 <thead style="background-color: #f97464;color:white;">
        <th>FECHA</th>
        <th>FALTA</th>
        <th>DESCRIPCION DEL INCIDENTE</th>
         <th>SANCIONES APLICADAS</th>
      </thead>
      <tbody>
        @foreach($faltas as $faltas)
 <tr>
          <td>{{ $faltas->fecha }}</td>
          <td>{{ $faltas->tipo_falta }}</td>
          <td>{{ $faltas->descripcion_falta }}</td>
          <td>{{ $faltas->sanciones_aplicadas }}</td>
  </tr>
        @endforeach
      </tbody>
    </table>
 </div>



{!! Form::close() !!}

</div>
</div>

<!--////////////////////////////////////////////////////////////////-->

<div class="tab-pane " id="tab_3-3">
            
              <div class="box-body">

                {!! Form::open(['route'=>'guardargrado', 'method'=>'POST','class'=>'form-horizontal']) !!}

                   <div class="box-body table-responsive">
                      <table class="table table-bordered table-striped" id="tablaBusqueda">
                      <thead style="background-color: #3c8dbc;color:white;">
                              <th>AÑO</th>
                              <th>GRADO</th>
                              <th>ASESOR</th>  
                              <th>ACCIONES</th>              
                             </thead>
              <tbody>
                @foreach($datos as $g)
                @foreach($g->estudiante_seccion as $grado)
                <tr>            
                  <td>{{$grado->anio}}</td>
                  <td>{{$grado->descripcion}}</td>
                  <td>{{$grado->seccion_empleado->v_nombres}} {{$grado->seccion_empleado->v_apellidos}}</td>
                   <td>
              <a href="{{route('calificaciones_estudiante',[$estudiante->id,$grado->anio])}}"  title="Ver calificaciones" class="btn btn-warning"><i class="fa fa-calculator"></i></a>
                   </td>
                </tr>
                @endforeach  
                @endforeach                   
              </tbody>
            </table>
            </div>                                                 
          </div>         
                
 {!! Form::close() !!}
              <!-- /.box-footer -->
   </div><!-- / tab 3-3 finaliza -->
   <!--//////////////////////////////////////////////////////////////////////////////////////-->            
            <div class="tab-pane " id="tab_3-2">
            
              <div class="box-body">

                {!! Form::open(['route'=>'guardargrado', 'method'=>'POST','class'=>'form-horizontal']) !!}

                   <div class="box-body table-responsive">
                      <table class="table table-bordered table-striped" id="tablaBusqueda">
                      <thead style="background-color: #3c8dbc;color:white;">
                              <th>DUI</th>
                              <th>NOMBRE COMPLETO</th>
                              <th>PARENTESCO</th>
                              <th>ENCARGADO</th>
                              <th>PUEDE RETIRAR AL ESTUDIANTE</th>
                              <th>TELEFONO CASA</th>                                   
                              <th>CELULAR</th>                
                             </thead>
                       <tbody>
               @foreach($familiares as $familiares)
                @foreach($familiares->estudiante_familiares as $datos)
                <tr>            
                  <td>{{$datos->dui}}</td>
                  <td>{{$datos->nombres}} {{$datos->apellidos}}</td>
                  <td>{{$datos->pivot->parentesco}}</td>
                  <td>{{$datos->pivot->encargado}}</td> 
                  <td>{{$datos->pivot->autorizacion}}</td> 
                   @if($datos->telefonocasa==null) 
                  <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                  @if($datos->telefonocasa!=null) 
                 <td>{{$datos->telefonocasa}}</td>
                   @endif  
                   @if($datos->celular==null) 
                  <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                  @if($datos->celular!=null) 
                 <td>{{$datos->celular}}</td> 
                   @endif                                                      
                </tr>

                @endforeach
                  @endforeach
              </tbody>
            </table>
            </div>                                                 
          </div>         
                
 {!! Form::close() !!}
              <!-- /.box-footer -->
            
         
   </div><!-- / tab 3-2 finaliza -->

  <!-- ///////////////////////////////////////////////////////////////////////////////////-->             
  <div class="tab-pane " id="tab_3-1-1">
      <div class="box-body">

    
   {!! Form::open(['route'=>'guardardatosmedicosestudiante', 'method'=>'POST','class'=>'form-horizontal']) !!}

         
          <div class="form-group">
          {!! Form::label('cantfam', 'Presenta tarjeta de vacuna',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
          {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
          <input type="radio" name="tarjeta_vacuna" class="flat-red" value="SI" <?php if($datosmedicos->tarjeta_vacuna=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
          <input type="radio" name="tarjeta_vacuna" class="flat-red" value="NO" <?php if($datosmedicos->tarjeta_vacuna=="NO"){ ?> checked="checked" <?php } ?> >          
          </div> 
          </div>

            <div class="form-group">
            {!! Form::label('cantfam', 'Esquema de vacunas completo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::label('si', 'SI',['class'=>'control-label']) !!}
          <input type="radio" name="vacuna_completa" class="flat-red" value="SI" <?php if($datosmedicos->vacuna_completa=="SI"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('no', 'NO',['class'=>'control-label']) !!}
          <input type="radio" name="vacuna_completa" class="flat-red" value="NO" <?php if($datosmedicos->vacuna_completa=="NO"){ ?> checked="checked" <?php } ?> > 
         </div> 
          </div>

          <div class="form-group">
            {!! Form::label('cantfam', 'Tipo sanguineo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
           {!! Form::label('AB-', 'AB-',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="AB-" <?php if($datosmedicos->tipo_sanguineo=="AB-"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('AB+', 'AB+',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="AB+" <?php if($datosmedicos->tipo_sanguineo=="AB+"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('A-', 'A-',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="A-" <?php if($datosmedicos->tipo_sanguineo=="A-"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('A+', 'A+',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="A+" <?php if($datosmedicos->tipo_sanguineo=="A+"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('B-', 'B-',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="B-" <?php if($datosmedicos->tipo_sanguineo=="B-"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('B+', 'B+',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="B+" <?php if($datosmedicos->tipo_sanguineo=="B+"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('O-', 'O-',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="O-" <?php if($datosmedicos->tipo_sanguineo=="O-"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('O+', 'O+',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="O+" <?php if($datosmedicos->tipo_sanguineo=="O+"){ ?> checked="checked" <?php } ?> >
           {!! Form::label('No sabe', 'No sabe',['class'=>'control-label']) !!}
          <input type="radio" name="tipo_sanguineo" class="flat-red" value="No sabe" <?php if($datosmedicos->tipo_sanguineo=="No sabe"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

                
                  <div class="form-group"> 
                    {!! Form::label('cantfam', 'Discapacidades',['class'=>'col-sm-4 control-label']) !!}                
                <div class="col-sm-5">
                <div class="checkbox">
  <label><input type="checkbox" name="discapacidades[]" value="Ninguna" id="super" {{in_array("Ninguna",$datosmedicos->discapacidades)?"checked":""}}> Ninguna </label>
                  </div> 
                  <div class="checkbox">
  <label><input type="checkbox" name="discapacidades[]" value="Baja visión" class="check" {{in_array("Baja visión",$datosmedicos->discapacidades)?"checked":""}}> Baja visión </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="discapacidades[]" value="Sordera" class="check" {{in_array("Sordera",$datosmedicos->discapacidades)?"checked":""}}>Sordera</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="discapacidades[]" value="Falta de miembro" class="check" {{in_array("Falta de miembro",$datosmedicos->discapacidades)?"checked":""}}>Falta de miembro </label>                       
                  </div>
                  </div>              
                  </div>
                
               
                
                 <div class="form-group">                                           
                           {!! Form::label('lbhorariosuenonoche', 'Horario de sueño por la noche',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-5">
                            {!! Form::textarea('horario_sueno_noche',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','readonly']) !!}
                                                </div>
                </div><!--fin form group-->
              


              
                 <div class="form-group">                                           
                                                {!! Form::label('lbhorariosuenodia', 'Horario de sueño durante el dia',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                               {!! Form::textarea('horario_sueno_dia',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','readonly']) !!}
                                                </div>
                </div><!--fin form group-->
              
               

            <div class="form-group">
            {!! Form::label('lbdificultad', 'Presenta dificultades para dormir',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            
          {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="dificul_dormir" class="flat-red" value="SI" <?php if($datosmedicos->dificul_dormir=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'NO',['class'=>'col- control-label']) !!}
          <input type="radio" name="dificul_dormir" class="flat-red" value="NO" <?php if($datosmedicos->dificul_dormir=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

          <div class="form-group">
           {!! Form::label('lblechematerna', 'Es o fué alimentado con leche materna',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
             {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="tomo_pecho" class="flat-red" value="SI" <?php if($datosmedicos->tomo_pecho=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'NO',['class'=>'col- control-label']) !!}
          <input type="radio" name="tomo_pecho" class="flat-red" value="NO" <?php if($datosmedicos->tomo_pecho=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

       <div class="form-group">                                           
          {!! Form::label('lbmeseslactancia', '¿Cuánto tiempo?',['class'=>'col-sm-4 control-label']) !!}
       <div class="col-sm-5">
      {!! Form::text('tiempo_lactancia',$datosmedicos->tiempo_lactancia,['class'=>'form-control pull-right','placeholder'=>'Meses','readonly']) !!}
       </div>
</div><!--fin form group-->
                 
       <div class="form-group">                                           
           {!! Form::label('lbdifalimentacion', '¿Ha presentado dificultades para alimentarse?',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::text('tiene_dificultad_comer',null,['class'=>'form-control pull-right','placeholder'=>'Especifíque','readonly']) !!}
          </div>                 
          </div><!--fin form group-->
                  
          <div class="form-group"> 
           {!! Form::label('lbalimentos', 'Alimentos que consume ',['class'=>'col-sm-4 control-label']) !!}                  
          <div class="col-sm-5">
          <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Todos" id="chkalimentos" {{in_array("Todos",$datosmedicos->alimentos_consume)?"checked":""}}> Todos </label>
                  </div> 
                  <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Lacteos" class="checkA" {{in_array("Lacteos",$datosmedicos->alimentos_consume)?"checked":""}}> Lacteos </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Verduras" class="checkA" {{in_array("Verduras",$datosmedicos->alimentos_consume)?"checked":""}}>Verduras</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Cereales" class="check" {{in_array("Cereales",$datosmedicos->alimentos_consume)?"checked":""}}>Cereales</label>                </div>
                          <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Frutas" class="checkA" {{in_array("Frutas",$datosmedicos->alimentos_consume)?"checked":""}}> Frutas </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Carne de pollo" class="checkA" {{in_array("Carne de pollo",$datosmedicos->alimentos_consume)?"checked":""}}>Carne de pollo</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Carne de res" class="checkA" {{in_array("Carne de res",$datosmedicos->alimentos_consume)?"checked":""}}>Carne de res </label>                       
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Carne de cerdo" class="checkA" {{in_array("Carne de cerdo",$datosmedicos->alimentos_consume)?"checked":""}}>Carne de cerdo</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="alimentos_consume[]" value="Mariscos" class="checkA" {{in_array("Mariscos",$datosmedicos->alimentos_consume)?"checked":""}}>Mariscos</label>               </div> 
                  </div>            
                  </div>
                          
                  <div class="form-group"> 
                    {!! Form::label('lbalimentos', '¿Cuántos tiempo de comida realiza?',['class'=>'col-sm-4 control-label']) !!}                  
                <div class="col-sm-5">
                 <div class="checkbox">
  <label><input type="checkbox" name="tiempos_comida[]" value="Todos" id="chktiempos" {{in_array("Todos",$datosmedicos->tiempos_comida)?"checked":""}}> Todos </label>
                  </div> 
                  <div class="checkbox">
  <label><input type="checkbox" name="tiempos_comida[]" value="Desayuno" class="checkC" {{in_array("Desayuno",$datosmedicos->tiempos_comida)?"checked":""}}> Desayuno </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="tiempos_comida[]" value="Almuerzo" class="checkC" {{in_array("Almuerzo",$datosmedicos->tiempos_comida)?"checked":""}}>Almuerzo</label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="tiempos_comida[]" value="Cena" class="checC" {{in_array("Cena",$datosmedicos->tiempos_comida)?"checked":""}}>Cena</label>                </div> 
                  </div>            
                   </div>
                 
                    <div class="form-group">                                           
                                    {!! Form::label('lbrefrigerios', '¿Cuantos refrigerios realiza?',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                    {!! Form::text('canti_frigerios',$datosmedicos->canti_refrigerios,['class'=>'form-control pull-right','placeholder'=>'Cantidad','readonly']) !!}
                                                </div>                 
                   </div><!--fin form group-->
                

          <div class="form-group">
         {!! Form::label('lbalergico', '¿Es alérgico? (alimentos - medicamentos)',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="esalergicoSN" class="flat-red" value="SI" <?php if($datosmedicos->esalergicoSN=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'NO',['class'=>'col- control-label']) !!}
          <input type="radio" name="esalergicoSN" class="flat-red" value="NO" <?php if($datosmedicos->esalergicoSN=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

           <div class="form-group">                                           
            {!! Form::label('lbalergia', 'Alérgico a',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
            {!! Form::textarea('alergicoa',$datosmedicos->alergicoa,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','readonly']) !!}
                                                </div>
                </div><!--fin form group-->
               
            <div class="form-group">                                           
             {!! Form::label('lbalimentoqprefiere', 'Alimentos que prefiere',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
              {!! Form::textarea('alimentos_prefiere',$datosmedicos->alimentos_prefiere,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','readonly']) !!}
                                                </div>
                </div><!--fin form group-->
               

                 <div class="form-group">                                           
                {!! Form::label('lbalimentoqrechaza', 'Alimentos que rechaza',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                {!! Form::textarea('alimentos_rechaza',$datosmedicos->alimentos_rechaza,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','readonly']) !!}
                                                </div>
                </div><!--fin form group-->
            

          <div class="form-group">
         {!! Form::label('lbprescmedica', '¿Tiene el estudiante alguna prescripción médica especial que debe seguirse en el centro?',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::label('', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="prescripcionmedicaSN" class="flat-red" value="SI" <?php if($datosmedicos->prescripcionmedicaSN=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('', 'NO',['class'=>'col- control-label']) !!}
          <input type="radio" name="prescripcionmedicaSN" class="flat-red" value="NO" <?php if($datosmedicos->prescripcionmedicaSN=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

               
          <div class="form-group">                                           
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
           {!! Form::textarea('detallereceta',$datosmedicos->detallereceta,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Especifique...','readonly']) !!}
                                   </div>
   </div><!--fin form group-->

      
                
          

                {!! Form::close() !!}            
        
              <!-- /.box-footer -->
       </div><!-- / tab 3-2 finaliza -->
       </div>      

<!--////////////////////////////////////////////////////////////////////////////////////////-->

<div class="tab-pane active" id="tab_3-1">    
  <div class="box-body">


{!! Form::open(['route'=>'guardardatospersonalesestudiante', 'method'=>'POST','class'=>'form-horizontal']) !!}

            
          <div class="col-sm-12" align="center">
          <output id="list">  
          @foreach($user as $user)
            @if($user->foto=='nofound.jpg') 
             <img src="{{asset('/imagenes/Administracionacademica/Estudiantes/usuariopordefecto.jpg')}}" height="200px" class="image-circle" alt="User Image">
            @else         
             <img src="{{asset('/imagenes/Administracionacademica/Estudiantes/'.$user->foto)}}" height="200px" class="image-circle" alt="User Image">
             @endif
          @endforeach
          </output>
      <!--/li-->
                  <hr>
                </div>

                
          <div class="form-group">                                           
                                                {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_expediente',$estudiante->v_expediente,['class'=>'form-control pull-right','placeholder'=>'Número de expediente','required','readonly']) !!}
                                                </div>
                                                
                </div>

                  <div class="form-group">                                           
                                                {!! Form::label('nie', 'NIE',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                            @if($estudiante->nie==null)
                            {!! Form::text('v_nie',$estudiante->nie,['class'=>'form-control pull-right','placeholder'=>'SIN ASIGNAR','readonly'],'readonly') !!}
                            
                            @else
                              {!! Form::text('v_nie',$estudiante->nie,['class'=>'form-control pull-right','placeholder'=>'Número de identificación del estudiante','readonly']) !!}
                            @endif
                                                 </div>
                                                
                </div>

               

                 <div class="form-group">                                           
                                                {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_nombres',$estudiante->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres segun partida de nacimiento','readonly']) !!}
                                                </div>
                </div>

                 <div class="form-group">                                           
                                                {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_apellidos',$estudiante->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos segun partida de nacimiento','readonly']) !!}
                                                </div>
                </div>

          <div class="form-group">
          {!! Form::label('genero', 'Género',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
         {!! Form::label('lbfem', 'Femenino',['class'=>'col- control-label']) !!}
          <input type="radio" name="v_genero" class="flat-red" value="Femenino" <?php if($estudiante->v_genero=="Femenino"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lbmas', 'Masculino',['class'=>'control-label']) !!}
          <input type="radio" name="v_genero" class="flat-red" value="Masculino" <?php if($estudiante->v_genero=="Masculino"){ ?> checked="checked" <?php } ?> >
          </div> 
          </div>

                 <div class="form-group">                                           
             {!! Form::label('lblfec', 'Fecha de nacimiento',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-5">
              <div class="input-group date">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" name="f_fnacimiento" id="nac" value="{{$estudiante->f_fnacimiento}}" onblur="calcular(this,'edad')" onchange="calcular(this,'edad')" class="form-control pull-right nac" data-mask required="true" disabled="true" >
                  </div>
               </div>
             </div>
              <div class="form-group">
                {!! Form::label('lbedad', 'Edad',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                {!! Form::text('txtedad',$edad,['class'=>'form-control pull-right','id'=>'edad','placeholder'=>'Años','disabled']) !!}
                                                </div>

                                               
              </div>
              

                
                <div class="form-group">                                           
                                                {!! Form::label('direccion', 'Dirección',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::textarea('v_direccion',$estudiante->v_direccion,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','required','readonly']) !!}
                                                </div>
                </div>

                  <div class="form-group">                                           
                        {!! Form::label('lbldepto', 'Departamento',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
          {!! Form::select('departamento_id',$dept, null,['class'=>'form-control','id'=>'departamentos','disabled'=>'true'])!!}
                        </div>
                        </div>

                 <div class="form-group">             
            {!! Form::label('lbmunici', 'Municipio',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
              {!! Form::select('municipio_id',$municipios, null,['class'=>'form-control','id'=>'municipio_id','disabled'=>'true'])!!}
                                                </div>
                                               
          </div>
     
           <div class="form-group">                                           
                        {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-5">
                         {!! Form::text('v_telCasa',$estudiante->v_telCasa,['class'=>'form-control','placeholder'=>'9999-9999', 'data-inputmask'=>"'mask': ['2999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'','readonly']) !!}
                        </div>

              </div>
              <div class="form-group">
                {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                              {!! Form::text('v_telCelular',$estudiante->v_telCelular,['class'=>'form-control','placeholder'=>'9999-9999', 'data-inputmask'=>"'mask': ['9999-9999', '+099 99 99 9999[9]-9999']" ,'data-mask'=>'','readonly']) !!}
                                                </div>

                                               
          </div>



          <div class="form-group">                                           
                                                {!! Form::label('lbcorreo', 'Correo electónico',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('v_correo',$estudiante->v_correo,['class'=>'form-control pull-right','placeholder'=>'ejemplo@gmai.com','readonly']) !!}
                                                </div>
                </div>

             
                 
<hr>
<h4 align="center">SITUACION FAMILIAR</h4><hr>
                <div class="form-group">                                           
                   {!! Form::label('cantfam', 'Miembros',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                  {!! Form::text('i_catFamiliares',$estudiante->i_catFamiliares,['class'=>'form-control pull-right','placeholder'=>'Número de miembros que conforman su núcleo familiar: Desconocido','readonly']) !!}
                                                </div>
                </div>

                 
                <div class="form-group">                                           
                                                {!! Form::label('convivecon', 'Convive con',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                     {!! Form::select('v_viveCon',['Padre y madre'=>'Padre y madre','Madre'=>'Madre','Padre'=>'Padre','Familiares'=>'Familiares','Otros'=>'Otros'], $estudiante->v_viveCon,['class'=>'form-control','disabled'])!!}
                                                </div>
                </div>

            <div class="form-group">   

                    {!! Form::label('depende', 'Económicamente depende de',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                     {!! Form::select('v_dependeDe',['Padre y madre'=>'Padre y madre','Madre'=>'Madre','Padre'=>'Padre','Otros'=>'Otros'], $estudiante->v_dependeDe,['class'=>'form-control','disabled'])!!}
                                                </div>
                </div> 

      <h4 align="center">SITUACION ECLESIAL</h4><hr>


     <div class="col-sm-12">
                  <div class="form-group"> 
                    {!! Form::label('lbeclesial', '¿Con qué sacramentos cuenta el estudiante? ',['class'=>'col-sm-4 control-label']) !!}                  
                <div class="col-sm-5">
                  <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Ninguno" id="super" {{in_array("Ninguno",$estudiante->sacramentos)?"checked":""}}> Ninguno </label>
                  </div> 
                  <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Bautismo" class="check" {{in_array("Bautismo",$estudiante->sacramentos)?"checked":""}}> Bautismo </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Primera Comunión" class="check" {{in_array("Primera Comunión",$estudiante->sacramentos)?"checked":""}}>Primera Comunión </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Confirmación" class="check" {{in_array("Confirmación",$estudiante->sacramentos)?"checked":""}}>Confirmación </label>
                  </div>
                   <div class="checkbox">
  <label><input type="checkbox" name="sacramentos[]" value="Matrimonio" class="check" {{in_array("Matrimonio",$estudiante->sacramentos)?"checked":""}}>Matrimonio </label>
                  </div>   
                  </div>              

                  </div>
                  </div><!--fin col sm12-->

                  <h4 align="center">DATOS DE INGRESO</h4>
<hr>
     <div class="col-sm-12">

        <div class="form-group">                                           
                                {!! Form::label('lblfechaingresoCE', 'Fecha de ingreso al Centro Escolar',['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-5">

                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="f_fechaIngresoCE" id="nac" value="{{$estudiante->f_fechaIngresoCE}}" class="form-control pull-right nac" data-mask required="true" readonly="true">
                                </div>
                                </div>

        </div>
      
            <div class="form-group">  
              {!! Form::label('nivel', 'Nivel ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_nivelingreso',['No Aplica'=>'No Aplica','Educación Parvularia'=>'Educación Parvularia','Educación Básica'=>'Educación Básica'], $estudiante->v_nivelingreso,['class'=>'form-control','readonly'])!!}
                </div>
            </div> 

             <div class="form-group">  
              {!! Form::label('ciclo', 'Ciclo ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_cicloingreso',['No Aplica'=>'No Aplica','I Ciclo'=>'I Ciclo','II Ciclo'=>'II Ciclo','III Ciclo'=>'III Ciclo'], $estudiante->v_cicloingreso,['class'=>'form-control','readonly'])!!}
                </div>
            </div>


             <div class="form-group">  
              {!! Form::label('modalidad educativa', 'Modalidad Educativa ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_modalidadeducativaingreso',['No Aplica'=>'No Aplica','Unica Parvularia'=>'Unica Parvularia','Regular'=>'Regular','General'=>'General'], $estudiante->v_modalidadeducativaingreso,['class'=>'form-control','readonly'])!!}
                </div>
            </div>


             <div class="form-group">  
              {!! Form::label('modalidadatencion', 'Modalidad de Atención ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
             {!! Form::select('v_modalidadatencioningreso',['No Aplica'=>'No Aplica','Regular'=>'Regular','Flexible'=>'Flexible'], $estudiante->v_modalidadatencioningreso,['class'=>'form-control','readonly'])!!}
                </div>
            </div>

             <div class="form-group">  
              {!! Form::label('gradoingreso', 'Grado ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
              {!! Form::text('v_gradoingreso',$estudiante->v_gradoingreso,['class'=>'form-control pull-right','placeholder'=>'Grado','readonly']) !!}
                </div>
            </div>

             <div class="form-group">  
              {!! Form::label('observacionesingreso', 'Observaciones ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-5">
              {!! Form::text('v_observacionesingreso',$estudiante->v_observacionesingreso,['class'=>'form-control pull-right','placeholder'=>'Observaciones ingreso ','readonly']) !!}
                </div>
            </div>

 <div class="form-group">
          {!! Form::label('nivel', 'Presentó partida de nacimiento',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
         {!! Form::label('lbfsi', 'SI',['class'=>'col- control-label']) !!}
          <input type="radio" name="presentopartidaSN" class="flat-red" value="SI" <?php if($estudiante->presentopartidaSN=="SI"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lbno', 'NO',['class'=>'control-label']) !!}
          <input type="radio" name="presentopartidaSN" class="flat-red" value="NO" <?php if($estudiante->presentopartidaSN=="NO"){ ?> checked="checked" <?php } ?> >
          </div> 
      </div>              
     
                      
    </div><!--fin col sm12-->

                                                   
                   
  {!! Form::close() !!}


  </div>
</div><!-- / tab 3-1 finaliza -->
 <!-- ////////////////////////////////////////////////////////////////////////////////////////-->

 </div><!--finaliza tab content-->
 <div class="box-footer" align="right">  
   <a href="{{route('nominadeestudiantes',$seccion_id)}}" class="btn btn-default">Regresar</a>
 </div>
 </div>
@endsection
