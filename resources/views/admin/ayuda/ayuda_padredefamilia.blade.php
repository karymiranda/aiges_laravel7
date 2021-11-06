@extends('admin.menuprincipal')
@section('tittle','Ayuda')
@section('content')
<div class="box box-primary box-solid">
	<div class="box-header with-border">
              <h3 class="box-title"><Strong>AYUDA</Strong></h3>
            </div>
 {!! Form::open(['class'=>'form-horizontal']) !!}
            <!-- /.box-header -->
            <div class="box-body">


                <div class="col-sm-8">
                      <iframe src="../imagenes/recursosrpt/ayuda/help_padredefamilia.pdf" width="800" height="780" style="border: none;"></iframe>
                    
                </div>

            <div  class="col-sm-4">
              <ul>
                
         <h2 class="text-blue">¿En qué puedo ayudarle?</h2>
                <h3 class="text-blue">Guía rápida</h3>
                <li>Padre de familia</li>
                  <ul>
                        <li>Expediente personal</li>
                         <li>Mis estudiantes</li>
                              <ul>
                              <li>Calificaciones</li>
                              <li>Asistencia</li> 
                              <li>Horario de clases</li>
                              <li>Matrícula en línea</li> 
                              <li>Asesor de sección</li>                                 
                              </ul>
                       
                  </ul>
                
              </ul>
            </div>
          
        </div><!-- fin body--> 


     <div class="box-footer" align="right">                
       
         <a href="{{route('menu')}}" class="btn btn-default">Regresar</a>
        </div>

        {!! Form::close() !!}          <!-- /.box-body -->
 </div>
@endsection
