@extends('admin.menuprincipal')
@section('tittle','Expediente Estudiantil/Calificaciones')
@section('content')

<div class="row"> 
 <div class="col-md-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Calificaciones {{$anio}} / {{$estudiante->v_nombres}} {{$estudiante->v_apellidos}} </h3>
            </div>


            <!-- /.box-header -->          
        <div class="box-body">

<style type="text/css">
  .red { background-color: red !important; } .green { background-color: lime !important; }
</style>

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
         
         
echo "<td>";(isset($periodo['PRIMER PERIODO']['ACT1']) ?  print_r($periodo['PRIMER PERIODO']['ACT1'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['PRIMER PERIODO']['ACT2']) ?  print_r($periodo['PRIMER PERIODO']['ACT2'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['PRIMER PERIODO']['ACT3']) ?  print_r($periodo['PRIMER PERIODO']['ACT3'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['PRIMER PERIODO']['RF']) ?  print_r($periodo['PRIMER PERIODO']['RF'])  : print_r('0'));echo "</td>";

$promp1=(isset($periodo['PRIMER PERIODO']['ACT1']) ? floatval($periodo['PRIMER PERIODO']['ACT1']) : 0) +
      (isset($periodo['PRIMER PERIODO']['ACT2']) ? floatval($periodo['PRIMER PERIODO']['ACT2']) : 0) +
      (isset($periodo['PRIMER PERIODO']['ACT3']) ? floatval($periodo['PRIMER PERIODO']['ACT3']) : 0) +
      (isset($periodo['PRIMER PERIODO']['RF']) ? floatval($periodo['PRIMER PERIODO']['RF']) : 0);

//$class = ($promp1 < 5) ? 'red' : 'green';
echo "<td>"; print_r($promp1);echo "</td>";



echo "<td>";(isset($periodo['SEGUNDO PERIODO']['ACT1']) ?  print_r($periodo['SEGUNDO PERIODO']['ACT1'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['SEGUNDO PERIODO']['ACT2']) ?  print_r($periodo['SEGUNDO PERIODO']['ACT2'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['SEGUNDO PERIODO']['ACT3']) ?  print_r($periodo['SEGUNDO PERIODO']['ACT3'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['SEGUNDO PERIODO']['RF']) ?  print_r($periodo['SEGUNDO PERIODO']['RF'])  : print_r('0'));echo "</td>";

$promp2=(isset($periodo['SEGUNDO PERIODO']['ACT1']) ? floatval($periodo['SEGUNDO PERIODO']['ACT1']) : 0) +
      (isset($periodo['SEGUNDO PERIODO']['ACT2']) ? floatval($periodo['SEGUNDO PERIODO']['ACT2']) : 0) +
      (isset($periodo['SEGUNDO PERIODO']['ACT3']) ? floatval($periodo['SEGUNDO PERIODO']['ACT3']) : 0) +
      (isset($periodo['SEGUNDO PERIODO']['RF']) ? floatval($periodo['SEGUNDO PERIODO']['RF']) : 0);
//$class = ($promp2 < 5) ? 'red' : 'green';
echo "<td > "; print_r($promp2);echo "</td>";


echo "<td>";(isset($periodo['TERCER PERIODO']['ACT1']) ?  print_r($periodo['TERCER PERIODO']['ACT1'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['TERCER PERIODO']['ACT2']) ?  print_r($periodo['TERCER PERIODO']['ACT2'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['TERCER PERIODO']['ACT3']) ?  print_r($periodo['TERCER PERIODO']['ACT3'])  : print_r('0'));echo "</td>";
echo "<td>";(isset($periodo['TERCER PERIODO']['RF']) ?  print_r($periodo['TERCER PERIODO']['RF'])  : print_r('0'));echo "</td>";

$promp3=(isset($periodo['TERCER PERIODO']['ACT1']) ? floatval($periodo['TERCER PERIODO']['ACT1']) : 0) +
      (isset($periodo['TERCER PERIODO']['ACT2']) ? floatval($periodo['TERCER PERIODO']['ACT2']) : 0) +
      (isset($periodo['TERCER PERIODO']['ACT3']) ? floatval($periodo['TERCER PERIODO']['ACT3']) : 0) +
      (isset($periodo['TERCER PERIODO']['RF']) ? floatval($periodo['TERCER PERIODO']['RF']) : 0);

//$class = ($promp3 < 5) ? 'red' : 'green';
echo "<td > ";  print_r($promp3);echo "</td>";


$promfinal=$promfinal+($promp1+$promp2+$promp3)/3;
$class = ($promfinal < 5) ? 'red' : 'green';
echo "<td class='{{ $class }}'> ";  print_r(number_format($promfinal,2));echo "</td>";
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
        <a href="{{route('verexpedienteestudiantes',$estudiante->id)}}" class="btn btn-primary">Regresar</a>
 </div> 
 </div> 
 </div> 
  </div>
 </div>
 </div> 
 </div> 

@endsection
 