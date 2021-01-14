@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Consultas')
@section('content') 

<div class="box col-sm-6 col-sm-offset-3" style="overflow: auto;width:50%;">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">BUSQUEDA AVANZADA</label></h2>
              </div>
            </div> 

             <div class="box-body">
              {!! Form::open(['method'=>'GET','id'=>'formulariorpt','class'=>'form-horizontal','target'=>'blank']) !!}

            
               <div class="form-group">               
                {!! Form::label('', 'Filtro ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
              <select class="form-control" id="filtros">
                <?php  
                echo '<option value="0">Seleccione</option>';?>
                <option value="1">Estudiantes</option>
                <option value="2">Padres de familia</option>
                <option value="3">Matrículas</option>
                <option value="4">Calificaciones</option>
                <option value="5" >Estadísticas</option>      
              </select>

                </div>
            </div>

<div class="box-body" id="busqueda_estudiantes"  style="display:none;">
    <form id="Estudiantes">
          
      <div class="form-group">                                         
         <div class="col-sm-12">
          <div class="callout callout-info">Seleccione los criterios de búsqueda
          </div>  
         </div>                                                
      </div>

  
          <div class="form-group">
           {!! Form::label('', 'Estado ',['class'=>'col-sm-4 control-label']) !!}                       
             <div class="col-sm-8">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('estudiantesactivos','T',true, ['class'=>'','id'=>'optionsRadios1'])!!}
          {!! Form::label('', 'Activos',['class'=>'control-label']) !!}
          {!! Form::radio('estudiantesactivos','A',false, ['class'=>'','id'=>'optionsRadios2'])!!}          
          {!! Form::label('', 'Inactivos',['class'=>'control-label']) !!}
          {!! Form::radio('estudiantesactivos','I',false, ['class'=>'','id'=>'optionsRadios2'])!!}
              </div>                                             
          </div>

           <div class="form-group"> 
            {!! Form::label('', 'Genero ',['class'=>'col-sm-4 control-label']) !!}                       
             <div class="col-sm-8">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('estudiantesGenero','T',true, ['class'=>'','id'=>'estudiantesGeneroT'])!!}
          {!! Form::label('', 'Masculino',['class'=>'control-label']) !!}
          {!! Form::radio('estudiantesGenero','M',false, ['class'=>'','id'=>'estudiantesGeneroM'])!!}          
          {!! Form::label('', 'Femenino',['class'=>'control-label']) !!}
          {!! Form::radio('estudiantesGenero','F' ,false, ['class'=>'','id'=>'estudiantesGeneroF'])!!}
              </div>                                              
          </div>

            <!--div class="form-group"> 
             {!! Form::label('', 'Año ',['class'=>'col-sm-4 control-label']) !!}                      
             <div class="col-sm-8">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('estudianteanio','Todos',true, ['class'=>'','id'=>'criterioanioT'])!!}
          {!! Form::label('', 'Por año',['class'=>'control-label']) !!}
          {!! Form::radio('estudianteanio','Por año',false, ['class'=>'','id'=>'criterioanioG'])!!} 
              </div>                                             
          </div-->

            <!--div class="form-group" id=
            "divestudianteanio" style="display:none;">
             {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}               
               <div class="col-sm-4">
               <input type="text" class="form-control" id="anioestudiante" placeholder="Ingrese año">
                </div>
            </div-->

            <!--div class="form-group" id="divestudianteanio" >
             {!! Form::label('', 'Año',['class'=>'col-sm-4 control-label']) !!}               
               <div class="col-sm-5">
               <input type="text" class="form-control" id="anioestudiante" placeholder="Ingrese año">
                </div>
            </div>

         
            <div class="form-group">
             {!! Form::label('', 'Grado- Sección',['class'=>'col-sm-4 control-label']) !!}          
              <div class="col-sm-5">
              <select class="form-control" name="filtrogradosestudiantes" id="filtrogradosestudiantes">
                <option value="0">Todos</option>
                <?php
                foreach ($listasecciones as $key => $value)
                 { ?>                 
           <option value="{{$value->id}}">{{$value->descripcion}}</option>
                  <?php } ?>
              </select>
           </div>  
         </div-->

 

        <div class="form-group"> 
         {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}               
        <div class="col-sm-8">          
        {!! Form::label('sup', 'Buscar por rango de edad',['class'=>'control-label']) !!}  {!! Form::checkbox('estudianteedad', 'Buscar por edad', false,['id'=>'super'])!!}        
      </div>
    </div>

              <div class="form-group" id="divedad" style="display: none;">    {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
               <input type="text" class="form-control" id="inicioedadestudiante" placeholder="Desde">
               <input type="text" class="form-control" id="finedadestudiante" placeholder="Hasta">
                </div>                      
           </div>
   </form>
</div>






<div class="box-body" id="busqueda_padres"  style="display:none;">
    <form id="Padres">
       <div class="form-group">                                         
         <div class="col-sm-12">
          <div class="callout callout-info">Seleccione los criterios de búsqueda
          </div>  
           </div>                                                
      </div>


           <div class="form-group"> 
        {!! Form::label('', 'Estado',['class'=>'col-sm-4 control-label']) !!}                         
             <div class="col-sm-8">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('padresactivos','T',true, ['class'=>'','id'=>'Radiospadresa1'])!!}
          {!! Form::label('', 'Activos',['class'=>'control-label']) !!}
          {!! Form::radio('padresactivos','A',false, ['class'=>'','id'=>'Radiospadres2'])!!}          
          {!! Form::label('', 'Inactivos',['class'=>'control-label']) !!}
          {!! Form::radio('padresactivos','I',false, ['class'=>'','id'=>'Radiospadres3'])!!}
              </div>                                             
          </div>

          <div class="form-group">
          {!! Form::label('', 'Genero',['class'=>'col-sm-4 control-label']) !!}                        
             <div class="col-sm-6">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('padresGenero','T',true, ['class'=>'','id'=>'padresGeneroT'])!!}
          {!! Form::label('', 'Masculino',['class'=>'control-label']) !!}
          {!! Form::radio('padresGenero','M',false, ['class'=>'','id'=>'padresGeneroM'])!!}          
          {!! Form::label('', 'Femenino',['class'=>'control-label']) !!}
          {!! Form::radio('padresGenero','F' ,false, ['class'=>'','id'=>'padresGeneroF'])!!}
              </div>                                              
          </div>

   <div class="form-group">
   {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}                
        <div class="col-sm-6">          
        {!! Form::label('apellidos', 'Buscar por apellidos',['class'=>'control-label']) !!}  {!! Form::checkbox('padresapellidos', 'Buscar por apellidos', false,['id'=>'apellidos'])!!}        
      </div>
    </div>
    
    <div class="form-group" id="divapellidos" style="display: none;">   
              {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-6">
               <input type="text" class="form-control" id="txtapellidos" placeholder="Apellidos">
                </div>                      
    </div>

 <div class="form-group">
 {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}                
        <div class="col-sm-6">          
        {!! Form::label('parentesco', 'Buscar por parentesco',['class'=>'control-label']) !!}  {!! Form::checkbox('padresparentesco', 'Buscar por parentesco', false,['id'=>'parentesco'])!!}        
      </div>
  </div>

  <div class="form-group" id="divparentesco" style="display: none;">
   {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-6">
             <select class="form-control" id="filtroparentesco">
             <option value="T">Todos</option>
             <option value="Padre">Padre</option>
             <option value="Madre">Madre</option>
             <option value="Abuelo">Abuelo</option>
             <option value="Abuela">Abuela</option>
             <option value="Tio">Tio</option>
             <option value="Tia">Tia</option>
             <option value="Hermano">Hermano</option>
             <option value="Hermana">Hermana</option>
             <option value="Otro">Otro</option>
             </select>
            </div>
</div>




 <div class="form-group"> 
 {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}               
        <div class="col-sm-6">          
        {!! Form::label('profesion', 'Buscar por profesion',['class'=>'control-label']) !!}  {!! Form::checkbox('padresprofesion', 'Buscar por profesión', false,['id'=>'profesion'])!!}        
      </div>
  </div>

 <div class="form-group" id="divprofesion" style="display: none;">   
               {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-6">
               <input type="text" class="form-control" id="txtprofesion" placeholder="Profesión">
                </div>                      
    </div>
   </form>
</div>



<div class="box-body" id="busqueda_Matricula"  style="display:none;"> 
    <form id="Matriculas">
       <div class="form-group">                                         
         <div class="col-sm-12">
          <div class="callout callout-info">Seleccione los criterios de búsqueda
          </div>  
           </div>                                                
      </div>

      <div class="form-group" class="form-control">                                         
           {!! Form::label('exp', 'Año ',['class'=>'col-sm-4 control-label']) !!}
           <div class="col-sm-5">
           {!! Form::text('matriculaanio','',['class'=>'form-control pull-right','placeholder'=>'Año de matricula','id'=>'matriculaanio']) !!}
           </div>                                                
      </div>

<div class="form-group">
  {!! Form::label('exp', 'Grado - Sección ',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-5">
             <select class="form-control" id="filtromatriculagrados">
              <option value="0">Todos</option>
             <?php
                foreach ($grados as $key => $value)
                 { ?>                 
               <option value="{{$value->id}}">{{$value->grado}}</option>
             <?php } ?>
             </select>
            </div>
</div>


<div class="form-group">
  {!! Form::label('exp', 'Género ',['class'=>'col-sm-4 control-label']) !!}                        
             <div class="col-sm-6">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('matriculaGenero','T',true, ['class'=>'','id'=>'matriculaGeneroT'])!!}
          {!! Form::label('', 'Masculino',['class'=>'control-label']) !!}
          {!! Form::radio('matriculaGenero','M',false, ['class'=>'','id'=>'matriculaGeneroM'])!!}          
          {!! Form::label('', 'Femenino',['class'=>'control-label']) !!}
          {!! Form::radio('matriculaGenero','F' ,false, ['class'=>'','id'=>'matriculaGeneroF'])!!}
              </div>                                              
</div>

<div class="form-group">
 {!! Form::label('exp', 'Ingreso ',['class'=>'col-sm-4 control-label']) !!}                        
             <div class="col-sm-6">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('matriculaingreso','T',true, ['class'=>'','id'=>'matriculaingresoT'])!!}

          {!! Form::label('', 'Nuevo ingreso',['class'=>'control-label']) !!}
          {!! Form::radio('matriculaingreso','N',false, ['class'=>'','id'=>'matriculaingresoN'])!!} 

          {!! Form::label('', 'Antiguo ingreso',['class'=>'control-label']) !!}
          {!! Form::radio('matriculaingreso','A' ,false, ['class'=>'','id'=>'matriculaingresoA'])!!}
              </div>                                              
</div>

<div class="form-group">
 {!! Form::label('exp', 'Modalidad de matricula ',['class'=>'col-sm-4 control-label']) !!}                        
             <div class="col-sm-6">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('modalidadingreso','T',true, ['class'=>'','id'=>'modalidadingresoT'])!!}

          {!! Form::label('', 'Presencial',['class'=>'control-label']) !!}
          {!! Form::radio('modalidadingreso','P',false, ['class'=>'','id'=>'modalidadingresoP'])!!} 

          {!! Form::label('', 'Online',['class'=>'control-label']) !!}
          {!! Form::radio('modalidadingreso','O' ,false, ['class'=>'','id'=>'modalidadingresoO'])!!}
              </div>                                              
</div>






   </form>
</div>

<div class="box-body" id="busqueda_Asistencias"  style="display:none;">
    <form id="Asistencias">
 <div class="form-group">                                         
         <div class="col-sm-12">
          <div class="callout callout-info">Seleccione los criterios de búsqueda
          </div>  
         </div>                                                
  </div>

 <div class="form-group">
    {!! Form::label('turno', 'Criterio',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-5">
    <select class="form-control" id="criteriocalificaciones">
              <option value="max">Calificación máxima</option>
               <option value="min">Calificación minima</option>
               <option value="prom">Calificación promedio</option>
    </select>
    </div>
</div>

 <div class="form-group" class="form-control">                                         
           {!! Form::label('exp', 'Año ',['class'=>'col-sm-4 control-label']) !!}
           <div class="col-sm-5">
           {!! Form::text('calificacionesanio','',['class'=>'form-control pull-right','placeholder'=>'Año de matricula','id'=>'calificacionesanio']) !!}
           </div>                                                
      </div>

<div class="form-group">
  {!! Form::label('exp', 'Grado - Sección ',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-5">
             <select class="form-control" id="gradoscalificaciones">
              <option value="0">Todos</option>
             <?php
                foreach ($grados as $key => $value)
                 { ?>                 
               <option value="{{$value->id}}">{{$value->grado}}</option>
             <?php } ?>
             </select>
            </div>
</div>

<div class="form-group">
    {!! Form::label('', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-5">
    <select class="form-control" id="asignaturascalificaciones">
             
              <?php
                foreach ($asignaturas as $key => $value)
                 { ?>                 
               <option value="{{$value->name_short}}">{{$value->asignatura}}</option>
             <?php } ?>
    </select>
    </div>
</div>

 
<div class="form-group">
  {!! Form::label('exp', 'Género ',['class'=>'col-sm-4 control-label']) !!}                        
             <div class="col-sm-6">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('calificacionesGenero','T',true, ['class'=>'','id'=>'calificacionesGeneroT'])!!}
          {!! Form::label('', 'Masculino',['class'=>'control-label']) !!}
          {!! Form::radio('calificacionesGenero','M',false, ['class'=>'','id'=>'calificacionesGeneroM'])!!}          
          {!! Form::label('', 'Femenino',['class'=>'control-label']) !!}
          {!! Form::radio('calificacionesGenero','F' ,false, ['class'=>'','id'=>'calificacionesGeneroF'])!!}
              </div>                                              
</div>

   </form>
</div>


<div class="box-body" id="busqueda_Calificaciones"  style="display:none;">
    <form id="Calificaciones">

<div class="form-group">                                         
         <div class="col-sm-12">
          <div class="callout callout-info">Seleccione los criterios de búsqueda
          </div>  
           </div>                                                
  </div>

<div class="form-group">
    {!! Form::label('', 'Criterio',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-5">
    <select class="form-control" id="estadisticaestatus">
               <option value="1">Promovidos</option>
               <option value="2">Egresados</option>
               <option value="3">Repitentes</option>
               <option value="4">Retenidos</option>
    </select>
    </div>
</div>

 <div class="form-group" class="form-control">                                         
           {!! Form::label('exp', 'Año ',['class'=>'col-sm-4 control-label']) !!}
           <div class="col-sm-5">
            <input type="number" name="estadisticasanio" id="estadisticasanio" class="form-control pull-right" placeholder="Año de matricula">

          
           </div>                                                
      </div>

<div class="form-group">
  {!! Form::label('exp', 'Grado - Sección',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-5">
             <select class="form-control" id="gradosestadisticas">
              <option value="0">Todos</option>
             <?php
                foreach ($grados as $key => $value)
                 { ?>                 
               <option value="{{$value->id}}">{{$value->grado}}</option>
             <?php } ?>
             </select>
            </div>
</div>



  <!--div class="form-group">
    {!! Form::label('parentesco', 'Sección',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-8">
    <select class="form-control" id="filtroseccionestadisticas">
              <option value="0">Todos</option>
               <option value="1">A</option>
               <option value="2">B</option>
               <option value="3">C</option>
    </select>
    </div>
</div-->


  <!--div class="form-group">
    {!! Form::label('turno', 'Turno',['class'=>'col-sm-4 control-label']) !!}
   <div class="col-sm-8">
    <select class="form-control" id="filtroturnoestadisticas">
              <option value="0">Todos</option>
               <option value="1">Mañana</option>
               <option value="2">Tarde</option>
    </select>
    </div>
</div-->

<div class="form-group">
  {!! Form::label('exp', 'Género ',['class'=>'col-sm-4 control-label']) !!}                        
             <div class="col-sm-6">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}
          {!! Form::radio('estadisticasGenero','T',true, ['class'=>'','id'=>'estadisticasGeneroT'])!!}
          {!! Form::label('', 'Masculino',['class'=>'control-label']) !!}
          {!! Form::radio('estadisticasGenero','M',false, ['class'=>'','id'=>'estadisticasGeneroM'])!!}          
          {!! Form::label('', 'Femenino',['class'=>'control-label']) !!}
          {!! Form::radio('estadisticasGenero','F' ,false, ['class'=>'','id'=>'estadisticasGeneroF'])!!}
              </div>                                              
</div>
   </form>
</div>


 
  <div class="box-footer" align="right">
  <input type="button" class="btn btn-primary" id="btnbuscar" value="Iniciar busqueda" /> 
  <a href="{{route('menu')}}" class="btn btn-default">Regresar</a>
      </div>         


</div><!--fin box body-->
 </div><!--fin box-->
 {!! Form::close() !!}

<div class="box col-sm-12">
 <div class="box-body">
 {!! Form::open(['method'=>'GET','id'=>'frmtabla','class'=>'form-horizontal','target'=>'blank']) !!}
 <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="tablaBusqueda">
              <thead>
             <tr>
                 <th>No.</th> 
                  <th>NIE</th>
                  <th>ESTUDIANTE</th>
                   <th>GENERO</th>  
                   <th>ESTATUS</th>   
                </tr>
              </thead>
            <tbody>
                 
            </tbody>
       </table>
    </div><!--fin div table-->
     {!! Form::close() !!}
    </div><!--fin box body-->
    </div>
           
@endsection
@section('script')

<script type="text/javascript">

/*
$('estudiantegrado').on('change',function(e){
  alert('click');
if (divgrados.style.display==="none"){
  divgrados.style.display="block";
}
else
{
  divgrados.style.display="none";
}
});
*/

$(function() {
    $('input:radio[name="estudiantegrado"]').change(function()
     {

if (divgrados.style.display==="none"){
  divgrados.style.display="block";
}
else
{
  divgrados.style.display="none";
}           
    });

$('input:radio[name="estudianteanio"]').change(function()
{
if (divestudianteanio.style.display==="none"){
  divestudianteanio.style.display="block";
}
else
{
  divestudianteanio.style.display="none";
}           
    });

    $('input:checkbox[name="estudianteedad"]').click(function()
     {

if (divedad.style.display==="none"){
  divedad.style.display="block";

}
else
{
  divedad.style.display="none";
  document.getElementById("inicioedadestudiante").value = "";
  document.getElementById("finedadestudiante").value = "";
}           
    });

$('input:checkbox[name="padresapellidos"]').click(function()
     {

if (divapellidos.style.display==="none"){
  divapellidos.style.display="block";
}
else
{
  divapellidos.style.display="none";
   document.getElementById("txtapellidos").value = "";
}           
    });


$('input:checkbox[name="padresparentesco"]').click(function()
     {
if (divparentesco.style.display==="none"){
  divparentesco.style.display="block";
}
else
{
  divparentesco.style.display="none"; 
}           
    });


$('input:checkbox[name="padresprofesion"]').click(function()
     {
if (divprofesion.style.display==="none"){
  divprofesion.style.display="block";
}
else
{
  divprofesion.style.display="none";
  document.getElementById("txtprofesion").value = "";
}           
    });

});


$('#filtros').on('change',function(e){
  var opcion=$(this).val();
  var divestudiantes = document.getElementById("busqueda_estudiantes");
  var divpadres= document.getElementById("busqueda_padres");
  var divmatriculas=document.getElementById("busqueda_Matricula");
  var divcalificaciones=document.getElementById("busqueda_Calificaciones");
  var divasistencias=document.getElementById("busqueda_Asistencias");

  switch (opcion)
  {     
    case '1'://filtro estudiantes 
     if (divestudiantes.style.display === "none") {
        divestudiantes.style.display = "block";//mostrar
        divpadres.style.display="none";
        divmatriculas.style.display="none";
        divcalificaciones.style.display="none";
    } else {
        divestudiantes.style.display = "none";//ocultar
    }

    break;

    case '2'://filtro padres
    if (divpadres.style.display === "none") {
        divpadres.style.display = "block";//mostrar
        divestudiantes.style.display="none";
        divmatriculas.style.display="none";
        divcalificaciones.style.display="none";
    } else {
        divpadres.style.display = "none";//ocultar
    }
    break;

case '3'://filtro matriculas
    if (divmatriculas.style.display === "none") {
        divmatriculas.style.display = "block";//mostrar
        divestudiantes.style.display="none";
        divpadres.style.display="none";
        divcalificaciones.style.display="none";        
        divasistencias.style.display="none";
    } else {
        divmatriculas.style.display = "none";//ocultar
    }
    break;
    
    case '4'://filtro calificaciones
    if (divasistencias.style.display === "none") {
        divasistencias.style.display = "block";//mostrar
        divestudiantes.style.display="none";
        divmatriculas.style.display="none";
        divcalificaciones.style.display="none";
        divpadres.style.display="none";
    } else {
        divasistencias.style.display = "none";//ocultar
    }
    break;

    case '5'://filtro estadisticas
    if (divcalificaciones.style.display === "none") {
        divcalificaciones.style.display = "block";//mostrar
        divestudiantes.style.display="none";
        divmatriculas.style.display="none";
        divpadres.style.display="none";
        divasistencias.style.display="none";
    } else {
        divcalificaciones.style.display = "none";//ocultar
    }
    break;

  }
//cargarbusquedaestudiantes();
});

$('#btnbuscar').on('click', function(){
  if($('#filtros').val()!=0)
  {

    var opc,estado,genero,ani,seccion,grado,turno,edad,edadinicio,edadfin;
    opc=$('#filtros option:selected').val();
     
    var table=$('#tablaBusqueda').DataTable();
    table.destroy(); 
    $('#tablaBusqueda thead').empty(); 
    $('#tablaBusqueda tbody').empty(); 


    switch (opc)
    {
      case '1'://estudiantes
 
    estado=$('input:radio[name=estudiantesactivos]:checked').val();
    genero=$('input:radio[name=estudiantesGenero]:checked').val();
    ani=$('#anioestudiante').val();
    grado=$("#filtrogradosestudiantes option:selected").val();
    seccion=$("#filtroseccionestudiante option:selected").val();
    edadinicio=$("#inicioedadestudiante").val();
    edadfin=$("#finedadestudiante").val();
    if(ani==''){ani='-';}
    if(edadinicio==''){edadinicio='-';}
     if(edadfin==''){edadfin='-';}

var cont=0; 

var table = document.getElementById("tablaBusqueda");
var header = table.createTHead();
var row = header.insertRow(0); 
var cell = row.insertCell(0);
cell.innerHTML = "<b>No.</b>";
var cell = row.insertCell(1);
cell.innerHTML = "<b>NIE</b>";
var cell = row.insertCell(2);
cell.innerHTML = "<b>NOMBRE</b>";
var cell = row.insertCell(3);
cell.innerHTML = "<b>GENERO</b>";
var cell = row.insertCell(4);
cell.innerHTML = "<b>EDAD (AÑOS)</b>";
var cell = row.insertCell(5);
cell.innerHTML = "<b>ESTADO</b>";

  $.get('filtroestudiantes/'+estado+'/'+genero+'/'+ani+'/'+grado+'/'+seccion+'/'+edadinicio+'/'+edadfin,function(estudiantes){

  $(estudiantes).each(function (key,value){
    cont=cont+1;
    console.log(value);
  $('#tablaBusqueda').append('<tr><td>' + cont + '</td><td>' +value.v_nie +'</td><td>' + value.v_nombres +" "+ value.v_apellidos + '</td><td>'+ value.v_genero+ '</td><td>'+ value.edad +'</td><td>'+value.estado+'</td></tr>'); 
     }); 
table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 30,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  }); 

  });
break;

          case '2'://padres de familia

    estado=$('input:radio[name=padresactivos]:checked').val();
    genero=$('input:radio[name=padresGenero]:checked').val();
    apellido=$('#txtapellidos').val();
    parentesco=$('#filtroparentesco option:selected').val();
    profesion=$("#txtprofesion").val();

if(apellido==''){apellido='-';}
if(profesion==''){profesion='-';}

var table = document.getElementById("tablaBusqueda");
var header = table.createTHead();
var row = header.insertRow(0); 
var cell = row.insertCell(0);
cell.innerHTML = "<b>No.</b>";
var cell = row.insertCell(1);
cell.innerHTML = "<b>NOMBRE</b>";
var cell = row.insertCell(2);
cell.innerHTML = "<b>GENERO</b>";
var cell = row.insertCell(3);
cell.innerHTML = "<b>PARENTESCO</b>";
var cell = row.insertCell(4);
cell.innerHTML = "<b>OCUPACION</b>";
var cell = row.insertCell(5);
cell.innerHTML = "<b>NIVEL EDUCATIVO</b>";
var cell = row.insertCell(6);
cell.innerHTML = "<b>ESTADO</b>";
var cont=0;

  $.get('filtropadresdefamilia/'+estado+'/'+genero+'/'+apellido+'/'+parentesco+'/'+profesion,function(padres){

  $(padres).each(function (key,value){
    cont=cont+1;
  $('#tablaBusqueda').append('<tr><td>' + cont + '</td><td>' + value.nombres +" "+ value.apellidos + '</td><td>'+ value.genero+ '</td><td>'+ value.parentesco +'</td><td>'+ value.profesion + '</td><td>'+ value.niveleducativo+'</td><td>'+value.estado+'</td></tr>'); 
     }); 
table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 30,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  }); 

  });

          break;

          case'3'://matriculas

var table = document.getElementById("tablaBusqueda");
var header = table.createTHead();
var row = header.insertRow(0); 
var cell = row.insertCell(0);
cell.innerHTML = "<b>No.</b>";
var cell = row.insertCell(1);
cell.innerHTML = "<b>ESTUDIANTE</b>";
var cell = row.insertCell(2);
cell.innerHTML = "<b>GENERO</b>";
var cell = row.insertCell(3);
cell.innerHTML = "<b>NUEVO INGRESO</b>";
var cell = row.insertCell(4);
cell.innerHTML = "<b>MODALIDAD</b>";
var cell = row.insertCell(5);
cell.innerHTML = "<b>GRADO</b>";
var cell = row.insertCell(6);
cell.innerHTML = "<b>AÑO</b>";
var cont=0;

    genero=$('input:radio[name=matriculaGenero]:checked').val();
    grado=$('#filtromatriculagrados option:selected').val();
    anio=$('#matriculaanio').val();
    ingreso=$('input:radio[name=matriculaingreso]:checked').val();
    modalidad=$('input:radio[name=modalidadingreso]:checked').val();

if(anio==''){anio='-';}

  $.get('filtromatric/'+anio+'/'+grado+'/'+genero+'/'+ingreso+'/'+modalidad,function(matricula){
  $(matricula).each(function (key,value){
    cont=cont+1;
  $('#tablaBusqueda').append('<tr><td>' + cont + '</td><td>' + value.v_nombres +" "+ value.v_apellidos + '</td><td>'+ value.v_genero+ '</td><td>'+ value.v_nuevoingresoSN +'</td><td>'+ value.modalidad + '</td><td>'+ value.grado+'</td><td>'+ value.anio + '</td></tr>'); 
     }); 
table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 30,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  }); 

  });

    break;

    case'4': 
var table = document.getElementById("tablaBusqueda");
var header = table.createTHead();
var row = header.insertRow(0); 
var cell = row.insertCell(0);
cell.innerHTML = "<b>No.</b>";
var cell = row.insertCell(1);
cell.innerHTML = "<b>ESTUDIANTE</b>";
var cell = row.insertCell(2);
cell.innerHTML = "<b>GENERO</b>";
var cell = row.insertCell(3);
cell.innerHTML = "<b>GRADO</b>";
var cell = row.insertCell(4);
cell.innerHTML = "<b>AÑO</b>";
var cell = row.insertCell(5);
cell.innerHTML = "<b>CALIFICACION</b>";
var cont=0;

    genero=$('input:radio[name=calificacionesGenero]:checked').val();
    grado=$('#gradoscalificaciones option:selected').val();
    criterio=$('#criteriocalificaciones option:selected').val();
    asignatura=$('#asignaturascalificaciones option:selected').val();
    anio=$('#calificacionesanio').val();

    if(anio==''){anio='-';}

  $.get('filtrocalificaciones/'+anio+'/'+grado+'/'+genero+'/'+criterio+'/'+asignatura,function(calificaciones){
  $(calificaciones).each(function (key,value){
    cont=cont+1;
  $('#tablaBusqueda').append('<tr><td>' + cont + '</td><td>' + value.v_nombres +" "+ value.v_apellidos + '</td><td>'+ value.v_genero+ '</td><td>'+ value.descripcion+'</td><td>'+ value.anio + '</td><td>'+value.valor +'</td></tr>');}); 
table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 30,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  }); 

  });

    break;

    case'5': //estadisticas

var table = document.getElementById("tablaBusqueda");
var header = table.createTHead();
var row = header.insertRow(0); 
var cell = row.insertCell(0);
cell.innerHTML = "<b>No.</b>";
var cell = row.insertCell(1);
cell.innerHTML = "<b>ESTUDIANTE</b>";
var cell = row.insertCell(2);
cell.innerHTML = "<b>GENERO</b>";
var cell = row.insertCell(3);
cell.innerHTML = "<b>GRADO</b>";
var cell = row.insertCell(4);
cell.innerHTML = "<b>AÑO</b>";
var cell = row.insertCell(5);
cell.innerHTML = "<b>CRITERIO</b>";
var cont=0;


    genero=$('input:radio[name=estadisticasGenero]:checked').val();
    grado=$('#gradosestadisticas option:selected').val();
    criterio=$('#estadisticaestatus option:selected').val();
    anio=$('#estadisticasanio').val();

switch (criterio)
{
  case '1':
var crit="Promovido";
  break;
  case '2':
var crit="Egresado";
  break;
  case '3':
var crit="Repitente";
  break;
  case '4':
var crit="Retenido";
  break;
}

    if(anio==''){anio='-';}

  $.get('filtroestadisticas/'+anio+'/'+grado+'/'+genero+'/'+criterio,function(calificaciones){
  $(calificaciones).each(function (key,value){
    cont=cont+1;
  $('#tablaBusqueda').append('<tr><td>' + cont + '</td><td>' + value.v_nombres +" "+ value.v_apellidos + '</td><td>'+ value.v_genero+ '</td><td>'+ value.grado+'</td><td>'+ value.anio + '</td><td>'+ crit +'</td></tr>'); 
     }); 
table=$('#tablaBusqueda').DataTable(
    {
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'iDisplayLength' : 30,
    'language': {
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      'search': 'Buscar:',
      'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente'
      }
    }
  }); 

  });
 break;

    }//fin case


  }//if filtros

  });

</script>

@endsection
