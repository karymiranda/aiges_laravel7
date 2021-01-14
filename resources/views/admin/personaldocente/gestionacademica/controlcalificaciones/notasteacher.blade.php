@extends('admin.menuprincipal')
@section('tittle', 'Docentes/Gestión Académica/Secciones/Calificaciones')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>CALIFICACIONES : {{$seccion->descripcion}}</Strong></h3>
  </div>
 
  {!! 
    Form::open([
      'url' => '/seccionnotasteacher', 'method'=>'POST', 'class'=>'form-horizontal', 'id'=>'form'
    ]) !!}
    <div class="box-body">
      <div class="form-group">
        {!! Form::label('periodo', 'Periodo', ['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          <select name="periodo" id="periodo" class="form-control" title="Muestra solamente el periodo de evaluación activo" value>            
            @foreach ($periodos as $item)
              <option value="{{ $item->id }}">
                {{ $item->nombre }} [{{$item->descripcion}}]
              </option>
            @endforeach           
          </select>
        </div>
      </div>
     

                <div class="form-group"> 
      {!! Form::label('materia', 'Materia', ['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-4">                                  
           <div class="input-group input-group">
                               {!! Form::select('materia', $asignaturas, null, ['class'=>'form-control','id'=>'asignatura','title'=>'Lista de asignaturas según carga académica definida en horario de clases','required'])!!}                                  
           <span class="input-group-btn">
            <a  class="btn btn-primary"                                                     id="btnvernotas">Ver calificaciones</a>
                   </span>
                  </div>
              </div>
            </div>



      <div class="form-group">
        {!! Form::label('evaluacion', 'Evaluación', ['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          {!! Form::select('evaluacion', $evaluaciones, null, ['class'=>'form-control','required'])!!}
        </div>
      </div>
    </div>
    <div class="box-footer" align="right">
      <input type="hidden" name="seccion_id" value="{{ $id }}" />
      {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
      <a href="{{route('misseccionesteacher')}}" class="btn btn-default">Cancelar</a>
    </div>
  {!! Form::close() !!}
  @endsection

@section('script')
<script>
$('#btnvernotas').on('click', function(e){ 
  var url = "/aiges/public/index.php/admin/"; 
var asig=$('select[name=materia]').val();
$('#form').attr("method",'GET');
$('#form').attr("target",'__blank');
$('#form').attr("action",url+'cuadrorendimientoescolar_pdf/'+<?=$seccion->id?>+'/'+asig+'/view');  
 $('#form').submit(); 


});

</script>
@endsection
