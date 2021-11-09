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


                <div class="col-sm-12">
                      <iframe src="../imagenes/recursosrpt/ayuda/help_estudiante.pdf" width="100%" height="780" style="border: none;"></iframe>
                    
                </div>

            <!--div  class="col-sm-4">
              <ul>
                
         <h2 class="text-blue">¿En qué puedo ayudarte?</h2>
                <h3 class="text-blue">Guía rápida</h3>
                <li>Estudiantes</li>
                  <ul>
                        <li>Expediente </li>                              
                        <li>Matrícula </li>  
                       <ul>
                       <li>Matrícula en linea (Pre-matrícula)</li>
                       <li>Comprobante Pre-matrícula</li>
                                                                                    
                        </ul>
                       <li>Historial de calificaciones</li>
                       <li>Horario de clases</li>                       
                  </ul>
                
              </ul>
            </div-->
          
        </div><!-- fin body--> 


     <div class="box-footer" align="right">                
       
         <a href="{{route('menu')}}" class="btn btn-default">Regresar</a>
        </div>

        {!! Form::close() !!}          <!-- /.box-body -->
 </div>
@endsection
