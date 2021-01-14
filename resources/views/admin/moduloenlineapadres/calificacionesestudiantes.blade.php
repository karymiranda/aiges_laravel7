@extends('admin.menuprincipal')
@section('tittle','Familiares/Mis Estudiantes/Historial de Calificaciones')
@section('content')

<div class="row"> 
 <div class="col-md-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">HISTORIAL DE CALIFICACIONES</h3>
               <a href="{{ route('estudiantes_familiares',Auth::user()->familiar->id) }}" class="btn btn-warning pull-right">Atrás</a>
            </div>
<input type="hidden" name="idestudiante" id="idestudiante" value="{{$estudiante->id}}">
            <!-- /.box-header -->          
        <div class="box-body">

                 <div class="col-md-2">
                 	 <div class="box box-warning">
                 	 	 <div class="box-title">ESTUDIANTE</div>
                           <div class="box-body box-profile">
                           	{{$estudiante->v_nombres}}
                           	
                           </div>
                   </div>  
                 	</div>


                 <div class="col-md-2">
                   <div class="box box-success">
                     <div class="box-title">AÑO ESCOLAR
                     </div>
                           <div class="box-body box-profile">
             <select class="form-control" id="btnboleta" placeholder="Seleccione">  

                             @foreach ($ciclosacademicos as $item)
                            
                               <option value="{{$item->anio}}">{{ $item->anio }}</option>             
                              @endforeach
            </select>
                           </div>
                           </div>  
                  </div>



 <div class="col-md-12">
  <iframe id="contenido" src="" width="100%" height="100%" id="iframeToResize" marginheight="0" frameborder="0" style="min-height: 600px"></iframe>
   <!--div class="container" id="ver_notas" style="min-width: 310px; height: 400px; margin: 0 auto">

    </div-->
</div>

</div> 
 </div> 
 </div> 

  </div>
 </div> 
 </div> 
 </div> 

@endsection
 @section('script')
 <script type="text/javascript">
$('#btnboleta').on('change', function(e){
var anio=$(this).val();
var id=$('#idestudiante').val();
var $iframe = $('#contenido');
    if ( $iframe.length ) {
$iframe.attr('src',"{{url("admin/reporteBoletaestudiante/id/anio")}}".replace("id",$('#idestudiante').val()).replace("anio",$(this).val()));  
 return false;
    } 
    return true;
});

  //var anio=$('#btnboleta').val();
  //  cargarpdf(anio);
 </script>
 @endsection   