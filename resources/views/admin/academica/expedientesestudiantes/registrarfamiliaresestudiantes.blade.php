@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Registro Estudiantil/Estudiante-Familiar')
@section('content')
<div class="box box-primary">
      <div class="box-header with-border box-solid">
          <div class="col-sm-8">
              <h3 class="box-title"><Strong>GRUPO FAMILIAR </Strong></h3>
            </div>
            <div class="col-sm-4 " align="right">      
             <a target="_blank" href="{{ route('agregarfamiliar') }}"class="btn btn-primary">Registrar familiar</a>
            </div>
      </div>
<div class="box-body">
  {!! Form::open(['route'=>'guardarfamiliaresestudiantes', 'method'=>'POST','id'=>'form_principal','class'=>'form-horizontal']) !!}
   <input type="hidden" name="estudiante_id" id="estudiante_id" value={{$exp->id}}>
  <input type="hidden" name="familiar_id" id="familiar_id">
  <input type="hidden" name="parentesco" id="parentesco">
  <input type="hidden" name="encargado" id="encargado">
  <input type="hidden" name="autorizacion" id="autorizacion"> 
       <div class="form-group"> 
          {!! Form::label('expest', 'Estudiante',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                  {!! Form::text('txtexpest',$exp->v_nombres.' '.$exp->v_apellidos ,['class'=>'form-control pull-right','placeholder'=>'Estudiante ','readonly']) !!}
                                                </div>

                                                <div class="col-sm-4">                                             
                                                <div class="input-group input-group">
                                                  <span class="input-group-btn">
                                                        <a href="#" class="btn btn-primary" id="btn_familiares">Mostrar nómina de familiares</a>
                                                      </span>
                                                </div>
                                                </div>
                                                
    </div>
{!! Form::close() !!}

<div class="box-body table-responsive">
  <table class="table table-bordered table-striped" id="tablaBusqueda">
                      <thead>
                              <th>DUI</th>
                              <th>NOMBRE COMPLETO</th>
                              <th>PARENTESCO</th>
                              <th>ES EL ENCARGADO</th>
                  <th>PUEDE RETIRAR AL ESTUDIANTE</th>                              
                              <th>TELEFONO CASA</th>                                   
                              <th>CELULAR</th> 
                              <th>ACCIONES</th>               
                      </thead>
                      <tbody>
               @foreach($familiaresasignados as $familiaresfamiliaresasignados)
                @foreach($familiaresfamiliaresasignados->estudiante_familiares as $datos)
                <tr>
                 @if($datos->dui==null) 
                 <td><span class="label label-default">-----</span></td> 
                   @endif 
                    @if($datos->dui!=null)                  
                  <td>{{$datos->dui}}</td>
                   @endif  
                  <td>{{$datos->nombres}} {{$datos->apellidos}}</td>
                  <td>{{$datos->pivot->parentesco}}</td>
                  <td>{{$datos->pivot->encargado}}</td>
                  <td>{{$datos->pivot->autorizacion}}</td>
                   @if($datos->telefonocasa==null) 
                 <td><span class="label label-default">-----</span></td> 
                   @endif 
                    @if($datos->telefonocasa!=null) 
                 <td>{{$datos->telefonocasa}}</td> 
                   @endif   

                   @if($datos->celular==null) 
              <td><span class="label label-default">-----</span></td> 
                   @endif 
                    @if($datos->celular!=null)                  
                  <td>{{$datos->celular}}</td> 
                   @endif                 
                  <td>            
      <a class="btn btn-danger" data-toggle="modal" title="Eliminar de la lista" data-target="#familiar_{{$datos->id}}">
      <i class="fa fa-close"></i>
      </a>    
                <div class="modal fade" id="familiar_{{$datos->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Confirmar Eliminación</h4>
                      </div><!-- finaliza div modal header danger-->
                      <div class="modal-body">
                        <p>¿Está seguro,  {{$datos->nombres}} {{$datos->apellidos}} ya no estará registrada como familiar del estudiante ?</p>
                      </div><!-- finaliza div modal body-->
        <div class="modal-footer">
         <form method="GET" action="{{route('eliminarrelacionfamiliarestudiante',$datos->id)}}" id="form_eliminar">
                      <input type="hidden" name="id" value="{{$datos->id}}">  
                      <input type="hidden" name="idestu" value="{{$exp->id}}" id="idestu">

                        <input type="submit" value="Eliminar" class="btn btn-sm btn-danger delete-btn"' >                               
                          <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar
                          </button>
        </form>
       </div><!-- finaliza div modal footer-->
      </div><!-- finaliza div modal content-->
      </div><!-- finaliza siv modal dialog-->
                </div> <!-- finaliza div modal fade-->             
                  </td>             
                </tr>
                @endforeach
                  @endforeach
              </tbody>
             </table>
 </div><!-- finaliza table responsive-->
</div><!-- finaliza div body-->
 <div class="box-footer" align="right">            
                  <a href="{{ route('expedienteestudiante_pdf',$exp->id) }}" target="blank" class="btn btn-primary">Imprimir expediente</a>
                  <a href="{{route('listaexpedientes')}}" class="btn btn-default">Finalizar</a>
 </div><!-- finaliza div box footer-->

<div class="modal fade" id="modal-familiares" style="position: fixed;">
          <div class="modal-dialog">
            <div class="modal-content" style=" width:900px;">
              <div class="modal-header primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">FAMILIARES</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="GET" id="form_listafamiliares">

              <div class="box-body table-responsive" id="contenido_dinamico">
                <table class="table table-bordered table-striped" id="tablaBusquedaauxiliar">
                <thead>
                  <th>DUI</th>
                  <th>NOMBRE</th> 
                  <th>PARENTESCO</th> 
                  <th>ES EL ENCARGADO</th>
                  <th>PUEDE RETIRAR AL ESTUDIANTE</th>
                  <th>ACCIONES</th>
                    </thead>
              <tbody>
          
              </tbody>
            </table>
            </div>                
                </form>               
              </div> <!-- /.modal-body -->              
            </div>    <!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal-fade -->


</div><!-- finaliza div box primary-->
@endsection
@section('script')
<script> 
  function seleccionfamiliar(id)
{
  
document.getElementById("parentesco").value = document.getElementById('parentesco'+id).value;
document.getElementById("encargado").value=document.getElementById('encargado'+id).value;
document.getElementById("autorizacion").value = document.getElementById('autorizacion'+id).value;
document.getElementById("familiar_id").value=""+id;
document.getElementById("form_principal").submit();   
}

$(document).ready(function(){
  $('#btn_familiares').on('click', function(e){
 //MOSTRAR LISTA DE FAMILIARES 

$.ajax({
        url:"{{ route('listadofamiliares') }}",
        method:"GET",
        dataType: 'json',
        success:function(data){
          var table=$('#tablaBusquedaauxiliar').DataTable();
          table.destroy(); 
           $('#tablaBusquedaauxiliar tbody').empty();
        $.each(data, function(key, value) {
          if(value.dui!=null){
 $('#tablaBusquedaauxiliar tbody').append('<tr id="'+value.id+'"><td>' + value.dui + '</td><td>' + value.nombres +" "+ value.apellidos + '</td><td>' + '<select name="parentesco[]" id="parentesco'+value.id+'" class="control-label"><option value="Padre">Padre</option><option selected="true" value="Madre">Madre</option><option value="Abuelo">Abuelo</option><option value="Abuela">Abuela</option><option value="Tio">Tio</option><option value="Tia">Tia</option><option value="Hermano">Hermano</option><option value="Hermana">Hermana</option><option value="Ninguno">Ninguno</option></select>' + '</td><td>' + '<select name="encargado[]"  id="encargado'+value.id+'"  class="control-label"><option value="SI">SI</option><option selected="true" value="NO">NO</option></select>' + '</td><td>' + '<select name="autorizacion[]" id="autorizacion'+value.id+'" class="control-label"><option value="SI">SI</option><option  selected="true" value="NO">NO</option></select>' + '</td><td>' + '<a href="#" class="btn btn-warning" onclick="seleccionfamiliar('+value.id+');" data-dismiss="modal" ><i class="fa fa-check"></i></a></td></tr>');
}else
{
   $('#tablaBusquedaauxiliar tbody').append('<tr id="'+value.id+'"><td>' + "---" + '</td><td>' + value.nombres +" "+ value.apellidos + '</td><td>' +  '<select id="parentesco'+value.id+'" name="parentesco[]" class="control-label"><option value="Padre">Padre</option><option selected="true" value="Madre">Madre</option><option value="Abuelo">Abuelo</option><option value="Abuela">Abuela</option><option value="Tio">Tio</option><option value="Tia">Tia</option><option value="Hermano">Hermano</option><option value="Hermana">Hermana</option><option value="Ninguno">Ninguno</option></select>' + '</td><td>' + '<select name="encargado[]" id="encargado'+value.id+'" class="control-label"><option value="SI">SI</option><option selected="true" value="NO">NO</option></select>' + '</td><td>' + '<select name="autorizacion[]" id="autorizacion'+value.id+'" class="control-label"><option value="SI">SI</option><option selected="true"  value="NO">NO</option></select>' +  '</td><td>' + '<a href="#" class="btn btn-warning" onclick="seleccionfamiliar('+value.id+');" data-dismiss="modal" ><i class="fa fa-check"></i></a></td></tr>');
}
           }); 
    table=$('#tablaBusquedaauxiliar').DataTable(
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
 });//cierro $.ajax

 $('#modal-familiares').modal('show');
});//cierrop onclick
});//cierro document ready
</script>
@endsection