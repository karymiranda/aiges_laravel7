@extends('admin.menuprincipal')
@section('tittle','Consultas y reportes/Bono escolar/ Operación y funcionamiento')
@section('content')

<div class="box box-primary">
            <div class="box-header">
                <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">OPERACION Y FUNCIONAMIENTO</label></h2>
              </div>
            </div>
<div class="box-body">
  {!! Form::open(['route'=>'librooperacionyfuncionamiento_pdf', 'method'=>'POST','class'=>'form-horizontal','target'=>'blank']) !!}
<input type="hidden" name="titulo" id="titulo">
<input type="hidden" name="monto" id="monto">
<div class="form-group" align="center">
<div class="col-sm-12">
                {!! Form::label('rubro', 'CUENTA',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('cuenta',$cuentas,null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'cuenta','required'=>'true'])!!}
                </div> 
           <!--div class="col-sm-2">                  
          {!! Form::label('lbfemenino', 'PDF',['class'=>'col- control-label']) !!}
          {!! Form::radio('formatoreporte','1',true, ['class'=>'flat-red','id'=>'1'])!!}
          {!! Form::label('lbmasculino', 'EXCEL',['class'=>'control-label']) !!}
          {!! Form::radio('formatoreporte','2',false, ['class'=>'flat-red','id'=>'2'])!!} 
                </div-->
                <div class="col-sm-2"> 
                <button class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Generar reporte</button>
                </div>
</div>
</div>
<div class="form-group">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                <tr> 
                  <th>FECHA</th> 
                  <th>CONCEPTO</th>
                  <th>CHEQUE</th>
                  <th>INGRESOS</th>                               
                  <th>GASTOS</th>
                  <th>SALDOS</th>
                </tr></thead>
                <tbody>
                 
              </tbody>
            </table>
            </div>
          </div>
        </div>
            <!-- /.box-body -->
@endsection
@section('script')
<script >
$('#cuenta').on('change', function(e){
  //alert('cuenta');
  if($('#cuenta').val()!=0)
  {
var id=$('#cuenta').val();
   
$.ajax({
      type: 'POST',
      url: 'historialperacionyfuncionamiento',
      dataType: 'json',
      data: {
      '_token': $('input[name=_token]').val(),
      'id': $('select[name=cuenta]').val()
      },
      success: function(data){
    var table=$('#tablaBusqueda').DataTable();
    table.destroy();         
    $('#tablaBusqueda tbody').empty();
    $.each(data, function(key, value) {      
 document.getElementById("titulo").value=value.transaccion_fondodisponible.descripcion;
 document.getElementById("monto").value="MONTO $"+ value.transaccion_fondodisponible.monto_disponible;
if(value.tipo_transaccion=='INGRESO') {
$('#tablaBusqueda').append('<tr id="'+value.id+'"><td>' + value.fecha_transaccion + '</td><td>'+ value.concepto + '</td><td>' + "N/A" +'</td><td>'+ "$ "+ value.ingreso  +'</td><td>'+ "-" +'</td><td>'+"$ "+  value.saldo +'</td></tr>'); 
}
else if(value.tipo_transaccion=='GASTO'){
$('#tablaBusqueda').append('<tr id="'+value.id+'"><td>' + value.fecha_transaccion + '</td><td>'+ value.concepto + '</td><td>' + value.numero_cheque +'</td><td>'+ "-"  +'</td><td>'+ "$ "+ value.gasto +'</td><td>'+ "$ "+  value.saldo +'</td></tr>');

}else if(value.tipo_transaccion=='ANULADO'){
$('#tablaBusqueda').append('<tr id="'+value.id+'"><td>' + value.fecha_transaccion + '</td><td>'+ value.concepto + '</td><td>' + value.numero_cheque +'</td><td>'+"-"   +'</td><td>'+ "-"  +'</td><td>'+"-"  +'</td></tr>'); 
}
        });
        table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 25,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  }); 
    }
});  
  }
});
</script>
@endsection
