@extends('admin.menuprincipal')
@section('tittle','Estudiantes/Expediente')
@section('content')
<div class="box box-primary">
 <div class="box-header">
    <div class="col-sm-12" align="center">
        <h4> <label class="text-blue">EXPEDIENTE ESTUDIANTIL</label></h4>
    </div>
  </div>


          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active "><a href="#datospersonales" data-toggle="tab" aria-expanded="true">DATOS PERSONALES</a></li>
              <li class=""><a href="#circulofamiliar" data-toggle="tab" aria-expanded="false">CIRCULO FAMILIAR</a></li>
            </ul>


     <div class="tab-content">                          
     <div class="tab-pane active" id="datospersonales">
     	<div class="box-body">
          <div class="col-sm-4" align="center">	              	
           <img src="{{ asset('/imagenes/Administracionacademica/Estudiantes/'.Auth::user()->foto) }}" class="user-image" alt="User Image" height="400px"></div>
          <div class="col-sm-8">	
                <form class="form-horizontal">
                  <div class="form-group">
                    <!--div class="col-sm-10">
                        <h1 class="profile-username text-center label-warning">{{Auth::user()->estudiante->v_apellidos}} ,{{Auth::user()->estudiante->v_nombres}} </h1>	
                    </div-->
 					<label for="inputEmail" class="col-sm-4 control-label">Apellidos</label>
                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{Auth::user()->estudiante->v_apellidos}}" readonly="true">
                    </div>
 
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label">Nombres</label>

                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Nombres" value="{{Auth::user()->estudiante->v_nombres}}" readonly="true">
                    </div>
                  </div>
 
                   <div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label">NIE</label>
                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Numero de Identificacion Estudiantil" value="{{Auth::user()->estudiante->v_nie}}" readonly="true">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label">Fecha de nacimiento</label>

                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{Auth::user()->estudiante->f_fnacimiento}}" readonly="true">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-4 control-label">Teléfono</i></label>

                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Teléfono" value="{{Auth::user()->estudiante->v_telCasa}}" readonly="true">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputSkills" class="col-sm-4 control-label">Correo</i></label>

                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Correo electrónico" value="{{Auth::user()->estudiante->v_correo}}"readonly="true">
                    </div>
                  </div>
                  <div class="form-group"><label for="inputSkills" class="col-sm-4 control-label">Dirección</i></label>
                    <div class="col-sm-6">
                      <textarea class="form-control" id="inputExperience"  readonly="true" placeholder="Dirección">{{Auth::user()->estudiante->v_direccion}}</textarea>
                    </div>
                  </div>
                  <!--div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div-->
                </form>
           </div>	
       </div> 
        </div>



<div class="tab-pane" id="circulofamiliar">
<div class="box-body">				                     

<div class="box-body table-responsive">
                      <table class="table table-bordered table-striped" id="tablaBusqueda">
                      <thead style="background-color: #3c8dbc;color:white;">
                           
                              <th>NOMBRE COMPLETO</th>
                              <th>PARENTESCO</th>
                              <th>ENCARGADO</th>                              
                              <th>TELEFONO CASA</th>                                   
                              <th>CELULAR</th>                
                             </thead> 
                       <tbody>
                @foreach(Auth::user()->estudiante->estudiante_familiares as $datos)
                <tr>                         
                  <td>{{$datos->nombres}} {{$datos->apellidos}}</td>
                  <td>{{$datos->pivot->parentesco}}</td>
                  <td>{{$datos->pivot->encargado}}</td> 
                   @if($datos->telefonocasa==null) 
                  <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                  @if($datos->telefonocasa!=null) 
                 <td>{{$datos->telefonocasa}}</td>
                   @endif  
                   @if($datos->celular==null) 
                  <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                  @if($datos->celular!=null) 
                 <td>{{$datos->celular}}</td> 
                   @endif                                                      
                </tr>

                @endforeach
               
              </tbody>
            </table>
            </div>         
 
</div>             
</div>


 </div>             <!-- /.tab-content -->
            

    </div><!-- /TAB CUSTOM-->    
  </div>

@endsection
