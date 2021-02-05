@extends('admin.menuprincipal')
@section('tittle','Estudiantes/Historial de Calificaciones')
@section('content')

<div class="row"> 
 <div class="col-md-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">HISTORIAL DE CALIFICACIONES</h3>          
            </div>
{!! Form::open(['route'=>'calificacionesonline', 'method'=>'POST','class'=>'form-horizontal']) !!}
<input type="hidden" name="idestudiante" id="idestudiante" value="{{$estudiante->id}}">
            <!-- /.box-header -->          
        <div class="box-body">

                 <!--div class="col-md-2">
                 	 <div class="box box-warning">
                 	 	 <div class="box-title">ESTUDIANTE</div>
                           <div class="box-body box-profile">
                           	{{$estudiante->v_nombres}}
                           	
                           </div>
                   </div>  
                 	</div-->
 <div class="col-md-3">
 </div>
                 <div class="col-md-6">
                   <div class="box box-success">
                     <div class="box-title">AÑO ESCOLAR
                     </div>
                           <div class="box-body box-profile">
             <select class="form-control" id="anio" name="anio" placeholder="Seleccione" required="true">  
        <option value="">Seleccione</option>
         @foreach ($ciclosacademicos as $item)
                           
          <option value="{{$item->id}}">{{ $item->anio }}</option>             
         @endforeach
          </select>
                           </div>
                           </div>  
                  </div>

        
<div class="col-md-5">
</div>
<div class="col-md-4">
  <button type="submit" class="btn btn-primary">Ver Calificaciones</button>
</div>



 <!--div class="col-md-12">
  <iframe id="contenido" src="" width="100%" height="100%" id="iframeToResize" marginheight="0" frameborder="0" style="min-height: 600px">
  </iframe>
</div-->

</div> 
 </div> 
 </div> 
  </div>
 {!! Form::close() !!}
 </div> 
 </div> 
 </div> 

@endsection
  