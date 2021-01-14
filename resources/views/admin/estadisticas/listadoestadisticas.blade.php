@extends('admin.menuprincipal')
@section('tittle','Estadísticas')
@section('content')
<div class="box">
  <div class="box-header">
    <div class="col-sm-4">
      <h2 class="box-title"><strong>ESTADISTICAS Y GRAFICOS / ADMINISTRACION ACADEMICA</strong></h2>
    </div>
  </div>
  <hr>
  <!-- /.box-header -->
  <!-- /.box-body -->
  <div class="box-body" align="center">
    {!! Form::open(['id'=>'formulariorpt','class'=>'form-horizontal','method'=>'GET','target'=>'blank']) !!}
<div class="form-group">
                {!! Form::label('', 'Información a presentar',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
      {!! Form::select('reporte_id',['1'=>'Estudiantes matriculados por grado','2'=>'Estudiantes matriculados por año'],null,['class'=>'form-control','id'=>'reporte_id','required'])!!}
                </div>
                <div class="col-sm-1">
      <input type="button" name="" class="btn btn-primary" id="btngenerargrafico" value="Generar gráfico"></input>
            </div>
          </div>

    {!! Form::close() !!}
  </div>
</div>
@endsection
@section('script')
<script> 
  $('#btngenerargrafico').on('click',function(e) {
var reporte_id=$('#reporte_id').val(); 
    switch (reporte_id){
      case '1':      
     $('#formulariorpt').attr("action", "matriculadosGrado");      
     $('#formulariorpt').submit(); 
      break;
      case '2':
    $('#formulariorpt').attr("action", "matriculadosAño");      
    $('#formulariorpt').submit(); 
      break;
      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }
  });
</script> 
@endsection