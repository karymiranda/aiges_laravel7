@extends('admin.menuprincipal')
@section('tittle', 'Administración académica')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>VER HORARIO DE CLASES</Strong></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    {!! Form::open(['class'=>'form-horizontal']) !!}
    <div class="form-group">                                           
      {!! Form::label('lbsecciones', 'Grado/Sección',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-2">
        {!! Form::text('gradoseccion',$seccion,['class'=>'form-control pull-right','readonly'=>'true'])!!}
      </div>
    </div>
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
    <a href="{{route('listadohorariosclase')}}" class="btn btn-primary"><< Regresar</a>
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