@extends('admin.menuprincipal')
@section('tittle','Docentes/Gestión Académica/Control de Calificaciones')
@section('content') 

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h2 class="box-title"><strong>REGISTRAR CALIFICACIONES</strong></h2>
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
             <div class="box-body">
              {!! Form::open(['route'=>'guardarcalificaciones', "id" => "formulario",
                'method'=>'POST','class'=>'form-horizontal']) !!}
              

              <div class="form-group">
              {!! Form::label('seccion','Sección',['class'=>'col-sm-1 control-label']) !!}
              <div class="col-sm-2">
              {!! Form::select('seccion_id',$secciones,null,['class'=>'form-control','required','placeholder'=>'Seleccione','id'=>'seccion_id'])!!}
            </div>
             {!! Form::label('', 'Asignatura',['class'=>'col-sm-1 control-label']) !!}
                         <div class="col-sm-2">
                         {!! Form::select('asignatura_id',[], null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'asignatura_id','required'])!!}
                          </div>
                        
            
              {!! Form::label('nombre','Periodo',['class'=>'col-sm-1 control-label']) !!}
              <div class="col-sm-2">
              {!! Form::select('periodoevaluacion_id',$periodos,null,['class'=>'form-control','required','placeholder'=>'Seleccione','id'=>'periodo_id'])!!}
            </div>
             {!! Form::label('lbnota', 'Actividad',['class'=>'col-sm-1 control-label']) !!}
                         <div class="col-sm-2">
                         {!! Form::select('nota_id',[], null,['class'=>'form-control','id'=>'evaluacionperiodo_id','required','placeholder'=>'Seleccione'])!!}
                          </div>
                        
            </div>
            <div class="form-group" align="center">
              <div class="col-sm-12">
             <input type="button" id="btn-listado" class="btn btn-primary" value="Cargar lista de estudiantes ">
           </div>
            </div>
                  <HR>
              <div class="box-body table-responsive" align="center">
              <table class="table table-bordered table-striped" style="width: 70%" id="tablaAsistencia">
                <thead>
                  <th >EXPEDIENTE</th>
                  <th >NIE</th>
                  <th>ESTUDIANTE</th> 
                  <th>CALIFICACION</th>
                   </thead>
                <tbody>
                 
              </tbody>
            </table>
            </div>
          </div>  
          <!-- /.box-body -->
          <div class="box-footer" align="right" > 
            <button type="submit" 
              class="btn btn-primary">Guardar</button>
          </div>
        {!! Form::close() !!}
        </div>

@endsection

@section('script')
<script>
  $('#seccion_id').on('change', function(e){
     if($('#seccion_id').val()!=0)
   {
var idsec=$('#seccion_id').val();
 $('#asignatura_id').empty();
 $('#asignatura_id').append('<option value="'+ '0' +'" id="asignatura_id" placeholder="Seleccione">'+ 'Seleccione' +'</option>');
    $.ajax({
    type: 'POST',
    url: '/admin/listadoasignaturas/'+idsec,
    data: { 
    '_token': $('input[name=_token]').val()     
    },
    success: function(data){
      $.each(data, function(key,value){
     //alert(value);      
    $('#asignatura_id').append('<option value="'+value.id+'" >'+value.asignatura+'</option>');
      });
       
    } 
  }); //fin ajax
   }
  });

$('#periodo_id').on('change', function(e){
   if($('#periodo_id').val()!=0)
   {
  var id=$('#periodo_id').val();
 $('#evaluacionperiodo_id').empty();
 $('#evaluacionperiodo_id').append('<option value="'+ '0' +'" id="evaluacionperiodo_id" placeholder="Seleccione">'+ 'Seleccione' +'</option>');
    $.ajax({
    type: 'POST',
    url: '/admin/listadoevaluaciones/'+id,
    data: { 
    '_token': $('input[name=_token]').val()     
    },
    success: function(data){
      $.each(data, function(key,value){
     //alert(value);      
    $('#evaluacionperiodo_id').append('<option value="'+value.id+'" >'+value.codigo_eval+'</option>');
      });
       
    } 
  }); //fin ajax
    }
    else
    {

 $('#evaluacionperiodo_id').empty();
    $('#evaluacionperiodo_id').append('<option value="'+ '0' +'" id="evaluacionperiodo_id" placeholder="Seleccione">'+ 'Seleccione' +'</option>');  
    }
});


  $('#btn-listado').on('click', function(e){    
   if($('#seccion_id').val()!=0)
   {   
var id=$('#seccion_id').val();
 $.ajax({
      type: 'POST',
      url: 'listadoestudiantes/'+id,
      dataType: 'json',
      data: {
      '_token': $('input[name=_token]').val()
      },
      success: function(data){
    var table=$('#tabla').DataTable();
    table.destroy();         
    $('#tabla tbody').empty();
    $.each(data, function(key, value) {
$('#tabla').append('<tr id="'+value.id+'"><td>' + value.v_expediente+ '</td><td> @if('+value.v_nie+'!=null)'+value.v_nie +'@endif</td><td>'+ value.v_nombres + ' '+value.v_apellidos+ '</td><td>' + '<input type="hidden" name="ides[]" value="'+value.id +'"/><input type="number" required pattern="[0-9]+" step="any"  name="d_nota[]" id="d_nota[]" min="1" max="10" class="form-control pull-right" ></td></tr>'); 
        });
      },

    });
   }
   else
   {     
    $('#tabla tbody').empty();
   }
  });



$("#formulario").on("submit", function( e ) {
  //e.preventDefault();//permite que se realicen primero todas las instrucciones que se detallen a continuacion y luego haga submit el formulario

  var data = { ides: [], notas: [] };
  var value = $(this).serializeArray();
  $.each(value, function (item, element) {
    if ( element.name == "ides[]" ) {
      data.ides.push(element.value);
    }

    if( element.name == "d_nota[]" ) {
      data.notas.push(element.value)
    }
  });
  //console.log(data)

});
</script>
@endsection
