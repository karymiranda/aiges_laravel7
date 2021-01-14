@extends('admin.menuprincipal')
@section('tittle','Familiares/Mis Estudiantes')
@section('content')

<div class="row">
        <div class="col-md-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">MIS ESTUDIANTES</h3>
            </div>
            <!-- /.box-header -->          
            <div class="box-body">
            <div class="box-group" id="accordion"> 
             


@foreach($estudiante as $key=> $value)
              @foreach($value->estudiante_usuario as $usuario)
                            
 <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#{{$value->id}}" aria-expanded="true" class="">
                       {{$value->v_nombres}}
                      </a>
                    </h4>
                  </div>
                  <div id="{{$value->id}}" class="panel-collapse collapse in" aria-expanded="true" style="">
                    <div class="box-body">

<!--div class="row"-->
  <div class="col-sm-4">	              	
   <img src="{{ asset('/imagenes/Administracionacademica/Estudiantes/'.$usuario->foto) }}" class="user-image" alt="User Image" style="height: auto;">           	
   </div> 

<div class="col-sm-5">	
                <form class="form-horizontal">
                  <div class="form-group">
                  
 					<label for="inputEmail" class="col-sm-4 control-label">Apellidos</label>
                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$value->v_apellidos}}" readonly="true">
                    </div>

                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label">Nombres</label>

                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Nombres" value="{{$value->v_nombres}}" readonly="true">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label">NIE</label>
                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Numero de Identificacion Estudiantil" value="{{$value->v_nie}}" readonly="true">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label">Fecha de nacimiento</label>

                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$value->f_fnacimiento}}" readonly="true">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-4 control-label">Teléfono</i></label>

                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Teléfono" value="{{$value->v_telCasa}}" readonly="true">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputSkills" class="col-sm-4 control-label">Correo</i></label>

                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Correo electrónico" value="{{$value->v_correo}}"readonly="true">
                    </div>
                  </div>
                  <div class="form-group"><label for="inputSkills" class="col-sm-4 control-label">Dirección</i></label>
                    <div class="col-sm-6">
                      <textarea class="form-control" id="inputExperience"  readonly="true" placeholder="Dirección">{{$value->v_direccion}}"</textarea>
                    </div>
                  </div>               
                  
                </form>
           </div><!--finaliza el cuerpo del expediente-->

 <div class="col-md-3">
 	 <div class="box box-success"> 	 	
            <h4>  <a href="{{route('historialcalificaciones',$value->id)}}">Calificaciones</a><br>  </h4>                      
 	</div>
 	<div class="box box-warning">    
            <h4> <a href="{{route('asistencias_estudiantes',$value->id)}}">Asistencias</a><br>  </h4>          
  </div>
 	<div class="box box-danger"> 	 	
             <h4> <a href="{{route('horariosdeclases',$value->id)}}">Horarios de Clases</a> </h4>                    
 	</div>
 	<div class="box box-warning"> 	 	
            <h4>  <a href="{{route('matricula_online',$value->id)}}">Matrícula en línea</a> 
             <a href="{{route('comprobantematricula',$value->id)}}" class="pull-right" target="_blank" title="Imprimir comprobante">
          <i class="fa fa-print"></i>
            </a> </h4>   
                 
 	</div>
 	
    <div class="box box-info">    
            <h4>  <a href="{{route('asesordeseccion',$value->id)}}">Asesor de Sección</a><br>  </h4>          
  </div>
 <!--/div--> 

 </div>  

 </div>  
 </div>
 </div>
</div>
  @endforeach
          @endforeach


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
          </div>
         </div>
        <!-- /.col -->

       
 </div>
@endsection
