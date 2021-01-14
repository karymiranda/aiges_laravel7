@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Calificaciones/Evaluaciones')
@section('content')
 
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>REGISTRAR EVALUACION</Strong></h3>
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

    <div hidden="true" class="alert alert-danger" role="alert" id="errores">
    <ul></ul>
    </div>
    
              <div class="box-body" >
              {!! Form::open(['route'=>'detalleregistroevaluacion', 'method'=>'POST', 'class'=>'form-horizontal','id'=>'formulario']) !!}
              <input type="hidden" name="idedit" id="idedit">
              <input type="hidden" name="porcentajeanterior" id="porcentajeanterior">
               <input type="hidden" name="ideliminar" id="ideliminar">
    <div class="form-group"> 
      <div class="col-sm-6">
             <div class="form-group"> 
              {!! Form::label('nombre','Periodo',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-6">
                {!! Form::select('periodoevaluacion_id',$idperiodo,null,['class'=>'form-control','required','id'=>'periodo_id','readonly'])!!}
                </div> 
              </div>
              <div class="form-group"> 
                {!! Form::label('nombre', 'Grado/Sección',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-6">
                <div class="input-group input-group">                  
                {!! Form::select('seccion_id',$idseccion,null,['class'=>'form-control','required','id'=>'seccion_id','readonly'])!!}
              </div>
                </div>
              </div>
              <div class="form-group"> 
                {!! Form::label('nombre', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-6">
                {!! Form::select('asignaturas_id',$idasignatura,null,['class'=>'form-control','required','id'=>'asignatura_id','readonly'])!!}
              </div>                                  
              </div>
      </div>

         
    <div class="col-sm-6">
              <div class="form-group">                                          
                {!! Form::label('codigo', 'Código evaluación ',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-6">
                  {!! Form::text('codigo_eval',null,['class'=>'form-control pull-right','placeholder'=>'Código evaluación','required','id'=>'codigo_eval']) !!}
                </div>
              </div>
              <div class="form-group">  
                 {!! Form::label('codigo', 'Nombre evaluación ',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-6">
                  {!! Form::text('nombre',null,['class'=>'form-control pull-right','placeholder'=>'Nombre evaluación','required','id'=>'nombre']) !!}
                </div>
              </div>

              <div class="form-group">                                         
              {!! Form::label('', 'Ponderación',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('d_porcentajeActividad',['10'=>'10%','15'=>'15%','20'=>'20%','25'=>'25%','30'=>'30%','35'=>'35%','40'=>'40%','45'=>'45%','50'=>'50%'],null,['class'=>'form-control','id'=>'d_porcentajeActividad'])!!}
              </div> 
               <div class="col-sm-4">                
                  <a class="btn btn-success btn-sm" id="btnagregar">Agregar</a>             
              </div>
              </div>  
        </div>
        </div> 
                                                              
   <!-- /.box-header -->
            <div class="box-body table-responsive" align="center">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                  <th>CODIGO EVALUACION</th>
                   <th>NOMBRE EVALUACION</th>
                   <th>PONDERACION %</th>                  
                  <th>ACCIONES</th>
                </thead>
                <tbody> 
       @foreach($datos as $datos)
                <tr>  
                 <td>{{$datos->codigo_eval}}</td>        
                 <td>{{$datos->nombre}}</td>
                 <td>{{$datos->d_porcentajeActividad}}</td>
                 <td> 
      <a class="btn btn-success" title="Editar" id="btneditar" name="{{$datos->id}}" 
 onclick="seleccion({{$datos->id}},'{{$datos->codigo_eval}}','{{$datos->nombre}}','{{$datos->d_porcentajeActividad}}');"><i class="fa fa-edit"></i></a>
        <a class="btn btn-danger" data-toggle="modal"  title="Eliminar" data-target="#evaluacion_{{$datos->id}}"><i class="fa fa-close"></i></a>
              <div class="modal fade" id="evaluacion_{{$datos->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Confirmar Eliminación</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea eliminar la evaluación {{$datos->nombre}}?</p>
                    </div>
         <div class="modal-footer">
         <form method="GET" action="">
         <a class="btn btn-danger" data-dismiss="modal" title="Eliminar" id="btneliminar" name="{{$datos->id}}" 
 onclick="seleccioneliminar({{$datos->id}});">Eliminar</a>
                            
                        <button type="button" class="btn btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
        </form>
                    </div>
                  </div>
                </div>
              </div>
                 </td> 
                 </tr> 
                    @endforeach              
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
              </div>  
              {!! Form::close() !!}     
          <div class="box-footer" align="right">   
    <a href="{{route('agregarevaluacionesperiodo')}}" class="btn btn-primary">Finalizar</a> 
    <a href="{{route('listaevaluacionesperiodo')}}" class="btn btn-default">Cancelar</a>
          </div>
         

     </div>
@endsection
@section('script')
<script>
  function seleccion(id,codigo_eval,nombre,d_porcentajeActividad)
  {
  document.getElementById("idedit").value=""+id;
  document.getElementById("nombre").value=""+nombre;
  document.getElementById("codigo_eval").value=""+codigo_eval;  
  document.getElementById("d_porcentajeActividad").value=""+d_porcentajeActividad;
  document.getElementById("porcentajeanterior").value=""+d_porcentajeActividad;
  $('#btnagregar').text('Actualizar');
  }

  function seleccioneliminar(id)
   {
document.getElementById("ideliminar").value=""+id;
var id=$('#ideliminar').val();
 $.ajax({
    type: 'POST',
    url: 'eliminarevaluacionesperiodo/'+id,
    data: { 
    '_token': $('input[name=_token]').val()     
    },
    success: function(data){
        if(data==true)
        { $('#formulario').submit();}
      else
      {
$('#errores').removeAttr('hidden');
$('#errores').append("<li>No se puede completar la acción. Existen registros de calificaciones activos para ésta evaluación.</li>");
      }
    }
  });

   }

$('#btnagregar').on('click', function(e){
  //alert('ADD');
  if($('#btnagregar').text()=="Agregar")
  {
    $.ajax({
      type: 'POST',
      url: 'guardarevaluacionesperiodo',
      data: {
      '_token': $('input[name=_token]').val(),
        'periodoevaluacion_id': $('select[name=periodoevaluacion_id]').val(),
        'seccion_id': $('select[name=seccion_id]').val(),
        'asignaturas_id': $('select[name=asignaturas_id]').val(),
        'codigo_eval': $('input[name=codigo_eval]').val(),
        'nombre': $('input[name=nombre]').val(),
        'd_porcentajeActividad': $('select[name=d_porcentajeActividad]').val()
      },
      success: function(data){ 
       if ((data.errors)) {
          $('#errores').removeAttr('hidden');
          $('#errores').append("<li>"+ data.errors.codigo_eval+"</li>");
          $('#errores').append("<li>"+ data.errors.nombre+"</li>");
        } else {       
          //$('#errores').remove();
          if(data.d_porcentajeActividad<=100){
         $('#formulario').submit();
        }
        else
        {
          $('#errores').removeAttr('hidden');
          $('#errores').append("<li>No se pudo agregar la evaluación ya que la ponderación de todas las evaluaciones para ésta asignatura sobrepasan el 100%</li>");
        }
      }
      },
    });
    $('#codigo_eval').val('');
    $('#nombre').val('');
  }

//ACTUALIZAR INFORMACION
if($('#btnagregar').text()=="Actualizar")
  {
$.ajax({
      type: 'POST',
      url: 'actualizarevaluacionesperiodo',
      data: {
      '_token': $('input[name=_token]').val(),
        'id': $('input[name=idedit]').val(),
        'porcentajeanterior': $('input[name=porcentajeanterior]').val(),
        'codigo_eval': $('input[name=codigo_eval]').val(),
        'nombre': $('input[name=nombre]').val(),
        'd_porcentajeActividad': $('select[name=d_porcentajeActividad]').val()
      },
      success: function(data){ 
       if ((data.errors)) {
          $('#errores').removeAttr('hidden');
          $('#errores').append("<li>"+ data.errors.codigo_eval+"</li>");
          $('#errores').append("<li>"+ data.errors.nombre+"</li>");
        } else {       
          //$('#errores').remove();
          if(data.d_porcentajeActividad<=100){
         $('#formulario').submit();
        }
        else
        {
          $('#errores').removeAttr('hidden');
          $('#errores').append("<li>No se pudo actualizar la evaluación ya que la ponderación de todas las evaluaciones para ésta asignatura sobrepasan el 100%</li>");
        }
      }
      },
    });
    $('#codigo_eval').val('');
    $('#nombre').val('');
     $('#btnagregar').text('Agregar');
  }

  });

</script>
@endsection