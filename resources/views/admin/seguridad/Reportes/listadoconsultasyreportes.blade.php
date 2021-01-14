@extends('admin.menuprincipal')
@section('tittle','Seguridad/ Reportes')
@section('content')


<div class="box box-primary">
  <div class="col-sm-12" align="center">
              <h2><label class="text-primary">REPORTES SEGURIDAD</label></h2>
             </div> 

             <div class="box-body">
          {!! Form::open(['id'=>'formulariorpt','class'=>'form-horizontal','target'=>'blank']) !!}
             
             <div class="form-group">
                {!! Form::label('', 'Reportes',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('reporte_id',['1'=>'Nómina de usuarios','2'=>'Bitacora'],null,['class'=>'form-control','id'=>'reporte_id','required'])!!}
                </div>
            </div>


    <div class="col-sm-12"align="center">
     <div class="form-group"> 
      <a href="#" title="Exportar excel" class="btn btn-success" id="referencia"><i class="fa fa-download"></i> Generar Excel</a>
    </div>
    </div><!--fin col sm12-->

</div>

 {!! Form::close() !!}
            </div>
@endsection

@section('script')
<script> 
$('#referencia').on('click', function(e){
  var reporte_id=$('#reporte_id').val();
switch (reporte_id){
      case '1':
      $('#referencia').attr("href", "exportUsuarios"); 
      break;
      case '2':
      $('#referencia').attr("href", "exportBitacora"); 
      break;
      default:
      console.log('Lo lamentamos, por el momento no disponemos de información ');
      break;
    }

 });
</script>
@endsection






















