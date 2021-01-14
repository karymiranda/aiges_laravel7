@extends('admin.menuprincipal')
@section('tittle','Personal Docente')
@section('content')

  <div class="box  box-primary">
    <div class="box-header">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">CONTROL DE ASISTENCIAS</label></h2>
              </div>
      <div class="col-sm-12" align="right">            
        <a href="javascript:void(0)" id="btnAsistencia" class="btn btn-default">Tomar Asistencia</a>
      </div>
      @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    </div> 
    <hr>          
    <div class="box-body">
      {!! Form::open(['route'=>'listadoasistencia','class'=>'form-horizontal','method'=>'POST']) !!}
      <div class="form-group">
        <label class="col-sm-4 control-label">Fecha</label>
        <div class="col-sm-3">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" value="{{$hoy}}" name="f_asistencia" id="f_asistencia" class="form-control pull-right rangoPast" readonly="true">
          </div> 
        </div>
        </div>

         <div class="form-group">
        <label class="col-sm-4 control-label">Sección</label>
        <div class="col-sm-3">          
          {!! Form::select('grado_seccion',$secciones, $seccion,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'grado_seccion'])!!} 
        </div> 
        {!! Form::submit('Buscar',['class'=>'btn btn-primary ']) !!} 
      </div>
      {!! Form::close() !!}
      <hr>

      <?php
      if($estudiante[0]!=null){ ?>

      <table class="table table-bordered table-striped" id="tablaAsistencia">
        <thead style="background-color: #3c8dbc;color:white;">
          <th>No.</th>
          <th>ESTUDIANTES</th>
          <?php for($i=0;$i<$f;$i++){ ?> 
          <th>{{ $estudiante[0][$i][1] }}</th>
          <?php } ?>
        </thead>
        <tbody> 
          <?php for($i=0;$i<$n;$i++){ ?> 
            <tr>
             <td>{{ $i+1 }}</td>            
              <td>{{ $estudiante[$i][0][0] }}</td> 
          <?php for($e=0;$e<$f;$e++){ ?>     
              <td>
                <?php if($estudiante[$i][$e][2]=='Permiso'){ ?>
                <span class="label label-info">Permiso</span>
                <?php }else{ if($estudiante[$i][$e][2]=='Asistencia'){ ?>
                <span class="label label-success">Asistencia</span>
                <?php }else{ if($estudiante[$i][$e][2]=='Ausencia'){ ?>
                <span class="label label-danger">Ausencia</span>
                <?php }else{ ?>
                <span class="label label-default">Sin Registro</span>
                <?php }}} ?> 
              </td>            
          <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
      </table>
<?php } ?>

    </div>
    <!-- /.box-body-->   
  </div>
@endsection
@section('script')
<script>
  $(document).ready(function(){
    if ($('#grado_seccion option').length != 1) 
    {
        $("#btnAsistencia").attr("href", "{{ route('marcarasistencia_view') }}")
        $("#btnAsistencia").attr('class','btn btn-primary');
    }
});
</script>
@endsection