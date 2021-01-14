@extends('admin.menuprincipal')
@section('tittle','Bono escolar/ Movimiento de fondos/ Ingresos')
@section('content')

<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-4">
              <h2 class="box-title"><strong>INGRESOS</strong></h2>
              </div>
            </div>
           <div class="form-group" align="right">
<div class="form-group" align="right">
<div class="col-sm-12">
                {!! Form::label('rubro', 'Cuenta',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('cuenta',$cuentas,null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'cuenta'])!!}
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
                  <th>MONTO</th> 
                </tr></thead>
                <tbody>
           

              </tbody>
            </table>
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
var id=$('#cuenta').val();//saco el id del estudiante para buscar solo sus familiares
   
$.ajax({
      type: 'POST',
      url: 'listacuentasingresos',
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

$('#tablaBusqueda').append('<tr id="'+value.id+'"><td>'+ value.fecha_transaccion +'</td><td>'+ value.concepto  +'</td><td>'+ value.ingreso +'</td></tr>'); 

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

