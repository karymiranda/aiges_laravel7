@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Calificaciones/Evaluaciones')
@section('content')
 
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>LISTADO EVALUACIONES POR ASIGNATURA</Strong></h3>
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
    <div class="form-group"> 
      <div class="col-sm-12">
             <div class="form-group"> 
              {!! Form::label('nombre','Periodo',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::select('periodoevaluacion_id',$idperiodo,null,['class'=>'form-control','required','id'=>'periodo_id','readonly'])!!}
                </div> 
              </div>
              <div class="form-group"> 
                {!! Form::label('nombre', 'Grado/Sección',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                <div class="input-group input-group">                  
                {!! Form::select('seccion_id',$idseccion,null,['class'=>'form-control','required','id'=>'seccion_id','readonly'])!!}
              </div>
                </div>
              </div>
              <div class="form-group"> 
                {!! Form::label('nombre', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::select('asignaturas_id',$idasignatura,null,['class'=>'form-control','required','id'=>'asignatura_id','readonly'])!!}
              </div>                                  
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
                  
                </thead>
                <tbody> 
       @foreach($datos as $datos)
                <tr>  
                 <td>{{$datos->codigo_eval}}</td>        
                 <td>{{$datos->nombre}}</td>
                 <td>{{$datos->d_porcentajeActividad}}</td>
                 </tr> 
                    @endforeach              
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
              </div>  
              {!! Form::close() !!}     
          <div class="box-footer" align="right">    
    <a href="{{route('listaevaluacionesperiodo')}}" class="btn btn-primary">Regresar</a>
          </div>
         

     </div>
@endsection
