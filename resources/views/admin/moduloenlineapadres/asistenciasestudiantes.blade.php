@extends('admin.menuprincipal')
@section('tittle','Familiares/Mis Estudiantes/Asistencias')
@section('content')

<div class="row"> 
 <div class="col-md-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">HISTORIAL DE ASISTENCIAS</h3>
               <a href="{{ route('estudiantes_familiares',Auth::user()->familiar->id) }}" class="btn btn-warning pull-right">Atrás</a>
            </div>
            <input type="hidden" name="idestudiante" id="idestudiante" value="{{$estudiante->id}}">
         

            <!-- /.box-header -->          
        <div class="box-body" align="center">

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
                     <div class="box-title">MES
                     </div>
                           <div class="box-body box-profile">
                          
                  <select class="form-control" id="btnboleta" >
                  
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>
                  
                  </select>
                         
                           </div>
                           </div>  
                  </div>



 <div class="col-md-12">
  <iframe id="contenido" src="" width="100%" height="100%" id="iframeToResize" marginheight="0" frameborder="0" style="min-height: 600px"></iframe>
 
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
var mes=$(this).val();
var id=$('#idestudiante').val();

var $iframe = $('#contenido');
    if ( $iframe.length ) {
//$iframe.attr('src',"{{route('reporteAsistenciaonline',[70,10])}}");
 $iframe.attr('src',"{{url("admin/reporteAsistenciaonline/id/mes")}}".replace("mes",$(this).val()).replace("id",$('#idestudiante').val()));       
        return false;
    }
    return true;
});

  //var anio=$('#btnboleta').val();
  //  cargarpdf(anio);
 </script>
 @endsection 