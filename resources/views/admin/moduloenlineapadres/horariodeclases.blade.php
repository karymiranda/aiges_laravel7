@extends('admin.menuprincipal')
@section('tittle', 'Familiares/Mis Estudiantes/Horario de Clases')
@section('content')

<div class="box box-primary">
  <div class="box-header">
    <div class="col-sm-12" align="center">
        <h3> <label class="text-white">HORARIOS DE CLASES {{$seccion}}</label></h3>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body table-responsive">    
    <div class="form-group" align="center"> 
            <table class="table table-striped table-bordered ">
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
       <?php for($i=0;$i<=$b;$i++){ ?> 
            <tr>            
              <td>{{ $horario[$i][0][0] }}</td> 
          <?php for($e=0;$e<5;$e++){ ?>     
              <td>
                <?php if ($horario[$i][$e][1]!='Clase'): ?>          
                  <span class="label label-success"><label style="padding-top: 8%">Receso</label></span>          
                <?php else: ?>
                  <span class="label label-primary"><label>{{ $horario[$i][$e][2] }}</label></span><br><span class="label label-info"><label>{{ $horario[$i][$e][3] }}</label></span>
                <?php endif ?>
              </td>            
          <?php } ?>
            </tr>
        <?php } ?>
      </tbody>
    </table>
    </div>                                    
  </div>
  <div class="box-footer" align="right"> 
  
    <a href="{{ route('horariosdeclases_pdf',$idseccion) }}" target="_blank" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i> Descargar en PDF</a>
    <a href="{{ route('estudiantes_familiares',Auth::user()->familiar->id) }}" class="btn btn-default">Regresar</a>

  </div>
 
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