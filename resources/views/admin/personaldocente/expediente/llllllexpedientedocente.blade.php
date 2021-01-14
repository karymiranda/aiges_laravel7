@extends('admin.menuprincipal')
@section('tittle', 'Personal docente')
@section('content')


<div class="nav-tabs-custom">
  <ul class="nav nav-tabs pull-right">
    <!--li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false"><label class="text-primary">CUENTA DE USUARIO</label></a></li-->  
    <li class=""><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">PERMISOS</a></li>
    <li class=""><a href="#tab_4-4" data-toggle="tab" aria-expanded="false">ESTUDIOS Y CAPACITACIONES</a></li>  
      <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">DATOS ADMINSTRATIVOS</a></li>
    <li class="active"><a href="#tab_3-3" data-toggle="tab" aria-expanded="true"><label class="text-primary">DATOS GENERALES</label></a></li>
    <li class="pull-left header"> <label class="text-primary">EXPEDIENTE PERSONAL</label></li>
  </ul>
  <div class="tab-content">

<div class="tab-pane" id="tab_4-4">
     <div class="box-body">
      <?php if(Auth::user()->empleado->empleado_estudio->first()!=null){ ?>
      <table class="table table-bordered table-striped" id="tablaBusquedaauxiliar">
        <thead>
          <th>DESDE</th> 
          <th>HASTA</th>
          <th>ESTUDIO</th>
          <th>INSTITUCION</th>
          <th>TITULO OBTENIDO</th>
          <th>OBSERVACIONES</th>
        </thead>
        <tbody>
          @foreach(Auth::user()->empleado->empleado_estudio as $estudio)
          <tr> 
            <td>{{ $estudio->anioinicio }}</td>
           
            <td>{{ $estudio->aniofin }}</td>
            <td>{{ $estudio->tipoestudio }}</td>
            <td>{{ $estudio->institucion }}</td>
            <td>{{ $estudio->titulo }}</td>
            <td>{{ $estudio->observaciones }}</td>                                 
          </tr>
          @endforeach
        </tbody>
      </table>
      <?php }else{ ?>
        <h3>No hay estudios registrados</h3>
      <?php } ?>
      <div class="box-footer" align="right">                
        <!--a href="{{ route('listaexpedientesrh') }}" class="btn btn-primary"><< Regresar</a-->
         </div>
      </div>
    </div><!-- /.tab-pane 4-4-->



<div class="tab-pane" id="tab_1-1">
     <div class="box-body">
      <?php if(Auth::user()->empleado->permisos->first()!=null){ ?>
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>FECHA</th> 
          <th>MOTIVO PERMISO</th>
          <th>PERIODO SOLICITADO</th>
          <th>TIEMPO (DIAS)</th>
          <th>TIEMPO (HORAS)</th>
          <th>TIEMPO (MINUTOS)</th>
          <th>ESTADO</th>
        </thead>
        <tbody>
          @foreach(Auth::user()->empleado->permisos as $permiso)
          <tr> 
            <td>{{ $permiso->f_fechasolicitud }}</td>
           
            <td>{{ $permiso->motivoPermiso->v_motivo }}</td>
            <td>{{ $permiso->f_desde . ' - ' . $permiso->f_hasta }}</td>
            <td>{{ $permiso->i_tiemposolicitado }}</td>
            <td>{{ $permiso->i_horas }}</td>
            <td>{{ $permiso->i_minutos }}</td>
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
        <h3>No hay permisos registrados</h3>
      <?php } ?>
      <div class="box-footer" align="right">                
        <!--a href="{{ route('listaexpedientesrh') }}" class="btn btn-primary"><< Regresar</a-->
         </div>
      </div>
    </div><!-- /.tab-pane 1-1-->



<div class="tab-pane" id="tab_2-2">
  <div class="box-body">
 {!! Form::open(['class'=>'form-horizontal']) !!}
 <div class="form-group">                     
    {!! Form::label('lblfecingreso', 'Fecha de contratación',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" value="{{Auth::user()->empleado->f_fechaingresoministerio}}" readonly="true">
            </div>
          </div>
           </div>  
           
        <div class="form-group">                                           
          {!! Form::label('lbtipopersonal', 'Tipo personal',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('type',$tiposPersonal, Auth::user()->empleado->tipoPersonal->id,['class'=>'form-control','disabled'])!!}
          </div>
          </div>
        <div class="form-group">
          {!! Form::label('lbcargo', 'Cargo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('type',$cargos, Auth::user()->empleado->cargo->id,['class'=>'form-control','disabled'])!!}
          </div>
        </div>  
        <div class="form-group">                                           
          {!! Form::label('lbtipocontrato', 'Tipo de contratación',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('type',['SB'=>'Sueldo base','SS'=>'Sobre sueldo','HC'=>'Horas clase'], Auth::user()->empleado->v_tipocontratacion,['class'=>'form-control','disabled'])!!}
          </div>
          </div>
        <div class="form-group">
          {!! Form::label('lbsueldo', 'Salario mensual $ ',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtsalario',Auth::user()->empleado->d_sueldo,['class'=>'form-control pull-right','placeholder'=>'','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbescpeciadlidad', 'Especialidad',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('especialidad_id',$especialidades, Auth::user()->empleado->especialidad->id,['class'=>'form-control','disabled'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('lbtitulo', 'Titulo Académico',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_tituloacademico',Auth::user()->empleado->v_tituloacademico,['class'=>'form-control pull-right','placeholder'=>'Titulo Académico','readonly']) !!}
          </div>
        </div>  
        <div class="form-group">                                           
          {!! Form::label('lblfecingsedu', 'Fecha de ingreso al sistema educativo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="f_fechaingresoministerio" value="{{Auth::user()->empleado->f_fechaingresoministerio}}" class="form-control pull-right" readonly="true">
            </div>
          </div>                                 
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbnivelesc', 'Nivel escalafón',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('type',['1'=>'Uno','2'=>'Dos'], Auth::user()->empleado->v_nivelescalafon,['class'=>'form-control','disabled'])!!}
          </div>
        </div> 
        <div class="form-group">                                           
          {!! Form::label('lbcatescalafon', 'Categoria escalafón',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('type',['0'=>'Ninguno','UA'=>'Uno-A    / Educadores con más de 35 años de servicio activo','UB'=>'Uno-B   / Educadores con más de 30  y hasta 35 años de servicio activo','UC'=>'Uno-C  / Educadores con más de 25 y hasta 30 años de servicio activo','
          D'=>'Dos    / Educadores con más de 20 y hasta 25 años de servicio activo','T'=>'Tres  / Educadores con más de 15 y hasta 20 años de servicio activo','Cu'=>'Cuatro / Educadores con más de 10 y hasta 15 años de servicio activo','C'=>'Cinco  / Educadores con más de 5 y hasta 10 años de servicio activo','S'=>'Seis   / Educadores hasta con 5 años de servicio activo'], Auth::user()->empleado->v_categoriaescalafon,['class'=>'form-control','disabled'])!!}
          </div>
        </div>  
        <div class="form-group">                                           
          {!! Form::label('lbnip', 'NIP',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtnip',Auth::user()->empleado->v_nip,['class'=>'form-control pull-right','placeholder'=>'9999-9999','readonly']) !!}
          </div>
          </div>

        <div class="form-group">
          {!! Form::label('lbnup','NUP',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtcel',Auth::user()->empleado->v_nup,['class'=>'form-control pull-right','placeholder'=>'9999-9999','readonly']) !!}
          </div>
        </div>                                         
       {{Form::close()}}
  </div>
</div>

		<!--div class="tab-pane" id="tab_2-2">
      <div class="box-body">
        {!! Form::open(['class'=>'form-horizontal']) !!}
        <hr>
        <div class="form-group">                                           
          {!! Form::label('lbusuario', 'Usuario',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('name',Auth::user()->name,['class'=>'form-control pull-right','placeholder'=>'Cuenta de usuario','','readonly'=>'true']) !!}
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
            {!! Form::label('est', 'Estudiante',['class'=>'control-label']) !!}
            <?php } ?>
            <?php if($roles[6]==true){ ?>
            {!! Form::label('pf', 'Padre de Familia',['class'=>'control-label']) !!}
            <?php } ?>
            <?php if($roles[5]==true){ ?>
            {!! Form::label('rrhh', 'Admin RRHH',['class'=>'control-label']) !!}
            <?php } ?>
          </div>    
        </div>
        {{Form::close()}}
      </div>		                
		</div-->

    <!-- /.tab-pane  2-2-->

<!--/////////////////////////////////////////////////////////////////////////////////////////-->		      
		<div class="tab-pane active" id="tab_3-3">
      <div class="box-body">
        {!! Form::open(['class'=>'form-horizontal']) !!}
         <div class="col-sm-12" align="center">
          <output id="list"><img src="{{asset('/imagenes/Recursohumano/'.Auth::user()->foto)}}" height="200px" class="" alt="User Image"></output>
         <hr>
        </div>
        <div class="form-group">                                           
          {!! Form::label('exp', 'Expediente',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtexp',Auth::user()->empleado->v_numeroexp,['class'=>'form-control pull-right','placeholder'=>'Número de expediente','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('nombres', 'Nombres',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtnombres',Auth::user()->empleado->v_nombres,['class'=>'form-control pull-right','placeholder'=>'Nombres ','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('apellidos', 'Apellidos',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtapellidos',Auth::user()->empleado->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Apellidos ','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('genero', 'Género',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">          
            {!! Form::label('lbfem', 'Femenino',['class'=>'col- control-label']) !!}
            <input type="radio" name="v_genero"  class="flat-red" value="Femenino" <?php if(Auth::user()->empleado->v_genero=="Femenino"){ ?> checked="checked" <?php } ?> >
            {!! Form::label('lbmas', 'Masculino',['class'=>'control-label']) !!}
            <input type="radio" name="v_genero"  class="flat-red" value="Masculino" <?php if(Auth::user()->empleado->v_genero=="Masculino"){ ?> checked="checked" <?php } ?> >
          </div> 
        </div>
        <div class="form-group">                                           
          {!! Form::label('lblfec', 'Fecha de nacimiento',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" value="{{Auth::user()->empleado->f_fechanaci}}" readonly="true">
            </div>
          </div>
          </div>
        <div class="form-group">
          {!! Form::label('lbedad', 'Edad',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtedad',$edad,['class'=>'form-control pull-right','placeholder'=>'Años','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbdui', 'DUI',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtdui',Auth::user()->empleado->v_dui,['class'=>'form-control pull-right','placeholder'=>'99999999-9 ','readonly']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('lbdui', 'NIT',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtnit',Auth::user()->empleado->v_nit,['class'=>'form-control pull-right','placeholder'=>'99999999-9 ','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('direccion', 'Dirección',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('txtdireccion',Auth::user()->empleado->v_direccioncasa,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección de residencia','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txttel',Auth::user()->empleado->v_telcasa,['class'=>'form-control pull-right','placeholder'=>'9999-9999','readonly']) !!}
          </div>
          </div>
        <div class="form-group">
          {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtcel',Auth::user()->empleado->v_celular,['class'=>'form-control pull-right','placeholder'=>'9999-9999','readonly']) !!}
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbcorreo', 'Correo electónico',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtcorreo',Auth::user()->empleado->v_correo,['class'=>'form-control pull-right','placeholder'=>'ejemplo@gmai.com','readonly']) !!}
          </div>
        </div>

       </div>        
    </div><!-- /.tab-pane 3-2-->
<!--/////////////////////////////////////////////////////////////////////////////////////////-->		     
  </div><!-- /.tab-content -->
</div><!-- /.nav tab custom -->

@endsection