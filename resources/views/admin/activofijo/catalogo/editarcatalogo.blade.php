@extends('admin.menuprincipal')
@section('tittle', 'Administración activo fijo/Catálogo')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>ACTUALIZAR CUENTA</Strong></h3>
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
  <!-- /.box-header -->
  <!-- form start -->        
  <div class="box-body">
    {!! Form::open(['route'=>['actualizarcatalogoactivo',$cuenta->id],'method'=>'PUT','class'=>'form-horizontal']) !!}
    {!! Form::hidden('estado', '1') !!}
    {!! Form::hidden('v_nivel', $cuenta->v_nivel) !!}
      <div class="form-group">                                           
        {!! Form::label('lbnivel', 'Nivel',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::label('lb3', 'Cuenta principal',['class'=>'col- control-label']) !!}
          <input type="radio" name="v_nivel" value="3" disabled="true" <?php if($cuenta->v_nivel=="3"){ ?> checked="checked" <?php } ?> >
          {!! Form::label('lb4', 'Sub cuenta',['class'=>'control-label']) !!}
          <input type="radio" name="v_nivel" disabled="true" value="4" <?php if($cuenta->v_nivel=="4"){ ?> checked="checked" <?php } ?> >
        </div> 
      </div>
      <div class="form-group">
        {!! Form::label('lbsup', 'Cuenta Superior',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('v_sup',$sup, $codsup,['class'=>'form-control','id'=>'id_niv'])!!}
        </div>
      </div>
      <div class="form-group">                                           
        {!! Form::label('lbcodigo', 'Código',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('v_codigocuenta',$cuenta->v_codigocuenta,['class'=>'form-control pull-right','data-mask'=>'','data-inputmask'=>$mask,'id'=>'id_cod','required'])!!}
        </div>
      </div>
      <div class="form-group"> 
        {!! Form::label('lbnombre', 'Nombre',['class'=>'col-sm-4 control-label']) !!}          
        <div class="col-sm-5">            
          {!! Form::text('v_nombrecuenta',$cuenta->v_nombrecuenta,['class'=>'form-control pull-right','placeholder'=>'Nombre de la Cuenta','required']) !!}
        </div> 
      </div>
      <div class="box-footer" align="right">                
          {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
            <a href="{{route('catalogoactivo')}}" class="btn btn-default">Cancelar</a>
      </div>
    {!! Form::close() !!}
    <!-- /.box-footer -->
  </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {

//Llenar cuentas de nivel 3 y 4 Catalogo de cuentas activo
  $('input:radio[name="v_nivel"]').click(function(){
  var id=$(this).val();
  $("#id_cod").val('');
  $("#id_cod").inputmask('remove');
  var mask ='';
  if(id=='4'){ 
    $.ajax({
        url:"{{ route('cuentasnivel3') }}",
        method:"GET",
        success:function(data){
          $('#id_niv').empty();
          $('#id_niv').append(data);
          mask = $("#id_niv option:selected").val()+"99";
          $("#id_cod").inputmask("mask", { "mask": mask, "clearIncomplete":"true" });
        }
      });
  }else{
    $('#id_niv').empty();
    $('#id_niv').append('<option value=12 selected>12 - Activo Fijo</option>');
    mask = $("#id_niv option:selected").val()+"99";
    $("#id_cod").inputmask("mask", { "mask": mask, "clearIncomplete":"true" }); 
    }
  });

  //cambiar mascara para codigo de nivel cuenta catalogo
  $("#id_niv").on('change',function(){ 
   var opt = $("#id_niv option:selected").val(); 
   var mask = "";
   mask = opt+"99";
   $("#id_cod").val('');
   $("#id_cod").inputmask("mask", { "mask": mask, "clearIncomplete":"true" });
  });

});
</script>
@endsection