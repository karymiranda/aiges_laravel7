@extends('admin.menuprincipal')
@section('tittle','Personal Docente/Historial Academico/Calificaciones')
@section('content')

<div class="row"> 
 <div class="col-md-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Calificaciones {{$anio}} / {{$estudiante->v_nombres}} {{$estudiante->v_apellidos}} </h3>
              
            </div>
   <!-- /.box-header -->          
        <div class="box-body">


<div class="col-md-12">
<div class="box-body table-responsive">    
      <table class="table table-bordered table-striped" >
        <thead style="background-color: #f39c12;color:white;">
          <tr>
            <td rowspan="2" align="center">ASIGNATURA</td>
            <td colspan="5" align="center">PRIMER PERIODO</td>
            <td colspan="5" align="center">SEGUNDO PERIODO</td>
            <td colspan="6" align="center">TERCER PERIODO</td>
          </tr>

         
         <th >ACT1</th>
         <th >ACT2</th>
          <th >ACT3</th>                  
          <th >NR</th>
          <th>PR</th>

          <th>ACT1</th>
         <th >ACT2</th>
          <th>ACT3</th>                  
          <th>NR</th>
          <th >PR</th>

          <th >ACT1</th>
         <th >ACT2</th>
          <th >ACT3</th>                  
          <th >NR</th>
          <th >PR</th>
          <th>PF</th>

          
        </thead>
      <tbody> 
<?php
 foreach ($itemsNotas[$exp] as $k=>$materia) 
       {
             foreach ($materia as $ke=>$periodo)
        {  
          echo "<tr>";
echo "<td>"; print_r($ke); "</td>";  
$promfinal=0;       
          foreach ($periodo as $key=>$value)
        { 
         
echo "<td>";(isset($value['ACT1']) ?  print_r($value['ACT1'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($value['ACT2']) ?  print_r($value['ACT2'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($value['ACT3']) ?  print_r($value['ACT3'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($value['RF']) ?  print_r($value['RF'])  : print_r('0'));echo "</td>";

      $prom=(isset($value['ACT1']) ? floatval($value['ACT1']) : 0) +
      (isset($value['ACT2']) ? floatval($value['ACT2']) : 0) +
      (isset($value['ACT3']) ? floatval($value['ACT3']) : 0);
$promfinal=$promfinal+$prom/3;
echo "<td>"; print_r($prom);echo "</td>";

        }
        echo "<td>"; print_r(number_format($promfinal,1));echo "</td>";
        echo "</tr>";
        }

       } 
  ?>       
 
      </tbody>
    </table>
  
  </div>   
 </div> 

<div class="col-md-12">
<div class="box-body table-responsive">
    <div class="form-group" align="center"> 
      <table class="table table-bordered table-striped">
        <thead style="background-color: #f39c12;color:white;">
          <th style="width: 40%">CONVIVENCIAS CIUDADANAS</th>
          <th style="width: 10%">PRIMER PERIODO</th>
          <th style="width: 10%">SEGUNDO PERIODO</th>
          <th style="width: 10%">TERCER PERIODO</th>
        </thead>
        <tbody>
 <?php
echo "<tr>"; 
echo "<td>";
for ($i=0; $i < count($a) ; $i++) { 
print_r($a[$i]); echo"<br>";
}
echo"</td>";

foreach ($conducta as $k =>$item) { 
//echo "</tr>";
echo "<td>";
(isset($item->criterio_1) ?  print_r($item->criterio_1): print_r('---'));echo"<br>";
(isset($item->criterio_2) ?  print_r($item->criterio_2): print_r('---'));echo"<br>";
(isset($item->criterio_3) ?  print_r($item->criterio_3): print_r('---'));echo"<br>";
(isset($item->criterio_4) ?  print_r($item->criterio_4): print_r('---'));echo"<br>";
(isset($item->criterio_5) ?  print_r($item->criterio_5): print_r('---'));echo"<br>";

echo "</td>";
}
echo "</tr>";
 ?> 
      </tbody>
    </table>
    </div>
  </div>   
 </div> 

</div>
<div class="box-footer" align="right">                
        <a href="{{route('expedientecompleto_modulodocente',[$estudiante->id,$idseccion])}}" class="btn btn-primary">Regresar</a>
 </div> 
 </div> 
 </div> 
  </div>
 </div>
 </div> 
 </div> 

@endsection
 