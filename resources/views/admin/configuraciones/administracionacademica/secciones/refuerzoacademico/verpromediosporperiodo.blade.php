@extends('admin.menuprincipal')
<?php 
if ($modulo=='admin') 
  {$var = 'Configuraciones/Administración Académica/Secciones/Refuerzo Académico';}
else
{$var='Docente/Refuerzo Académico';}
?>
@section('tittle', $var)
@section('content')
 
<div class="box box-primary box-solid">
 
@if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
  </div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <strong>{{ $message }}</strong>
</div>
@endif

<style type="text/css">
  .red { background-color: red !important; } .green { background-color: lime !important; }
</style>


  <div class="box-header">
    <div class="col-sm-12">
      <h2 class="box-title">
       PROMEDIOS POR ASIGNATURA : {{$periodoevaluado->descripcion}}
        </h2>
    </div>
  </div>

  <div class="box-body table-responsive">
  <form id="frm" name="frm"> 
     @csrf
    
      <table class="table table-bordered table-striped">
        <thead>
          
          <th style="width: 50px">No</th>
          <th style="width: 100px">NIE</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          @foreach($materias as $k=> $v)
          <th class="text-center">{{($v)}}</th>
           @endforeach
        </thead>
        <tbody>
    @foreach($students as $key=> $value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$students[$key]->v_nie}}</td>
    <td>{{$students[$key]->v_apellidos}} </td>
    <td> {{$students[$key]->v_nombres}} </td>
    <?php
   foreach ($itemsNotasEst[$students[$key]->v_expediente] as $k=>$materia) 
       {
             foreach ($materia as $ke=>$periodo)
        {

        $promfinal=0; 
      $promp1=(isset($periodo['PRIMER PERIODO']['ACT1']) ? floatval($periodo['PRIMER PERIODO']['ACT1']) : 0) +
      (isset($periodo['PRIMER PERIODO']['ACT2']) ? floatval($periodo['PRIMER PERIODO']['ACT2']) : 0) +
      (isset($periodo['PRIMER PERIODO']['ACT3']) ? floatval($periodo['PRIMER PERIODO']['ACT3']) : 0) +
      (isset($periodo['PRIMER PERIODO']['RF']) ? floatval($periodo['PRIMER PERIODO']['RF']) : 0);

      $promp2=(isset($periodo['SEGUNDO PERIODO']['ACT1']) ? floatval($periodo['SEGUNDO PERIODO']['ACT1']) : 0) +
      (isset($periodo['SEGUNDO PERIODO']['ACT2']) ? floatval($periodo['SEGUNDO PERIODO']['ACT2']) : 0) +
      (isset($periodo['SEGUNDO PERIODO']['ACT3']) ? floatval($periodo['SEGUNDO PERIODO']['ACT3']) : 0) +
      (isset($periodo['SEGUNDO PERIODO']['RF']) ? floatval($periodo['SEGUNDO PERIODO']['RF']) : 0);

      $promp3=(isset($periodo['TERCER PERIODO']['ACT1']) ? floatval($periodo['TERCER PERIODO']['ACT1']) : 0) +
      (isset($periodo['TERCER PERIODO']['ACT2']) ? floatval($periodo['TERCER PERIODO']['ACT2']) : 0) +
      (isset($periodo['TERCER PERIODO']['ACT3']) ? floatval($periodo['TERCER PERIODO']['ACT3']) : 0) +
      (isset($periodo['TERCER PERIODO']['RF']) ? floatval($periodo['TERCER PERIODO']['RF']) : 0);

      $promfinal=$promfinal+($promp1+$promp2+$promp3);

$promfinal= floor(($promfinal*1000))/1000;
$promfinal=number_format($promfinal,2);
   $class = ($promfinal < 5) ? 'red' : 'green';
  echo "<td class='{{ $class }}'> "; print_r(number_format($promfinal,2)); 
  if($promfinal < 5){   
  echo"<a href='addrefuerzo/{$students[$key]->id}/{$ke}/{$seccion_id}/{$periodoevaluado->id}/{$modulo}/view' class='btn btn-primary' align='left'><i class='fa fa-edit'></i> Reforzar</a>";

} echo "</td>";
        }
      }
        ?>  
     </tr>
    @endforeach
        </tbody>
      </table>
    </form>    
</div>
<div class="box-footer" align="right"> 
@if($modulo=='admin')
<a href="{{route('listasecciones')}}" class="btn btn-default">Cancelar</a>
@endif 
@if($modulo=='docente')
<a href="{{route('nominadeestudiantes',$seccion_id)}}" class="btn btn-default">Cancelar</a>
 @endif              
  </div>
@endsection



@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="text/javascript">
    $(document).on('ready', function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })

      $("#recalcularcuadro").on('click', function(e) {
       
       $.post({
          url: url+'eliminarCuadro/'+<?=$seccion_id?>,
          data: { 'seccion': <?=$seccion_id?> }
        }).then(function(results) {
         window.location.reload();
         //alert('nothing');
        });
      });
         
    });
  </script>
@endsection