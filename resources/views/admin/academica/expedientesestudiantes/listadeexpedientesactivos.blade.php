@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Registro Estudiantil')
@section('content')


<div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">ESTUDIANTES</label></h2>
              </div>
              <div class="col-sm-12 " align="right">     
            <a href="{{ route('registrardatospersonalesexpediente') }}" class="btn btn-primary">Registrar Estudiante</a>
                </div>
                
            </div>            
            <!-- /.box-header -->
             {!! Form::open(['class'=>'form-horizontal']) !!}
            <div class="box-body table-responsive">
               <table class="table table-bordered table-striped" id="tablaBusqueda">
              <thead >
                 <th>No.</th>
                  <th>EXPEDIENTE</th>
                  <th>NIE</th> 
                  <th>NOMBRES</th>
                  <th>APELLIDOS</th>                                   
                  <th>DIRECCION</th>  
                  <th>ACCIONES</th>               
              </thead>
              <tbody>                            
                 @foreach($expedientes as $key => $expedientes)
                <tr> 
                <td>{{$key + 1}}</td>            
                 <td>{{$expedientes->v_expediente}}</td> 
                 @if($expedientes->v_nie==null) 
                 <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                  @if($expedientes->v_nie!=null) 
                 <td>{{$expedientes->v_nie}}</td> 
                   @endif               
                  <td>{{$expedientes->v_nombres}}</td>
                  <td>{{$expedientes->v_apellidos}}</td> 
                  <td>{{$expedientes->v_direccion}}</td>                   
                  <td>                  
    <a href="{{ route('verexpedienteestudiantes',$expedientes->id) }}"  title="Ver" class="btn btn-primary"><i class="fa fa-eye"></i></a>
    <a href="{{ route('editardatospersonalesestudiante',$expedientes->id) }}" title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>   
    <a class="btn btn-danger" data-toggle="modal" title="Deshabilitar" data-target="#deshabilitar_{{$expedientes->id}}"><i class="fa fa-close" ></i></a>
     <!-- /modal deshabilitar -->
<div class="modal fade" id="deshabilitar_{{$expedientes->id}}">
          <div class="modal-dialog">
            <div class="modal-content">             
   <form class="form-horizontal" method="POST" action="{{route('eliminarexpedienteestudiante')}}" >
    {!! csrf_field() !!}    
   <input type="hidden" name="id" value={{$expedientes->id}}>
                <div class="modal-header danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">DEHABILITAR ESTUDIANTE</h4>
                </div>

      <div class="modal-body">
      <p>Para deshabilitar el expediente del estudiante   {{$expedientes->v_nombres}}  {{$expedientes->v_apellidos}},favor completar la siguiente información:</p>                            
   <div class="form-group" style="width:100%">                                     
   {!! Form::label('lblfec', 'Fecha',['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-8">
                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text"  name="deshabilitadofecha" id="fecha"  class="form-control pull-right nac" data-mask required="true" class="form-control" required="true">
                                </div>
                                </div>             
    </div>  
    <div class="form-group" style="width:100%">
                        {!! Form::label('lb', 'Motivo',['class'=>'col-sm-4 control-label']) !!} 
                    <div class="col-sm-8">                  
                        {!! Form::select('deshabilitadomotivo',['T'=>'Traslado','D'=>'Deserción','O'=>'Otros'],null,['class'=>'form-control ','style'=>'width:100%','required'=>'true'])!!}
                    </div>
                  </div>                                          
 <div class="form-group"style="width:100%">                        
                        {!! Form::label('lb', 'Observaciones',['class'=>'col-sm-4 control-label']) !!} 
                        <div class="col-sm-8">                       
                        {!! Form::text('deshabilitadoobservaciones',null,['class'=>'form-control ','placeholder'=>'Observaciones','style'=>'width:100%','required'=>'true'])!!} 
                      </div>
                      </div>  
    </div>
      <div class="box-footer" align="right">

<!--button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal" id="btnsubmit">Cancelar</button-->

      <input type="submit" value="Deshabilitar" class="btn btn-sm btn-danger delete-btn">
       <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
      </div>
       </form>  
        </div>                
     </div>
     </div> 
<!-- / finmodal-dialog --> 
<div class="btn-group">
                  <button type="button" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i></button>
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('registrarfamiliares',$expedientes->id)}}" target="blank" title="Relaciona estudiantes que son parientes de éste familiar"> Familiar-Estudiante</a></li>
                     <li><a href="{{ route('matricula')}}" >Matricula</a></li>                     
                     <li><a href="{{ route('listnotessingleadmin',[$expedientes->id,'admin'])}}" >Ingresar calificaciones</a>
                      <li><a href="{{ route('listcompsingleadmin',[$expedientes->id,'admin'])}}" >Ingresar competencias ciudadanas</a></li>
                       <li class="divider"></li>
                    <li><a href="{{ route('expedienteestudiante_pdf',$expedientes->id) }}" target="blank">Expediente pdf</a></li>
                  </ul>
  </div>


       </td> 
         </tr>
       @endforeach
              </tbody>
            </table>
            </div>
          </div>
           {!! Form::close() !!}
           
@endsection
