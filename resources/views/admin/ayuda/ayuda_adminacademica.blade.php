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
                      <iframe src="../imagenes/recursosrpt/ayuda/help_adminacademica.pdf" width="100%" height="780" style="border: none;"></iframe>
                    
                </div>

            <!--div  class="col-sm-4">
              <ul>
                
                <h2 class="text-blue">¿En qué puedo ayudarle?</h2>
                <h3 class="text-blue">Guía rápida</h3>
                <li>Administración Académica</li>
                  <ul>
                        <li>Expediente estudiantil</li>
                              <ul>
                                    <li>Información de estudiantes activos</li>
                                    <li>Crear expediente estudiantil</li>
                                         <ul>         
                                         <li>Ingreso de datos generales</li>
                                         <li>Ingreso de datos médicos</li>
                                         <li>Creación de cuenta de usuario</li>
                                         <li>Creación de círculo familiar</li>
                                          </ul>
                                     <li>Editar expediente estudiantil</li>
                                         <ul>         
                                         <li>Editar datos generales</li>
                                         <li>Editar datos médicos</li>
                                         <li>Editar círculo familiar</li>
                                         </ul>
                                     <li>Deshabilitar expediente</li>                                 
                              </ul>
                       
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
