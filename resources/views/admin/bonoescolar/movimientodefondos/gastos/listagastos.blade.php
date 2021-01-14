@extends('admin.menuprincipal')
@section('tittle','Bono escolar/ Movimiento de fondos/ Historial gastos')
@section('content')

<div class="box box-primary">
            <div class="box-header">
             <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">CUADRO RESUMEN DE GASTOS</label></h2>
              </div>
            </div>
<div class="box-body">
  {!! Form::open(['route'=>'cuadroresumendegastos_pdf', 'method'=>'POST','class'=>'form-horizontal','target'=>'blank']) !!}
<input type="hidden" name="titulo" id="titulo">
<input type="hidden" name="monto" id="monto">

<div class="form-group" align="right">
<div class="col-sm-12">
                {!! Form::label('rubro', 'Cuenta',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('cuenta',$cuentas,null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'cuenta','required'=>'true'])!!}
                </div>
                
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
                  <th>CHEQUE #</th>
                  <th>FECHA DE CHEQUE</th>
                  <th>CONCEPTO</th>
                  <th>RUBRO</th>
                  <th>MONTO</th> 
                </tr></thead>
                <tbody>
                 
              </tbody>
            </table>
            </div>            
          {!! Form::close() !!}
          </div>
            <!-- /.box-body -->
@endsection
@section('script')
<script >
$('#cuenta').on('change', function(e){
  //alert('cuenta');
  if($('#cuenta').val()!=0)
  {
var id=$('#cuenta').val();//saco el id del estudiante para buscar solo sus familiares
   
$.ajax({
      type: 'POST',
      url: 'listacuentasgastos',
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
 document.getElementById("titulo").value="AÑO A LIQUIDAR: "+value.transaccion_fondodisponible.descripcion;
 document.getElementById("monto").value="MONTO A LIQUIDAR: $"+ value.transaccion_fondodisponible.monto_disponible;
$('#tablaBusqueda').append('<tr id="'+value.id+'"><td>' + value.numero_cheque + '</td><td>' + value.fecha_transaccion +'</td><td>'+ value.concepto  +'</td><td>'+ value.transaccion_rubro.descripcion +'</td><td>'+ value.gasto +'</td></tr>'); 

        });
        table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 5,
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
