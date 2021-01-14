@extends('admin.menuprincipal')
@section('tittle', 'Personal Docente')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><Strong>TOMAR ASISTENCIA   </Strong></h3>
  </div>
  <!-- /.box-header -->
  @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>

    @endif
  <!-- form start -->
  <div class="box-body ">
    {!! Form::open(['route'=>'tomarasistencia','class'=>'form-horizontal','method'=>'POST']) !!}
    <div class="form-group">
     <label class="col-sm-5 control-label">Fecha</label>               
      <div class="col-sm-2">
        {!! Form::text('fecha',$hoy,['class'=>'form-control pull-right nac','placeholder'=>'Fecha','required','readonly']) !!}
      </div>
      </div>

       <div class="form-group"> 
      <label class="col-sm-5 control-label">Grado/Sección</label>
      <div class="col-sm-2">          
        {!! Form::select('grado_seccion',$secciones, $seccion,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'grado_seccion'])!!} 
      </div>
      <div class="col-sm-2">        
      {!! Form::submit('Buscar',['class'=>'btn btn-primary ']) !!}
    </div>
     </div>
    {!! Form::close() !!}
    <div  class="box-body table-responsive  col-sm-6 col-sm-offset-3">                                           
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <!--th>NIE</th--> 
          <th>ESTUDIANTE</th>          
          <!--th>GENERO</th-->
          <th>ASISTENCIA</th>                 
          <th>ACCIONES</th>
        </thead>
        <tbody>
          <?php for($i=0;$i<$n;$i++){ ?>
          <tr>
             @if($estudiante[$i][1]!=null) 
            <!--td>{{ $estudiante[$i][1] }}</td--> 
            @else
          <!--td> <span class="label label-warning">sin asignar</span> </td-->
             @endif   
            <!--td>{{ $estudiante[$i][0] }}</td-->        
            
            <td>{{ $estudiante[$i][2] }}</td>
            <td>
              <?php if($estudiante[$i][3]=='Permiso'){ ?>
                <span class="label label-info">Permiso</span>
                </td>
                <td>
              <?php }else{ if($estudiante[$i][3]=='Asistencia'){ ?>
                <span class="label label-success">Asistencia</span>                    
                </td>
                <td>
              <?php }else{ if($estudiante[$i][3]=='Ausencia'){ ?>
                <span class="label label-danger">Ausencia</span>
                </td>
                <td>                                                   
              <?php }else{ ?>   
                <span class="label label-warning">Pendiente</span>
                </td>
                <td>
                  <a data-toggle="modal" data-target="#asis_{{$estudiante[$i][4]}}" title="Asistencia" class="btn btn-success"><i class="fa fa-check"></i></a>
                  <a data-toggle="modal" data-target="#aus_{{$estudiante[$i][4]}}" title="Ausencia" class="btn btn-danger"><i class="fa fa-close"></i></a> 
                  <a data-toggle="modal" data-target="#perm_{{$estudiante[$i][4]}}" title="Permiso" class="btn btn-info"><i class="fa  fa-circle-o"></i></a>                
              <?php }}} ?>    
              <div class="modal fade" id="asis_{{$estudiante[$i][4]}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header success">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ASISTENCIA</h4>
                    </div>
                    <div class="modal-body">
                      <p>Confirmar asistencia del estudiante: {{$estudiante[$i][0]}}</p>
                    </div>
                    <div class="modal-footer">                      
                      <form method="GET" action="{{route('agregarasistencia',$estudiante[$i][4])}}">
                        <input type="hidden" name="fecha" value="{{$hoy}}">
                        <input type="hidden" name="grado_seccion" value="{{$seccion}}">
                        <input type="submit" value="Asistencia" class="btn btn-sm btn-success">
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="aus_{{$estudiante[$i][4]}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR INASISTENCIA</h4>
                    </div>
                    <div class="modal-body">
                   <p>Confirmar inasistencia del estudiante :{{$estudiante[$i][0]}}</p>
                    </div>

<form method="GET" action="{{route('agregarausencia',$estudiante[$i][4])}}"> 
    <div class="form-group" style="width:100%">
                        {!! Form::label('lb', 'Motivo de inasistencia',['class'=>'col-sm-4 control-label']) !!} 
                    <div class="col-sm-8">                  
                        {!! Form::select('justificacion',['Enfermedad'=>'Enfermedad','Socioeconómico'=>'Socioeconómico','Sin justificar'=>'Sin Justificar'],null,['class'=>'form-control ','style'=>'width:100%','required'=>'true'])!!}
                    </div>
                  </div>                                          
 <div class="form-group"style="width:100%">                        
                        {!! Form::label('lb', 'Observaciones',['class'=>'col-sm-4 control-label']) !!} 
                        <div class="col-sm-8">                       
                        {!! Form::text('observacion',null,['class'=>'form-control ','placeholder'=>'Observaciones','style'=>'width:100%','required'=>'true'])!!} 
                      </div>
                      </div>

                    <div class="modal-footer">
                      
                        <input type="hidden" name="grado_seccion" value="{{$seccion}}">
                         <input type="hidden" name="fecha" value="{{$hoy}}">
                        <input type="submit" value="Ausente" class="btn btn-sm btn-danger">
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="perm_{{$estudiante[$i][4]}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header info">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR PERMISO</h4>
                    </div>
                     <form method="GET" action="{{route('agregarpermiso',$estudiante[$i][4])}}">
                    <div class="modal-body">
                      <p>Confirmar solicitud de permiso del estudiante: {{$estudiante[$i][0]}}</p>
                    </div>
                     <div class="form-group" style="width:100%">
                        {!! Form::label('lb', 'Motivo de inasistencia',['class'=>'col-sm-4 control-label']) !!} 
                    <div class="col-sm-8">                  
                        {!! Form::select('justificacion',['Enfermedad'=>'Enfermedad','Socioeconómico'=>'Socioeconómico','Sin justificar'=>'Sin Justificar'],null,['class'=>'form-control ','style'=>'width:100%','required'=>'true'])!!}
                    </div>
                  </div>                                          
 <div class="form-group"style="width:100%">                        
                        {!! Form::label('lb', 'Observaciones',['class'=>'col-sm-4 control-label']) !!} 
                        <div class="col-sm-8">                       
                        {!! Form::text('observacion',null,['class'=>'form-control ','placeholder'=>'Observaciones','style'=>'width:100%','required'=>'true'])!!} 
                      </div>
                      </div>

                    <div class="modal-footer">
                     
                         <input type="hidden" name="fecha" value="{{$hoy}}">
                        <input type="hidden" name="grado_seccion" value="{{$seccion}}">
                        <input type="submit" value="Permiso" class="btn btn-sm btn-info">
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>          
            </td>
          </tr>
          <?php } ?>  
        </tbody>
      </table>
    </div>
  </div>
  <div class="box-footer" align="right">                
    <a href="{{route('listaasistencias')}}" class="btn btn-primary"><< Regresar</a>
  </div>                                    
</div>  

@endsection
