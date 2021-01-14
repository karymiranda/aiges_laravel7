@extends('admin.menuprincipal')
@section('tittle', 'Recurso Humano/Expedientes inactivos')
@section('content')


<div class="nav-tabs-custom">
  <ul class="nav nav-tabs pull-right">
    <li class=""><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">HISTORIAL DE PERMISOS</a></li>
    <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">CUENTA DE USUARIO</a></li>
    <li class="active"><a href="#tab_3-3" data-toggle="tab" aria-expanded="true">DATOS GENERALES</a></li>
    <li class="pull-left header"><i class="fa fa-file"></i><label class="text-primary">EXPEDIENTE PERSONAL</label></li>
  </ul>
  <div class="tab-content">
		<div class="tab-pane" id="tab_1-1">
		  <?php if($empleado->permisos->first()!=null){ ?>
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>FECHA</th> 
          <th>TIPO SOLICITUD</th>
          <th>MOTIVO</th>
          <th>PERIODO SOLICITADO</th>
          <th>TIEMPO (DIAS)</th>
          <th>ESTADO</th>
        </thead>
        <tbody>
          @foreach($empleado->permisos as $permiso)
          <tr> 
            <td>{{ $permiso->f_fechasolicitud }}</td>
            <td>{{ $permiso->tipoPermiso->v_descripcion }}</td>
            <td>{{ $permiso->motivoPermiso->v_motivo }}</td>
            <td>{{ $permiso->f_desde . ' - ' . $permiso->f_hasta }}</td>
            <td>{{ $permiso->i_tiemposolicitado }}</td>
            <td>
              <span class="
              <?php if($permiso->estado=='Pendiente'){ ?> 
                label label-warning <?php }else{
                  if($permiso->estado=='Aprobada'){ ?> 
                    label label-success <?php }else{
                ?> label label-danger <?php }
              } ?>">{{ $permiso->estado }}</span>
            </td>                                    
          </tr>
          @endforeach
        </tbody>
      </table>
      <?php }else{ ?>
        <h3>El empleado no ha hecho solicitudes de permisos</h3>
      <?php } ?>
      <div class="box-footer" align="right">                
        <a href="{{ route('listaexpedientesdesactivadosrh') }}" class="btn btn-primary"><< Regresar</a>
      </div>
		</div><!-- /.tab-pane 1-1-->
<!--/////////////////////////////////////////////////////////////////////////////////////////-->         
		<div class="tab-pane" id="tab_2-2">
      <div class="box-body">
        {!! Form::open(['class'=>'form-horizontal']) !!}
        <?php if($empleado->usuarios->first()!=null){ ?>
        @foreach($empleado->usuarios as $usuario)
        <div class="col-sm-12" align="center">
        <!--li class="user-header"-->
          <output id="list"><img src="/imagenes/Recurso humano/{{ $usuario->foto }}" height="200px" class="img-circle" alt="User Image"></output>
        <!--/li-->
          <hr>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbusuario', 'Usuario',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('name',$empleado->v_numeroexp,['class'=>'form-control pull-right','placeholder'=>'Cuenta de usuario','','readonly'=>'true']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbnivelusu', 'Niveles de usuario',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-8">
            <?php if($roles[0]==true){ ?>
          {!! Form::label('sup', 'Super Admin  ',['class'=>'control-label']) !!}
          <?php } ?>
          <?php if($roles[1]==true){ ?>
          {!! Form::label('bono', 'Admin Bono Escolar',['class'=>'control-label ']) !!}<br>
          <?php } ?>
          <?php if($roles[2]==true){ ?>
          {!! Form::label('acti', 'Admin Activo Fijo',['class'=>'control-label']) !!}<br>
          <?php } ?>
          <?php if($roles[3]==true){ ?>
          {!! Form::label('aca', 'Admin Académico',['class'=>'control-label']) !!}<br>
          <?php } ?>
          <?php if($roles[4]==true){ ?>
          {!! Form::label('doc', 'Docente',['class'=>'control-label']) !!}
          <?php } ?>
          <?php if($roles[5]==true){ ?>
          {!! Form::label('rrhh', 'Admin RRHH',['class'=>'control-label']) !!}
          <?php } ?>          
          </div>
        </div>
        @endforeach
        <?php }else{ ?>
        <h3>El empleado no tiene cuenta de usuario</h3>
        <?php } ?>
        <div class="box-footer" align="right">                
          <a href="{{ route('listaexpedientesdesactivadosrh') }}" class="btn btn-primary"><< Regresar</a>
        </div>
        {{Form::close()}}
      </div><!-- /.BOXBODY-->		                
		</div><!-- /.tab-pane  2-2-->
<!--/////////////////////////////////////////////////////////////////////////////////////////-->
		<div class="tab-pane active" id="tab_3-3">
      <div class="box-body">
        {!! Form::open(['class'=>'form-horizontal']) !!}
        <div class="form-group">                                           
          {!! Form::label('exp', 'Expediente',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('v_numeroexp',$empleado->v_numeroexp,['class'=>'form-control pull-right','placeholder'=>'Número de expediente','readonly']) !!}
          </div>      
        </div>
        <div class="form-group">                                           
          {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::text('v_nombres',$empleado->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres', 'readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::text('v_apellidos',$empleado->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('genero', 'Género',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">          
            {!! Form::label('lbfem', 'Femenino',['class'=>'col- control-label']) !!}
            <input type="radio" name="v_genero" disabled="true" class="flat-red" value="Femenino" <?php if($genero=="Femenino"){ ?> checked="checked" <?php } ?> >
            {!! Form::label('lbmas', 'Masculino',['class'=>'control-label']) !!}
            <input type="radio" name="v_genero" disabled="true" class="flat-red" value="Masculino" <?php if($genero=="Masculino"){ ?> checked="checked" <?php } ?> >
          </div> 
        </div>
        <div class="form-group">                                           
          {!! Form::label('lblfec', 'Fecha de nacimiento',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="f_fechanaci" id="nac" value="{{$empleado->f_fechanaci}}" readonly="true" class="form-control pull-right">
            </div>          
          </div>
          {!! Form::label('lbedad', 'Edad (Años)',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('txtedad',$edad,['class'=>'form-control pull-right','id'=>'edad','placeholder'=>'Años','readonly']) !!}
          </div>                                         
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbdui', 'DUI',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <input type="text" name="v_dui" class="form-control" value="{{$empleado->v_dui}}" readonly="true">
          </div>
          {!! Form::label('lbdui', 'NIT',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <input type="text" name="v_nit" class="form-control" value="{{$empleado->v_nit}}" readonly="true">
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('direccion', 'Dirección',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::textarea('v_direccioncasa',$empleado->v_direccioncasa,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-phone"></i>
              </div>
              <input type="text" name="v_telcasa" class="form-control" value="{{$empleado->v_telcasa}}" readonly="true">
            </div>
          </div>
          {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-phone"></i>
              </div>
              <input type="text" name="v_celular" class="form-control" value="{{$empleado->v_celular}}" readonly="true">
            </div>
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbcorreo', 'Correo electrónico',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
            {!! Form::text('v_correo',$empleado->v_correo,['class'=>'form-control pull-right','placeholder'=>'ejemplo@gmai.com','readonly']) !!}
            </div>
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lblfechcontra', 'Fecha de contratación',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="f_fechaingresoalCE" value="{{$empleado->f_fechaingresoalCE}}" class="form-control pull-right" readonly="true">
            </div>
          </div>                                              
        </div>  
        <div class="form-group">                                           
          {!! Form::label('lbtipopersonal', 'Tipo personal',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::select('tipopersonal_id',$tiposPersonal, $empleado->tipoPersonal->id,['class'=>'form-control','disabled'])!!}
          </div>
          {!! Form::label('lbcargo', 'Cargo',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::select('cargo_id',$cargos, $empleado->cargo->id,['class'=>'form-control','disabled'])!!}
          </div>
        </div>  
        <div class="form-group">                                           
          {!! Form::label('lbtipocontrato', 'Tipo de contratación',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::select('v_tipocontratacion',['SB'=>'Sueldo base','SS'=>'Sobre sueldo','HC'=>'Horas clase'], $empleado->v_tipocontratacion,['class'=>'form-control','disabled'])!!}
          </div>
          {!! Form::label('lbsueldo', 'Salario mensual',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-dollar"></i>
              </div>        
              <input type="text" name="d_sueldo" value="{{$empleado->d_sueldo}}" class="form-control pull-right" readonly="true">
            </div>
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbescpeciadlidad', 'Especialidad',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::select('especialidad_id',$especialidades, $empleado->especialidad->id,['class'=>'form-control','disabled'])!!}
          </div>
          {!! Form::label('lbtitulo', 'Titulo Académico',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('v_tituloacademico',$empleado->v_tituloacademico,['class'=>'form-control pull-right','placeholder'=>'Titulo Académico','readonly']) !!}
          </div>
        </div> 
        <div class="form-group">                                           
          {!! Form::label('lblfecingsedu', 'Fecha de ingreso al sistema educativo',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="f_fechaingresoministerio" value="{{$empleado->f_fechaingresoministerio}}" class="form-control pull-right" readonly="true">
            </div>
          </div>                                 
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbnivelesc', 'Nivel escalafón',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::select('v_nivelescalafon',['1'=>'Uno','2'=>'Dos','3'=>'Tres','4'=>'Cuatro'], $empleado->v_nivelescalafon,['class'=>'form-control','disabled'])!!}
          </div>
        </div> 
        <div class="form-group">                                           
          {!! Form::label('lbcatescalafon', 'Categoria escalafón',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::select('v_categoriaescalafon',['0'=>'Ninguno','UA'=>'Uno-A    / Educadores con más de 35 años de servicio activo','UB'=>'Uno-B   / Educadores con más de 30  y hasta 35 años de servicio activo','UC'=>'Uno-C  / Educadores con más de 25 y hasta 30 años de servicio activo','
          D'=>'Dos    / Educadores con más de 20 y hasta 25 años de servicio activo','T'=>'Tres  / Educadores con más de 15 y hasta 20 años de servicio activo','Cu'=>'Cuatro / Educadores con más de 10 y hasta 15 años de servicio activo','C'=>'Cinco  / Educadores con más de 5 y hasta 10 años de servicio activo','S'=>'Seis   / Educadores hasta con 5 años de servicio activo'], $empleado->v_categoriaescalafon,['class'=>'form-control','disabled'])!!}
          </div>
        </div>  
        <div class="form-group">                                           
          {!! Form::label('lbnip', 'NIP',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <input type="text" name="v_nip" value="{{$empleado->v_nip}}" class="form-control pull-right" readonly="true">
          </div>
          {!! Form::label('lbnup','NUP',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <input type="text" name="v_nup" value="{{$empleado->v_nup}}" class="form-control pull-right" readonly="true">
          </div>
        </div> 
        <div class="box-footer" align="right">                
          <a href="{{ route('listaexpedientesdesactivadosrh') }}" class="btn btn-primary"><< Regresar</a>
        </div> 
      </div>        
    </div><!-- /.tab-pane 3-2-->
<!--/////////////////////////////////////////////////////////////////////////////////////////-->		     
  </div><!-- /.tab-content -->          
</div><!-- /.nav tab custom -->
@endsection