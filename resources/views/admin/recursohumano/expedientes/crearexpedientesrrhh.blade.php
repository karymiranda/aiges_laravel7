@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Registro de Personal')
@section('content')


  <!-- comienza formulario datos personales -->
  <div class="box box-primary box-solid">
    <div class="box-header ">
      <h1 class="box-title"><strong>REGISTRAR PERSONAL</strong></h1>
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
    {!! Form::open(['route'=>'agregarexpedienterh', 'method'=>'POST','class'=>'form-horizontal']) !!}    
    {!! Form::hidden('estado','1') !!}       
    <div class="box-body">      
      <div class="form-group">                                           
        {!! Form::label('exp', 'Expediente *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('v_numeroexp',$expediente,['class'=>'form-control pull-right','placeholder'=>'Número de expediente','readonly','required']) !!}
        </div>       
      </div>
      <div class="form-group">                                           
        {!! Form::label('nombres', 'Nombres *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('v_nombres',null,['class'=>'form-control pull-right','placeholder'=>'Nombres ','required']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('apellidos', 'Apellidos *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('v_apellidos',null,['class'=>'form-control pull-right','placeholder'=>'Apellidos ','required']) !!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('genero', 'Género ',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::label('lbfem', 'Femenino',['class'=>'control-label']) !!}
          {!! Form::radio('v_genero','Femenino',true, ['class'=>'flat-red'])!!}
          {!! Form::label('lbmas', 'Masculino',['class'=>'control-label']) !!}
          {!! Form::radio('v_genero','Masculino',false, ['class'=>'flat-red'])!!}
        </div> 
      </div>
      <div class="form-group">                                           
        {!! Form::label('lblfec', 'Fecha de nacimiento *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" value="{{ old('f_fechanaci') }}" name="f_fechanaci" id="nac" onblur="calcular(this,'edad')" onchange="calcular(this,'edad')" class="form-control pull-right nac" data-mask required="true">
          </div>          
        </div>
         </div>
      <div class="form-group"> 
        {!! Form::label('lbedad', 'Edad (Años) ',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="txtedad" value="{{ old('txtedad') }}" class="form-control pull-right" id="edad" placeholder="Años" readonly="true" required="true">          
        </div>                                         
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbdui', 'DUI *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_dui" value="{{ old('v_dui') }}" class="form-control" data-inputmask='"mask": "99999999-9","clearIncomplete":"true"' data-mask required="true">
        </div>
         </div>
      <div class="form-group"> 
        {!! Form::label('lbdui', 'NIT *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_nit" value="{{ old('v_nit') }}" class="form-control" data-inputmask='"mask": "9999-999999-999-9","clearIncomplete":"true"' data-mask required="true">
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('direccion', 'Dirección *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <textarea name="v_direccioncasa" class="form-control pull-right" rows="2" placeholder="Dirección de residencia" required="true" resix>{{ old('v_direccioncasa') }}</textarea>
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbltel', 'Teléfono de residencia',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-phone"></i>
            </div>
            <input type="text" name="v_telcasa" value="{{ old('v_telcasa') }}" class="form-control tel" data-mask>
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
            <input type="text" name="v_celular" value="{{ old('v_celular') }}" class="form-control tel" data-mask>
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
            <input type="text" name="v_correo" value="{{ old('v_correo') }}" class="form-control pull-right" placeholder="ejemplo@gmai.com">
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
            <input type="text" name="f_fechaingresoalCE" value="{{ old('f_fechaingresoalCE') }}" class="form-control pull-right calendario" data-mask>
          </div>
        </div>                                              
      </div>  
      <div class="form-group">                                           
        {!! Form::label('lbtipopersonal', 'Tipo personal *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">          
          <div class="input-group">
            {!! Form::select('tipopersonal_id',$tiposPersonal, null,['class'=>'form-control','id'=>'tipopersonal'])!!}
            <div class="input-group-addon" style="padding: 0">
              <a data-toggle="modal" data-target="#form_tipo" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
            </div>
          </div>
        </div>
         </div>
      <div class="form-group"> 
        {!! Form::label('lbcargo', 'Cargo *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group">
            {!! Form::select('cargo_id',$cargos, null,['class'=>'form-control'])!!}
            <div class="input-group-addon" style="padding: 0">
              <a data-toggle="modal" data-target="#form_cargo" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
            </div>
          </div>
        </div>
      </div>  
      <div class="form-group">                                           
        {!! Form::label('lbtipocontrato', 'Tipo de contratación *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('v_tipocontratacion',['SB'=>'Sueldo base','SS'=>'Sobre sueldo','HC'=>'Horas clase'], null,['class'=>'form-control'])!!}
        </div>
         </div>
      <div class="form-group"> 
        {!! Form::label('lbsueldo', 'Salario mensual',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-dollar"></i>
            </div>        
            <input type="text" name="d_sueldo" value="{{ old('d_sueldo') }}" class="form-control pull-right" data-inputmask="'alias': 'decimal'" data-mask>
          </div>
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbescpeciadlidad', 'Especialidad *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group">
            {!! Form::select('especialidad_id',$especialidades, null,['class'=>'form-control'])!!}
            <div class="input-group-addon" style="padding: 0">
              <a data-toggle="modal" data-target="#form_espe" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
            </div>
          </div>
        </div>
         </div>
      <div class="form-group"> 
        {!! Form::label('lbtitulo', 'Titulo Académico',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_tituloacademico" value="{{ old('v_tituloacademico') }}" class="form-control pull-right" placeholder="Titulo Académico">
        </div>
      </div> 
      <div class="form-group">                                           
        {!! Form::label('lblfecingsedu', 'Fecha de ingreso al sistema educativo',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="f_fechaingresoministerio" value="{{ old('f_fechaingresoministerio') }}" class="form-control pull-right calendario" data-mask>
          </div>
        </div>                                 
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbnivelesc', 'Nivel escalafón ',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('v_nivelescalafon',['0'=>'Ninguno','1'=>'Uno','2'=>'Dos'], null,['class'=>'form-control'])!!}
        </div>
      </div> 
      <div class="form-group">                                           
        {!! Form::label('lbcatescalafon', 'Categoria escalafón ',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('v_categoriaescalafon',['0'=>'Ninguno','UA'=>'Uno-A    / Educadores con más de 35 años de servicio activo','UB'=>'Uno-B   / Educadores con más de 30  y hasta 35 años de servicio activo','UC'=>'Uno-C  / Educadores con más de 25 y hasta 30 años de servicio activo','
          D'=>'Dos    / Educadores con más de 20 y hasta 25 años de servicio activo','T'=>'Tres  / Educadores con más de 15 y hasta 20 años de servicio activo','Cu'=>'Cuatro / Educadores con más de 10 y hasta 15 años de servicio activo','C'=>'Cinco  / Educadores con más de 5 y hasta 10 años de servicio activo','S'=>'Seis   / Educadores hasta con 5 años de servicio activo'], null,['class'=>'form-control'])!!}
        </div>
      </div>  
      <div class="form-group">                                           
        {!! Form::label('lbnip', 'NIP',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_nip" value="{{ old('v_nip') }}" class="form-control pull-right" data-inputmask='"mask": "999999999","clearIncomplete":"true"' data-mask placeholder="Número de Identificación Profesional">
        </div>
         </div>
      <div class="form-group"> 
        {!! Form::label('lbnup','NUP',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <input type="text" name="v_nup" value="{{ old('v_nup') }}" class="form-control pull-right" data-inputmask='"mask": "999999999999","clearIncomplete":"true"' data-mask placeholder="Número Único Previsional">
        </div>
      </div>                                                     
    </div>
    <div class="box-footer" align="right">                
      {!! Form::submit('Siguiente >>', ['class'=>'btn btn-primary']) !!}
      <a href="{{ route('listaexpedientesrh') }}" class="btn btn-default">Cancelar</a>
    </div>
    {!! Form::close() !!}
    <div class="modal fade" id="form_cargo">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('cargorh')}}" method="GET" class="form-horizontal" >
            <div class="modal-header primary">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Agregar Tipo Cargo</h4>
            </div>
            <div class="modal-body">                        
              <div class="form-group">                                           
                {!! Form::label('lbid', 'Código',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-4">
                  {!! Form::text('txtid',$codigoC,['class'=>'form-control pull-right','placeholder'=>'Código','disabled','required']) !!}
                </div>
              </div>
              <div class="form-group">                                           
                {!! Form::label('lbtipocargo', 'Tipo cargo',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                  {!! Form::text('v_descripcion',null,['class'=>'form-control pull-right','placeholder'=>'Cargo','required']) !!}
                  {!! Form::hidden('estado','1') !!}
                </div>
              </div>                     
            </div>
            <div class="modal-footer">
              {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
              <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="form_espe">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('esperh')}}" method="GET" class="form-horizontal" >
            <div class="modal-header primary">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Agregar Especialidad</h4>
            </div>
            <div class="modal-body">                        
              <div class="form-group">                                           
                {!! Form::label('lbid', 'Código',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-4">
                  {!! Form::text('txtid',$codigoE,['class'=>'form-control pull-right','placeholder'=>'Código','disabled','required']) !!}
                </div>
              </div>
              <div class="form-group">                                           
                {!! Form::label('lbespecialidad', 'Especialidad',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                  {!! Form::text('v_especialidad',null,['class'=>'form-control pull-right','placeholder'=>'Especialidad','required']) !!}
                  {!! Form::hidden('estado','1') !!}
                </div>
              </div> 
            </div>
            <div class="modal-footer">
              {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
              <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="form_tipo">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('tiporh')}}" method="GET" class="form-horizontal" >
            <div class="modal-header primary">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Agregar Tipo Personal</h4>
            </div>
            <div class="modal-body">                        
              <div class="form-group">                                           
                {!! Form::label('lbid', 'Código',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-4">
                  {!! Form::text('id',$codigoT,['class'=>'form-control pull-right','placeholder'=>'Código','disabled','required']) !!}
                </div>
              </div>
              <div class="form-group">                                           
                {!! Form::label('lbtipopersonal', 'Tipo personal',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-6">
                  {!! Form::text('v_tipopersonal',null,['class'=>'form-control pull-right','placeholder'=>'Tipo personal','required']) !!}
                  {!! Form::hidden('estado','1') !!}
                </div>
              </div>
            </div>
            <div class="modal-footer">
              {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
              <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
@endsection
@section('script')
<script>
  
//Calculo de edad
function calcular(txtfecha, txtedad){
  if(txtfecha.value!="")
  { 
    contenido = txtfecha.value.split('/');
    fecha = new Date(contenido[2], contenido[1] - 1, contenido[0]);
    ageDifMs = Date.now() - fecha.getTime();
    ageDate = new Date(ageDifMs);
    ed = Math.abs(ageDate.getUTCFullYear() - 1970);
    $('#'+txtedad).val(ed);
  }
  else{
    $('#'+txtedad).val('');
  }
}

$('#tipopersonal').on('change', function(e){
var id = document.getElementById("tipopersonal");
var text = id.options[id.selectedIndex].innerText;
text = new String(text).toUpperCase();

//alert(text);
});

</script>
@endsection