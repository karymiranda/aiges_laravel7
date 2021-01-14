@extends('admin.menuprincipal')
@section('tittle', 'Personal Docente/Mis Horarios')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>HORARIO DE CLASES</Strong></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    {!! Form::open(['class'=>'form-horizontal']) !!}
   
    {!! Form::close() !!}
    <div class="form-group" align="center"> 
      <table class="table table-bordered table-striped">
        <thead style="background-color: #3c8dbc;color:white;">
          <th style="width: 10%">HORARIO</th>
          <th style="width: 18%">LUNES</th>
          <th style="width: 18%">MARTES</th>
          <th style="width: 18%">MIERCOLES</th>                  
          <th style="width: 18%">JUEVES</th>
          <th style="width: 18%">VIERNES</th>
        </thead>
        <tbody>
       <!--  -->
       <?php for($b=0;$b<$numerobloques;$b++){ ?> 
            <tr>            
            <td>{{$bloques[$b]->hora_inicio}} - {{$bloques[$b]->hora_fin}}</td> 
          <?php for($d=0;$d<5;$d++){ ?>


 <?php if (!isset($lista[$b][$d]))//no existe ese bloque en ese dia
       {
         if($d<4){?>
               <td>-</td>               
              
               <?php }else
                 { ?>
                 	<td>-</td>  
                 <?php
                   }
                      }
        else{//si existe bloque  y dia
                 if($d<4){//para pasar ala siguiente linea 
?>
<td>{{$lista[$b][$d][4]}}</td>  
                <?php }else
                 { ?>
<td>{{$lista[$b][$d][4]}}</td>  
   <?php }
        }//else isset

             }    
         } ?>
      </tbody>
    </table>
    </div>                                    
  </div>
  <div class="box-footer" align="right">                
    <a href="{{route('menu')}}" class="btn btn-primary"><< Regresar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->   
</div>
@endsection
@section('script')
<style type="text/css">
.table th,td{
    text-align: center;
}
</style>
@endsection