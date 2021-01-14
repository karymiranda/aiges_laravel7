@extends('admin.menuprincipal')
@section('tittle','Docentes/Gestión Académica/Mis Secciones')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h2 class="box-title"><strong>MIS SECCIONES / NOMINA DE ESTUDIANTES</strong></h2>

  <!--LISTA LAS SECCIONES EN LAS CUALES EL USUARIO LOGEADO ESTA  ASIGNADO COMO DOCENTE ASESOR-->

             </div> 

             <div class="box-body" align="center">
              {!! Form::open(['route'=>'missecciones', 'method'=>'POST','class'=>'form-horizontal']) !!}
 
            

                @if($secciones->isEmpty()) 
               <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> No tiene secciones asignadas.</h4>               
                </div>
               @else
                 @foreach($secciones as $secciones)                      
                 <a href="{{ route('nominadeestudiantes',$secciones->id) }}" title="Ver nómina de estudiantes" class="btn btn-btn-block btn-primary btn-lg"><i class="fa fa-check"> {{$secciones->grado}}</i></a>                         
                @endforeach              
                @endif                            
              
           
              </div>
            
            <!-- /.box-body -->

           
 {!! Form::close() !!}
            </div>

@endsection
