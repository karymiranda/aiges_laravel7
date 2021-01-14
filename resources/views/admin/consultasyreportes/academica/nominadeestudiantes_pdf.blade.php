@extends('admin.menuprincipal')
@section('tittle','Consultas y Reportes/Nómina de Estudiantes')
@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <h2 class="box-title"><strong>NOMINA DE ESTUDIANTES POR SECCION</strong></h2>
             </div> 

             <div class="box-body">
              {!! Form::open(['route'=>'nominadeestudiantes_pdf', 'method'=>'POST','class'=>'form-horizontal','target'=>'blank']) !!}

 <div class="form-group" align="right">
    <div class="col-sm-12">
                 {!! Form::label('rubro', 'Año lectivo',['class'=>'col-sm-1 control-label']) !!}
                <div class="col-sm-2">                  
                 {!! Form::select('periodo_id',$anioslectivos,null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'periodoactivo_id','required'])!!} 
                </div>
                {!! Form::label('rubro', 'Grado/Sección',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-2">
                 {!! Form::select('seccion_id',[],null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'seccion_id','required'])!!}
                </div>
                <div class="col-sm-3">                  
          {!! Form::label('lbfemenino', 'PDF',['class'=>'col- control-label']) !!}
          {!! Form::radio('formatoreporte','1',true, ['class'=>'flat-red','id'=>'1'])!!}
          {!! Form::label('lbmasculino', 'EXCEL',['class'=>'control-label']) !!}
          {!! Form::radio('formatoreporte','2',false, ['class'=>'flat-red','id'=>'2'])!!} 
                </div>
                <div class="col-sm-2"> 
                <button class="btn btn-primary">Generar reporte</button>
                </div>
    </div>
</div>
</div>
            
            <!-- /.box-body -->

            <div class="box-footer" align="right" >           
           </div>
 {!! Form::close() !!}
            </div>

@endsection
@section('script')
<script>
$('#periodoactivo_id').on('change', function(e){ 
  if($('#periodoactivo_id').val()!='')
  {
$('#seccion_id').empty();
//inicia ajax
 $.ajax({
      type: 'POST',
      url: 'listadoseccionesporaniolectivo',
      dataType: 'json',
      data: {
      '_token': $('input[name=_token]').val(),
      'periodo_id': $('select[name=periodo_id]').val()
      },
      success: function(data){
       $.each(data, function(key, value) {  
$('#seccion_id').append('<option value="'+value.id+'" >'+value.grado+'</option>');
        });
//fin ajax
  }
});
}
});
</script>
@endsection
