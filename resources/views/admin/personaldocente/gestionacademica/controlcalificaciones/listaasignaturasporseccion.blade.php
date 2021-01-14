@extends('admin.menuprincipal')
@section('tittle','Docentes/Gestión Académica/Calificaciones/Secciones/Asignaturas')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h2 class="box-title"><strong>REGISTRO DE CALIFICACIONES / MIS ASIGNATURAS / {{$b->grado}}</strong></h2>
             </div> 

             <div class="box-body" align="center">
              {!! Form::open(['route'=>'missecciones', 'method'=>'POST','class'=>'form-horizontal']) !!}
 
              <div class="box-body table-responsive">
             <table class="table table-bordered table-striped"  data-form="deleteForm" style="width: 20%">               
                <tbody align="center">

                @if($asignaturas->isEmpty()) 
                <tr> 
                  <td>NO TIENE ASIGNATURAS ASIGNADAS</td>
               </tr>
               @else
                 @foreach($asignaturas as $asignaturas)                      
                <tr> 
                <td> <a href="{{ route('registrarcalificaciones',[$asignaturas->id,$b->id]) }}" title="Ingresar calificaciones" class="btn btn-block btn-primary btn-lg"><i class="fa fa-file-text-o"> {{$asignaturas->asignatura}}</i></a></td>
                 </tr>                          
                @endforeach              
                @endif                            
              </tbody>
            </table>
            </div>
              </div>
            
            <!-- /.box-body -->

            <div class="box-footer" align="right" >
            <a href="{{route('listaseccionespordocente')}}" class="btn btn-default">Regresar</a>            
           </div>
 {!! Form::close() !!}
            </div>

@endsection
